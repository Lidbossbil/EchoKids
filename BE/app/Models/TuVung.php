<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuVung extends Model
{
    protected $table = 'tu_vungs';

    public $timestamps = false;

    protected $fillable = [
        'bai_hoc_id',
        'tu_chuan',
        'phien_am',
        'cap_do',
        'hinh_anh_url',
        'am_thanh_mau_url',
        'thu_tu',
        'ngay_tao',
    ];
}
