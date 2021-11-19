<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UjianSeeder::class);
        $this->call(PertanyaanSeeder::class);
        $this->call(JawabanSeeder::class);
        $this->call(JawabanSeeder2::class);
        $this->call(JawabanSeeder3::class);
        $this->call(JawabanSeeder4::class);
        $this->call(JawabanSeeder5::class);
        $this->call(JawabanSeeder6::class);
        $this->call(JawabanSeeder7::class);
        $this->call(JawabanSeeder8::class);
        $this->call(JawabanSeeder9::class);
        $this->call(JawabanSeeder10::class);
        $this->call(EnrollSeeder::class);

        $this->call(Ujian2Seeder::class);
        $this->call(Pertanyaan2Seeder::class);
        $this->call(Jawaban2Seeder::class);
        $this->call(Jawaban2Seeder2::class);
        $this->call(Jawaban2Seeder3::class);
        $this->call(Jawaban2Seeder4::class);
        $this->call(Jawaban2Seeder5::class);
        $this->call(Jawaban2Seeder6::class);
        $this->call(Jawaban2Seeder7::class);
        $this->call(Jawaban2Seeder8::class);
        $this->call(Jawaban2Seeder9::class);
        $this->call(Jawaban2Seeder10::class);
        $this->call(Enroll2Seeder::class);
    }
}
