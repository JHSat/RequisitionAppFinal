<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'req_id',
        'transac_code',
        'requestee',
        'requestedDate',
        'status',
        'authorizedBy',
        'authorizedDate',
        'confirmedBy',
        'confirmedDate',
        'processedDate'
    ];
    public $timestamps = true;
    protected $table = 'requests';
    protected $keyType = 'string';
    protected $primaryKey = 'req_id';
}
