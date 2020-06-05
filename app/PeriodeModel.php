<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    public $timestamps=true;
    public $primaryKey='id_periode';
    protected $table='periode';
    protected $fillable=[
        'periode',
        'status'
    ];
}
