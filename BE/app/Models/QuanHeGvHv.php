<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanHeGvHv extends Model
{
    protected $table = 'quan_he_gv_hvs';

    protected $fillable = [
        'giao_vien_id',
        'hoc_vien_id',
        'trang_thai',
        'ngay_ket_noi',
    ];
}
