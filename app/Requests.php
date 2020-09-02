<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = ['req_id', 'transac_code', 'requestee', 'processed_date', 'processed_by', 'approved_by', 'status'];
    public $timestamps = false;
    protected $table = 'requests';
    protected $keyType = 'string';
    protected $primaryKey = 'req_id';
}
