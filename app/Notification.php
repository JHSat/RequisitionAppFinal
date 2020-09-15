<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['req_id', 'user_notif', 'description', 'status'];
    protected $table = 'notifications';
}
