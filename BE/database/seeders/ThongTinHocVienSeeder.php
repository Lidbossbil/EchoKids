<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongTinHocVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy thông tin học viên dựa trên email
        $hocVien = DB::table('nguoi_dungs')->where('email', 'giabao.student@gmail.com')->first();

        if ($hocVien) {
            DB::table('thong_tin_hoc_viens')->updateOrInsert(
                ['nguoi_dung_id' => $hocVien->id],
                [
                    'ngay_sinh' => '2019-05-20',
                    'diem_tich_luy' => 150,
                    'streak_hien_tai' => 5,
                    'ngay_hoc_cuoi_cung' => now()->subDay(),
                ]
            );
        }
    }
}
