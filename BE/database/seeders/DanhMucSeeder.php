<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'ten_danh_muc' => 'Bảng Chữ Cái & Âm Cơ Bản',
                'slug_danh_muc' => 'bang-chu-cai-am-co-ban',
                'mo_ta' => 'Làm quen với nguyên âm, phụ âm, vần và thanh điệu tiếng Việt',
                'trang_thai' => 0,
                'thu_tu' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'ten_danh_muc' => 'Gia Đình & Cơ Thể',
                'slug_danh_muc' => 'gia-dinh-co-the',
                'mo_ta' => 'Từ vựng về các thành viên gia đình và các bộ phận cơ thể người',
                'trang_thai' => 0,
                'thu_tu' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'ten_danh_muc' => 'Thức Ăn & Đồ Uống',
                'slug_danh_muc' => 'thuc-an-do-uong',
                'mo_ta' => 'Từ vựng về trái cây, rau củ, món ăn và đồ uống hằng ngày',
                'trang_thai' => 0,
                'thu_tu' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'ten_danh_muc' => 'Động Vật',
                'slug_danh_muc' => 'dong-vat',
                'mo_ta' => 'Từ vựng về các loài động vật quen thuộc và sinh vật thiên nhiên',
                'trang_thai' => 0,
                'thu_tu' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'ten_danh_muc' => 'Thực Vật & Thiên Nhiên',
                'slug_danh_muc' => 'thuc-vat-thien-nhien',
                'mo_ta' => 'Từ vựng về hoa, cây cối, thiên nhiên và địa hình xung quanh',
                'trang_thai' => 0,
                'thu_tu' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'ten_danh_muc' => 'Trường Học',
                'slug_danh_muc' => 'truong-hoc',
                'mo_ta' => 'Từ vựng về đồ dùng học tập, màu sắc, hình dạng và hoạt động ở trường',
                'trang_thai' => 0,
                'thu_tu' => 6,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'ten_danh_muc' => 'Thế Giới Xung Quanh',
                'slug_danh_muc' => 'the-gioi-xung-quanh',
                'mo_ta' => 'Từ vựng về phương tiện, nghề nghiệp, nơi chốn và thời gian',
                'trang_thai' => 0,
                'thu_tu' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'ten_danh_muc' => 'Giao Tiếp Hằng Ngày',
                'slug_danh_muc' => 'giao-tiep-hang-ngay',
                'mo_ta' => 'Lời chào hỏi, biểu đạt nhu cầu và câu hỏi đơn giản trong sinh hoạt',
                'trang_thai' => 0,
                'thu_tu' => 8,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('danh_muc_bai_hocs')->insert($data);
    }
}
