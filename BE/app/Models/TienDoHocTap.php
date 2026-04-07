<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TienDoHocTap extends Model
{
    protected $table = 'tien_do_hoc_taps';

    public $timestamps = false;

    protected $fillable = [
        'nguoi_dung_id',
        'tu_vung_id',
        'trang_thai',
        'so_lan_luyen_tap',
        'diem_cao_nhat',
        'ngay_cap_nhat_cuoi',
    ];
}
