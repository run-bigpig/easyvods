<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:15:33
 **/

return [
    'paths' => [
        base_path("center"),
        base_path("templates")
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),
];
