<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTieLoTrinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loTrinh = DB::table('lo_trinh_ca_nhans')->first();
        // Lấy danh sách ID của các bài học đã tạo
        $baiHocIds = DB::table('bai_hocs')->pluck('id');

        if ($loTrinh && $baiHocIds->isNotEmpty()) {
            foreach ($baiHocIds as $index => $id) {
                DB::table('chi_tiet_lo_trinhs')->updateOrInsert(
                    ['lo_trinh_id' => $loTrinh->id, 'bai_hoc_id' => $id],
                    [
                        'thu_tu_uu_tien' => $index + 1,
                        'ghi_chu_gv' => 'Bé cần chú ý âm đầu bài này',
                        'ngay_tao' => now(),
                    ]
                );
            }
        }
    }
}
