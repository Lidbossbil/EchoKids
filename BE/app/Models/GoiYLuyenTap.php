<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoiYLuyenTap extends Model
{
    protected $table = 'goi_y_luyen_taps';

    protected $fillable = [
        'giao_vien_id',
        'hoc_vien_id',
        'noi_dung',
        'da_doc',
    ];
}
