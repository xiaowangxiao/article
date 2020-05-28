<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fields = ['id','name','password','created_at','updated_at'];

}
