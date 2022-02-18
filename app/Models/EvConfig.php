<?php
/**
 *Author:Syskey
 *Date:2021/12/29
 *Time:19:18
 **/


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EvConfig extends Model
{
   protected $fillable = ["name","logo","email","icp","keywords","content","tj","notice","method","template","cache","status"];
}
