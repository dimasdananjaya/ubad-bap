<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    public $timestamps=true;
    public $primayKey='id_periode';
    protected $fillable=[
        'periode',
        'status'
    ];
}
