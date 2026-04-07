<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTroQuyen extends Model
{
    protected $table = 'vai_tro_quyens';

    protected $fillable = [
        'vai_tro_id',
        'quyen_id',
    ];
}
