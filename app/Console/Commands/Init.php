<?php

namespace App\Console\Commands;

use App\Models\EvAdmin;
use Illuminate\Console\Command;

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
            echo "用户初始化成功\n";
        } else {
            echo "用户初始化失败\n";
        }
    }
}
