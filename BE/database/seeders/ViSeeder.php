<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViSeeder extends Seeder
{
    public function run(): void
    {
        $nguoiDungIds = DB::table('nguoi_dungs')->pluck('id');

        $data = $nguoiDungIds->map(fn ($id) => [
            'nguoi_dung_id' => $id,
            'so_du' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();

        DB::table('vis')->insertOrIgnore($data);
    }
}
