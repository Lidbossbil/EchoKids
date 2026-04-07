<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danhmucs = [
            ['ten_danh_muc' => 'Luyện phát âm Âm tiết', 'mo_ta' => 'Các bài tập về nguyên âm và phụ âm đơn lẻ'],
            ['ten_danh_muc' => 'Từ vựng theo Chủ đề', 'mo_ta' => 'Luyện tập từ vựng qua hình ảnh con vật, đồ vật'],
            ['ten_danh_muc' => 'Câu đơn giao tiếp', 'mo_ta' => 'Luyện phát âm các câu ngắn thông dụng'],
            ['ten_danh_muc' => 'Kiểm tra định kỳ', 'mo_ta' => 'Các bài đánh giá tổng hợp tiến độ'],
        ];
        foreach ($danhmucs as $index => $dm) {
            DB::table('danh_muc_bai_hocs')->updateOrInsert(
                ['ten_danh_muc' => $dm['ten_danh_muc']],
                [
                    'slug_danh_muc' => Str::slug($dm['ten_danh_muc']),
                    'mo_ta' => $dm['mo_ta'],
                    'trang_thai' => 0, // 0 = hiển thị, 1 = tạm ẩn 
                    'thu_tu' => $index + 1,
                    'ngay_tao' => now(),
                ]
            );
        }
    }
}
