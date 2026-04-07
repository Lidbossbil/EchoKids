<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiHoc extends Model
{
    protected $table = 'bai_hocs';

    protected $fillable = [
        'danh_muc_id',
        'nguoi_tao_id',
        'tieu_de',
        'mo_ta',
        'cap_do',
        'thu_tu',
        'trang_thai',
    ];
}
