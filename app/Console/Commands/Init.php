<?php

namespace App\Console\Commands;

use App\Models\EvAdmin;
use App\Models\EvConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class Init extends Command
{
    /**
     * 命令行执行命令
     * @var string
     */
    protected $signature = 'init {name} {password}';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument("name");
        $passwd = $this->argument("password");
        $user = EvAdmin::first();
        if ($user) {
            $res = $user->update(["name" => $name, "password" => md5($passwd)]);
        } else {
            $res = EvAdmin::create(["name" => $name, "password" => md5($passwd)]);
        }
        if ($res) {
            $defaultconfig = ["name" => "easyvod", "logo" => "", "icp" => "xxxx", "email" => "admin@admin.com", "keywords" => "easyvod", "content" => "easyvod", "tj" => "xxxx", "notice" => "测试公告", "cache" => 1, "method" => "qihu", "template" => "dyxs", "status" => 1];
            $config = EvConfig::first();
            if (blank($config)) {
                EvConfig::Create($defaultconfig);
                $config = json_decode(json_encode($defaultconfig));
                Cache::forever("webconfig", json_encode($config));
            }
            echo "用户初始化成功\n";
        } else {
            echo "用户初始化失败\n";
        }
    }
}
