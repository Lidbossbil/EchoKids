<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
   protected $table = 'thong_baos';

    protected $fillable = [
        'nguoi_nhan_id',
        'tieu_de',
        'noi_dung',
        'loai',
        'duong_dan',
        'da_doc',
    ];
}
