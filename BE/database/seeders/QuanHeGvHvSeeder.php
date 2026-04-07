<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuanHeGvHvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $giaoVien = DB::table('nguoi_dungs')->where('email', 'maiphuong.gv@gmail.com')->first();
        $hocVien = DB::table('nguoi_dungs')->where('email', 'giabao.student@gmail.com')->first();

        if ($giaoVien && $hocVien) {
            DB::table('quan_he_gv_hvs')->updateOrInsert(
                [
                    'giao_vien_id' => $giaoVien->id,
                    'hoc_vien_id' => $hocVien->id,
                ],
                [
                    'trang_thai' => 'dang_theo_doi',
                    'ngay_ket_noi' => now(),
                ]
            );
        }
    }
}
