<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAPFileModel extends Model
{
    public $primaryKey='id_bap_file';
    public $timestamps=true;

    protected $fillable=[
        'file',
    ];
}
