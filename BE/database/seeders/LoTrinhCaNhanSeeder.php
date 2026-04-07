<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoTrinhCaNhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $giaoVien = DB::table('nguoi_dungs')->where('email', 'maiphuong.gv@gmail.com')->first();
        $hocVien = DB::table('nguoi_dungs')->where('email', 'giabao.student@gmail.com')->first();

        if ($giaoVien && $hocVien) {
            DB::table('lo_trinh_ca_nhans')->updateOrInsert(
                [
                    'giao_vien_id' => $giaoVien->id,
                    'hoc_vien_id' => $hocVien->id,
                ],
                [
                    'ten_lo_trinh' => 'Lộ trình khắc phục ngọng L và N (Tháng 4)',
                    'ngay_tao' => now(),
                ]
            );
        }
    }
}
