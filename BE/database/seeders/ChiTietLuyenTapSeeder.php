<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietLuyenTapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phiens = DB::table('phien_luyen_taps')->get();
        // Lấy danh sách từ vựng để gán vào phiên luyện tập
        $tuVungs = DB::table('tu_vungs')->limit(5)->get();

        foreach ($phiens as $phien) {
            foreach ($tuVungs as $index => $tv) {
                // Giả lập logic: Một số từ đúng hoàn toàn, một số từ sai lỗi cụ thể
                $isCorrect = (rand(1, 10) > 4); // 60% tỉ lệ phát âm tốt

                DB::table('chi_tiet_luyen_taps')->insert([
                    'phien_id' => $phien->id,
                    'tu_vung_id' => $tv->id,
                    'file_ghi_am_url' => "audio/recordings/phien_{$phien->id}_tv_{$tv->id}.wav",
                    'van_ban_ai_nhan_dien' => $isCorrect ? $tv->tu_chuan : "Từ gần giống {$tv->tu_chuan}",
                    'diem_tin_cay' => rand(70, 99) / 100, // Ví dụ: 0.85
                    'diem_chinh_xac' => $isCorrect ? rand(85, 100) : rand(40, 70),
                    
                    // Giả lập các loại lỗi phát âm
                    'loi_am_dau' => !$isCorrect && (rand(1, 3) == 1),
                    'loi_van' => !$isCorrect && (rand(1, 3) == 2),
                    'loi_thanh_dieu' => !$isCorrect && (rand(1, 3) == 3),
                    
                    'chi_tiet_loi' => !$isCorrect ? "Trẻ phát âm chưa rõ phụ âm đầu hoặc sai dấu thanh." : null,
                    'ngay_tao' => $phien->ngay_tao,
                ]);
            }
        }
    }
}
