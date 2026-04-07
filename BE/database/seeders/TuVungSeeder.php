<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TuVungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baiHocLN = DB::table('bai_hocs')->where('tieu_de', 'like', '%L và N%')->first();
        $baiHocHocTap = DB::table('bai_hocs')->where('tieu_de', 'like', '%Đồ dùng học tập%')->first();
        $baiHocPhongKhach = DB::table('bai_hocs')->where('tieu_de', 'like', '%Phòng khách%')->first();
        $baiHocPhongBep = DB::table('bai_hocs')->where('tieu_de', 'like', '%Phòng bếp%')->first();

        $data = [
            // CHỦ ĐỀ L VÀ N (Dành cho trẻ ngọng)
            ['tu' => 'Quả na', 'pa' => 'Quả na', 'cd' => 'de', 'bh' => $baiHocLN->id ?? null],
            ['tu' => 'Cái lá', 'pa' => 'Cái lá', 'cd' => 'de', 'bh' => $baiHocLN->id ?? null],
            ['tu' => 'Lúa ngô', 'pa' => 'Lúa ngô', 'cd' => 'trung_binh', 'bh' => $baiHocLN->id ?? null],
            ['tu' => 'Con lợn', 'pa' => 'Con lợn', 'cd' => 'de', 'bh' => $baiHocLN->id ?? null],
            ['tu' => 'Nụ cười', 'pa' => 'Nụ cười', 'cd' => 'trung_binh', 'bh' => $baiHocLN->id ?? null],

            // CHỦ ĐỀ ĐỒ DÙNG HỌC TẬP
            ['tu' => 'Bút chì', 'pa' => 'Bút chì', 'cd' => 'de', 'bh' => $baiHocHocTap->id ?? null],
            ['tu' => 'Thước kẻ', 'pa' => 'Thước kẻ', 'cd' => 'de', 'bh' => $baiHocHocTap->id ?? null],
            ['tu' => 'Cặp sách', 'pa' => 'Cặp sách', 'cd' => 'trung_binh', 'bh' => $baiHocHocTap->id ?? null],
            ['tu' => 'Quyển vở', 'pa' => 'Quyển vở', 'cd' => 'trung_binh', 'bh' => $baiHocHocTap->id ?? null],
            ['tu' => 'Cục tẩy', 'pa' => 'Cục tẩy', 'cd' => 'de', 'bh' => $baiHocHocTap->id ?? null],
            ['tu' => 'Hộp màu', 'pa' => 'Hộp màu', 'cd' => 'de', 'bh' => $baiHocHocTap->id ?? null],

            // CHỦ ĐỀ PHÒNG KHÁCH
            ['tu' => 'Bàn ghế', 'pa' => 'Bàn ghế', 'cd' => 'de', 'bh' => $baiHocPhongKhach->id ?? null],
            ['tu' => 'Tivi', 'pa' => 'Ti vi', 'cd' => 'de', 'bh' => $baiHocPhongKhach->id ?? null],
            ['tu' => 'Quạt trần', 'pa' => 'Quạt trần', 'cd' => 'trung_binh', 'bh' => $baiHocPhongKhach->id ?? null],
            ['tu' => 'Bình hoa', 'pa' => 'Bình hoa', 'cd' => 'de', 'bh' => $baiHocPhongKhach->id ?? null],
            ['tu' => 'Đồng hồ', 'pa' => 'Đồng hồ', 'cd' => 'de', 'bh' => $baiHocPhongKhach->id ?? null],
            ['tu' => 'Thảm cỏ', 'pa' => 'Thảm cỏ', 'cd' => 'trung_binh', 'bh' => $baiHocPhongKhach->id ?? null],

            // CHỦ ĐỀ PHÒNG BẾP
            ['tu' => 'Cái bát', 'pa' => 'Cái bát', 'cd' => 'de', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Đôi đũa', 'pa' => 'Đôi đũa', 'cd' => 'trung_binh', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Tủ lạnh', 'pa' => ' Tủ lạnh', 'cd' => 'trung_binh', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Cái thìa', 'pa' => 'Cái thìa', 'cd' => 'de', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Nồi cơm', 'pa' => 'Nồi cơm', 'cd' => 'de', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Bếp gas', 'pa' => 'Bếp ga', 'cd' => 'trung_binh', 'bh' => $baiHocPhongBep->id ?? null],
            ['tu' => 'Ấm nước', 'pa' => 'Ấm nước', 'cd' => 'de', 'bh' => $baiHocPhongBep->id ?? null],
        ];

        foreach ($data as $index => $item) {
            if ($item['bh']) { // Chỉ chèn nếu bài học tồn tại
                DB::table('tu_vungs')->updateOrInsert(
                    ['tu_chuan' => $item['tu']],
                    [
                        'bai_hoc_id' => $item['bh'],
                        'phien_am' => $item['pa'],
                        'cap_do' => $item['cd'],
                        'hinh_anh_url' => 'images/vocabulary/' . Str::slug($item['tu']) . '.png',
                        'am_thanh_mau_url' => 'audio/samples/' . Str::slug($item['tu']) . '.mp3',
                        'thu_tu' => $index + 1,
                        'ngay_tao' => now(),
                    ]
                );
            }
        }
    }
}
