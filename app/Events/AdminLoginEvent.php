<?php
/**
 *Author:Syskey
 *Date:2022/1/4
 *Time:15:24
 **/


namespace App\Events;


class AdminLoginEvent extends Event
{
    public $login;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($login)
    {
        $this->login = $login;
    }

}