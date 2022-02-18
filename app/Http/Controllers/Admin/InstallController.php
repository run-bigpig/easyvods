<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InstallController extends Controller
{

  public function Index(Request  $request){
      $installLockFile = base_path("center/install.lock");
      if (file_exists($installLockFile)){
          echo "当前已经安装成功，如果需要重新安装，请手动移除【center/install.lock】文件<br><br>";
          echo "<a href='/'>返回首页</a>";
          exit;
      }
      $output = function ($code, $msg, $url = null, $data = null) {
          return response(['code' => $code, 'msg' => $msg, 'url' => $url, 'data' => $data],200);
      };
      if ($request->isMethod("post")){
          $mysqlHostname = $request->post('mysqlHostname', '127.0.0.1');
          $mysqlHostport = $request->post('mysqlHostport', '3306');
          $hostArr = explode(':', $mysqlHostname);
          if (count($hostArr) > 1) {
              $mysqlHostname = $hostArr[0];
              $mysqlHostport = $hostArr[1];
          }
          $mysqlUsername = $request->post('mysqlUsername', 'root');
          $mysqlPassword = $request->post('mysqlPassword', '');
          $mysqlDatabase = $request->post('mysqlDatabase', '');
          $adminUsername = $request->post('adminUsername', 'admin');
          $adminPassword = $request->post('adminPassword', '');
          $adminPasswordConfirmation = $request->post('adminPasswordConfirmation', '');
          if ($adminPassword !== $adminPasswordConfirmation) {
              return $output(0, __('messages.The two passwords you entered did not match'));
          }

          $adminName = '';
          try {
              $adminName = $this->installation($mysqlHostname, $mysqlHostport, $mysqlDatabase, $mysqlUsername, $mysqlPassword, $adminUsername, $adminPassword);
          } catch (\PDOException $e) {
              throw new \Exception($e->getMessage());
          } catch (\Exception $e) {
              return $output(0, $e->getMessage());
          }
          return $output(1, __('messages.Install Successed'), null, ['adminName' => $adminName]);
      }
      $errInfo = '';
      try {
          $this->checkenv();
      } catch (\Exception $e) {
          $errInfo = $e->getMessage();
      }
      return view("install.install", ['errInfo' => $errInfo]);
  }

    /**
     * 执行安装
     */
    protected function installation($mysqlHostname, $mysqlHostport, $mysqlDatabase, $mysqlUsername, $mysqlPassword, $adminUsername, $adminPassword) {
        $this->checkenv();

        if ($mysqlDatabase == '') {
            throw new \Exception(__('messages.Please input correct database'));
        }
        if (!preg_match("/^\w{3,12}$/", $adminUsername)) {
            throw new \Exception(__('messages.Please input correct username'));
        }
        if (!preg_match("/^[\S]{6,16}$/", $adminPassword)) {
            throw new \Exception(__('messages.Please input correct password'));
        }


        $sql = @file_get_contents(base_path('install.sql'));

        // 先尝试能否自动创建数据库
        try {
            $pdo = new \PDO("mysql:host={$mysqlHostname}" . ($mysqlHostport ? ";port={$mysqlHostport}" : ''), $mysqlUsername, $mysqlPassword);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->query("CREATE DATABASE IF NOT EXISTS `{$mysqlDatabase}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $pdo->query("use {$mysqlDatabase};");
            $pdo->exec($sql);
        } catch (\PDOException $e) {
            if(strstr($e->getMessage(), '(using password: YES)')){
                throw new \Exception('数据库连接失败，数据库密码错误');
            }else{
                throw new \Exception($e->getMessage());
            }

        }

        // 数据库配置文件
        $dbConfigFile = base_path("config/mysql.php");
        $exampleconfig = ['host' => '#host', 'port' => '#port', 'database' => '#database', 'username' => '#username', 'password' => '#password'];
        writeconfig($dbConfigFile,$exampleconfig);
        $config = @file_get_contents($dbConfigFile);
        $replacestr = ["#host"=>$mysqlHostname,"#port"=>$mysqlHostport,"#database"=>$mysqlDatabase,"#username"=>$mysqlUsername,"#password"=>$mysqlPassword];
        foreach ($replacestr as $replace=>$value){
            $config = str_replace($replace,$value,$config);
        }
        // 检测能否成功写入数据库配置
        $result = @file_put_contents($dbConfigFile, $config);
        if (!$result) {
            throw new \Exception(__('文件权限不足，请给站点目录循环设置755权限！ %s', 'config/mysql.php'));
        }

        // 变更默认管理员密码
        $adminPassword = $adminPassword ? $adminPassword :Str::random(20);
        $newPassword = md5($adminPassword);
        $data = ['name' => $adminUsername,  'password' => $newPassword];
        EvAdmin::where(["name"=>"admin"])->update($data);
        $installLockFile = base_path("center/install.lock");
        //检测能否成功写入lock文件
        $result = @file_put_contents($installLockFile, 1);
        if (!$result) {
            throw new \Exception(__('文件权限不足，请给站点目录循环设置755权限！'));
        }

        return 'admin';
    }

    /**
     * 检测环境
     */
    protected function checkenv() {
        // 检测目录是否存在
        $checkDirs = [
            'vendor'
        ];

        //数据库配置文件
        $dbConfigFile = base_path("config/mysql.php");

        if (version_compare(PHP_VERSION, '7.4.0', '<')) {
            throw new \Exception("当前【PHP " . PHP_VERSION . "】版本过低，请使用【PHP 7.4】版本");
        }
        if (!extension_loaded("PDO")) {
            throw new \Exception(__("messages.PDO is not currently installed and cannot be installed"));
        }
        if (!is_really_writable($dbConfigFile)) {
            throw new \Exception(__('文件权限不足，请给站点目录循环设置755权限！'));
        }
        foreach ($checkDirs as $k => $v) {
            if (!is_dir(base_path($v))) {
                throw new \Exception(__('messages.Please go to the official website to download the full package or resource package and try to install'));
                break;
            }
        }
        return true;
    }

}