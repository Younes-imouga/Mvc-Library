<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $fillable = ['username', 'email', 'password', 'role'];
    
}