<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhienLuyenTapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hocVien = DB::table('nguoi_dungs')->where('email', 'giabao.student@gmail.com')->first();
        $baiHoc = DB::table('bai_hocs')->first();

        if ($hocVien && $baiHoc) {
            // Tạo 5 phiên học trong 5 ngày gần nhất
            for ($i = 5; $i >= 1; $i--) {
                DB::table('phien_luyen_taps')->insert([
                    'nguoi_dung_id' => $hocVien->id,
                    'bai_hoc_id' => $baiHoc->id,
                    'tong_diem' => rand(60, 95), // Điểm ngẫu nhiên tăng dần để thấy sự tiến bộ
                    'thoi_gian_bat_dau' => now()->subDays($i)->setTime(8, 0),
                    'thoi_gian_ket_thuc' => now()->subDays($i)->setTime(8, 30),
                    'ngay_tao' => now()->subDays($i),
                ]);
            }
        }
    }
}
