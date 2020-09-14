<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task', 'tanggal', 'status', 'id_user'];

    public $timestamps = false;
}
