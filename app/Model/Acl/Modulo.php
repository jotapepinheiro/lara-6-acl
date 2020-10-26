<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';

    protected $hidden = array('pivot');

    protected $fillable = [
        'name', 'display_name', 'description'
    ];
}
