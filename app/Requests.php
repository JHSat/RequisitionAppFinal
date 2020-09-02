<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = ['item_id', 'quantity'];
    public $timestamps = false;
    protected $table = 'requests';
}
