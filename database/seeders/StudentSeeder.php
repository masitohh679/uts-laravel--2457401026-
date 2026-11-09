<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::query()->updateOrCreate(['nim' => '2457401026'], [
            'name' => 'Alya Putri Ramadhani',
            'classroom' => 'X IPA 1',
            'birth_date' => '2008-05-14',
            'average_score' => 92.50,
            'is_active' => true,
            'address' => 'Jl. Melati No. 12, Bandar Lampung',
            'parent_phone' => '0813-2222-3333',
        ]);

        Student::query()->updateOrCreate(['nim' => '2457401027'], [
            'name' => 'Rizky Maulana',
            'classroom' => 'X IPS 1',
            'birth_date' => '2008-09-02',
            'average_score' => 87.25,
            'is_active' => true,
            'address' => 'Jl. Kenanga No. 8, Bandar Lampung',
            'parent_phone' => '0812-3456-7890',
        ]);

        Student::query()->updateOrCreate(['nim' => '2457401028'], [
            'name' => 'Nadia Safitri',
            'classroom' => 'XI IPA 2',
            'birth_date' => '2007-12-19',
            'average_score' => 89.75,
            'is_active' => false,
            'address' => 'Jl. Mawar No. 21, Bandar Lampung',
            'parent_phone' => '0821-1234-5678',
        ]);
    }
}
