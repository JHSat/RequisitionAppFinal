<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = ['item_id', 'transac_code', 'quantity'];
    public $timestamps = false;
    protected $table = 'storage';
    // protected $primaryKey = 'storage_id';
}
