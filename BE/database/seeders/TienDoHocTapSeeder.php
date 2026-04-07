<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TienDoHocTapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hocVien = DB::table('nguoi_dungs')->where('email', 'giabao.student@gmail.com')->first();
        $tuVungs = DB::table('tu_vungs')->get();

        if ($hocVien) {
            foreach ($tuVungs as $tv) {
                DB::table('tien_do_hoc_taps')->updateOrInsert(
                    ['nguoi_dung_id' => $hocVien->id, 'tu_vung_id' => $tv->id],
                    [
                        'trang_thai' => 'da_dat', // da_dat, cho_duyet, can_luyen_them
                        'so_lan_luyen_tap' => rand(1, 10),
                        'diem_cao_nhat' => rand(80, 100),
                        'ngay_cap_nhat_cuoi' => now(),
                    ]
                );
            }
        }
    }
}
