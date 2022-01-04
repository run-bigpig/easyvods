<?php
/**
 *Author:Syskey
 *Date:2022/1/4
 *Time:15:29
 **/


namespace App\Listeners;


use App\Events\AdminLoginEvent;

class AdminLoginListener
{
    public function __construct()
    {

    }

    public function handle(AdminLoginEvent $event)
    {
        $admin = $event->login;
        if (request()->server('HTTP_X_FORWARDED_FOR')) {
            $login_ip = request()->server('HTTP_X_FORWARDED_FOR');
        } else {
            $login_ip = request()->getClientIp();
        }
        $admin->update(["nowloginip" => $login_ip, "nowlogintime" => date("Y-m-d H:i:s", time()), "lastloginip" => $admin->nowloginip, "lastlogintime" => $admin->nowlogintime]);
    }
}