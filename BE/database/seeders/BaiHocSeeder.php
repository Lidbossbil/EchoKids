<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaiHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy ID danh mục và giáo viên mẫu
        $danhMucAmTiet = DB::table('danh_muc_bai_hocs')->where('ten_danh_muc', 'Luyện phát âm Âm tiết')->first()->id;
        $giaoVienId = DB::table('nguoi_dungs')->where('email', 'maiphuong.gv@gmail.com')->first()->id;

        $baihocs = [
            [
                'tieu_de' => 'Phát âm phụ âm L và N',
                'mo_ta' => 'Bài học giúp bé phân biệt cách đặt lưỡi khi phát âm L và N.',
                'cap_do' => 'trung_binh',
            ],
            [
                'tieu_de' => 'Luyện dấu hỏi và dấu ngã',
                'mo_ta' => 'Phân biệt cao độ của các từ vựng có dấu hỏi và dấu ngã.',
                'cap_do' => 'kho',
            ],
            [
                'tieu_de' => 'Các nguyên âm đơn cơ bản',
                'mo_ta' => 'Luyện tập phát âm tròn vành rõ chữ các âm a, o, e.',
                'cap_do' => 'de',
            ],
        ];

        foreach ($baihocs as $index => $bh) {
            DB::table('bai_hocs')->updateOrInsert(
                ['tieu_de' => $bh['tieu_de']],
                [
                    'danh_muc_id' => $danhMucAmTiet,
                    'nguoi_tao_id' => $giaoVienId,
                    'mo_ta' => $bh['mo_ta'],
                    'cap_do' => $bh['cap_do'],
                    'thu_tu' => $index + 1,
                    'trang_thai' => 1,
                ]
            );
        }
    }
}
