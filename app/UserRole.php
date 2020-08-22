<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';
    //protected $primarykey="id"; for other primarykey  istead ‘id’
    protected $fillable=['user_id', 'role_id'];
}
