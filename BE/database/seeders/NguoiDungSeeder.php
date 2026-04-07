<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy ID của các vai trò từ bảng vai_tro
        $adminRole = DB::table('vai_tros')->where('ten_vai_tro', 'admin')->first()->id;
        $gvRole = DB::table('vai_tros')->where('ten_vai_tro', 'giao_vien')->first()->id;
        $hvRole = DB::table('vai_tros')->where('ten_vai_tro', 'nguoi_dung')->first()->id;

        $users = [
            [
                'ho_ten' => 'Quản trị viên EchoKids',
                'email' => 'admin@echokids.edu.vn',
                'mat_khau' => Hash::make('123456'),
                'sdt'   => '0123456789',
                'vai_tro_id' => $adminRole,
                'trang_thai' => 0, // hoat_dong
            ],
            [
                'ho_ten' => 'Cô giáo Mai Phương',
                'email' => 'maiphuong.gv@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'sdt'   => '0987654321',
                'vai_tro_id' => $gvRole,
                'trang_thai' => 0,
            ],
            [
                'ho_ten' => 'Học viên Nhí Gia Bảo',
                'email' => 'giabao.student@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'sdt'   => '0912345678',
                'vai_tro_id' => $hvRole,
                'trang_thai' => 0,
            ],
        ];

        foreach ($users as $user) {
            DB::table('nguoi_dungs')->updateOrInsert(['email' => $user['email']], $user);
        }
    }
}
