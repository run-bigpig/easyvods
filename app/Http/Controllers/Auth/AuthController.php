<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:17:58
 **/


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\EvAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function showLogin()
    {
        if (Auth::check()){
            return redirect(route("admin.index"));
        }
        return view("easyvod.views.login");
    }

    private function Verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(["code" => 1, "msg" => "账号和密码有误"]);
        }
        $cap = $this->checkcaptcha($request->input("captchakey"), $request->input("captcha"));
        if ($cap === false) {
            return response()->json(["code" => 1, "msg" => "验证码错误"]);
        }
        Cache::forget($request->input("captchakey"));
        return true;
    }

    public function Login(Request $request)
    {
        $verify = $this->Verify($request);
        if ($verify !== true) {
            return $verify;
        };
        $name = $request->post("name");
        $password = $request->post("password");
        $user = EvAdmin::where(["name" => $name, "password" => md5($password)])->first();
        if ($user) {
            $apitoken = Str::random(20);
            $user->update(["api_token" => $apitoken]);
            setcookie("api_token", $apitoken);
            return response()->json(["code" => 0, "msg" => "登录成功"]);
        }
        return response()->json(["code" => 1, "msg" => "登录失败"]);
    }


    public function LogOut()
    {
        $user = Auth::user();
        if ($user) {
            $user->update(["api_token" => null]);
            return redirect(route("admin.login"));
        }
        return redirect(route("admin.index"));
    }

    public function ChangePass(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(["code" => 1, "msg" => "账号和密码有误"]);
            }
            $res = EvAdmin::first()->update(["name" => $request->post("name"), "password" => md5($request->post("password"))]);
            if ($res) {
                return response()->json(["code" => 0, "msg" => "修改成功"]);
            }
        }
        return response()->json(["code" => 1, "msg" => "修改失败"]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 生成验证码信息
     */
    public function CaptchaInfo()
    {
        $result = app('captcha')->create();
        Cache::put($result['key'], $result['key'], 30);
        if (isset($result['sensitive'])) {
            unset($result['sensitive']);
        }
        return response()->json(['code' => 0, 'msg' => '成功', 'data' => $result]);
    }

    /**
     * @params key,captcha
     * 两个参数key和验证码
     */
    private function checkcaptcha($key, $captcha)
    {
        return app('captcha')->check(strtolower($captcha), Cache::get($key));
    }


}
