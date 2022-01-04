# EasyVod使用方法

1.建议环境
- php7.4+
- mysql5.6+
- composer 2.0

2.php扩展
- fileinfo
- putenv
- proc_open

3.配置.env
- 修改根目录下.env 文件里的数据库链接信息

4.执行如下命令
- //安装扩展  composer install 
- //迁移数据库  php artisan migrate -v 
- //初始化后台管理员 php artisan init admin admin 

5.伪静态
````
location / {  
	try_files $uri $uri/ /index.php$is_args$query_string;  
}  
````

6.后台地址
- 登录地址 http://xxx/easyvod/login
- 后台首页地址 http://xxx/easyvod/admin

7.注意事项
- 使用宝塔安装的时候 需要设置根目录用户组 chown www:www -R ./*

