<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name'];
    protected $table = 'department';
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
