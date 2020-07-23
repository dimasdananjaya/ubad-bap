<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAPModel extends Model
{
    public $primaryKey='id_bap';
    public $timestamps=true;

    protected $table='bap';
    protected $fillable=[
        'id_user',
        'id_periode',
        'tanggal',
        'mata_kuliah',
        'sks',
        'jam',
        'materi',
        'jumlah_mahasiswa',
        'file',
    ];
}
