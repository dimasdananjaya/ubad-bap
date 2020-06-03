<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAPModel extends Model
{
    public $primaryKey='id_bap';
    public $timestamps=true;
    protected $fillable=[
        'id_user',
        'tanggal',
        'mata_kuliah',
        'sks',
        'waktu'
    ];
}
