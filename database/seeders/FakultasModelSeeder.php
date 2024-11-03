<?php

namespace Database\Seeders;

use App\Models\FakultasModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [ 
            'FMIPA',
           
        ];

        foreach ($data as $fakultas) {
            Fakultas::create([ 
                'nama_fakultas' => $fakultas,
            ]);
        }       
    }
}
