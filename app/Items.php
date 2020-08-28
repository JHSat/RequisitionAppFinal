<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey = 'item_id';
    public $timestamps = false;
    protected $fillable = ['item_id','itemCode', 'description', 'unit'];
    protected $keyType = 'string';
}
