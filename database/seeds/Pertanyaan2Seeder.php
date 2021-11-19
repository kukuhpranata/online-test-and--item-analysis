<?php

use Illuminate\Database\Seeder;
use App\mPertanyaan;

class Pertanyaan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaan = [
            'Komponen fisik yang membentuk sistem komputer adalah ....',
            'Hardware yang berfungsi sebagai alat penunjuk untuk mengatur posisi kursor di layar adalah ….',
            'Pimpinan unit yang bertanggung jawab atas keseluruhan proses berlangsungnya pekerjaan komputer, yang merupakan pejabat eselon tertinggi di bidang IT... ',
            'Bilangan heksadesimal adalah bilangan yang berbasis ....',
            '227(10) dikonversikan ke sistem biner mempunyai nilai ....',
            'Berikut ini merupakan application software, kecuali ….',
            'Dalam Kode BCD menggunakan kode biner sebanyak ... Bit ',
            'Sistem komputer terdiri dari 3 (tiga) unsur berikut, kecuali .... ',
            'Tujuan pokok system computer adalah ….',
            'C7(16 ) Bilangan Heksadimal dikonversikan ke sistem biner mempunyai nilai .... ',
            'Berikut ini merupakan contoh dari brainware, kecuali …',
            'Yang bukan merupakan Perangkat external Storage yaitu ....',
            'Berikut ini merupakan definisi dari komputer, kecuali ....',
            'Komponen yang berfungsi untuk membentuk fungsi-fungsi pengolahan data komputer adalah ....',
            'Register merupakan bagian yang dari unit CPU yang bertugas ....',

        ];

        $opsi1 = [
            'Brainware',
            'Monitor',
            'Data Processing Manager',
            'Bilangan yang berbasis 2 yaitu 0 dan 1',
            '11001111',
            'Ubuntu',
            '2',
            'Brainware',
            'Mengolah input menjadi proses',
            '11000111(2)',
            'Programmer',
            'DVD',
            'Sebuah mesin hitung',
            'Control Unit',
            'Sebagai penyimpan internal bagi CPU',
        ];

        $opsi2 = [
            'Mailware',
            'Printer',
            'System Analyst',
            'Bilangan yang berbasis 16 yaitu 0 dan 17',
            '11100011',
            'Microsoft office',
            '3',
            'Mailware',
            'Mengolah output menjadi input',
            '11001111(2)',
            'Operator',
            'CD ROM',
            'Mesin elektronik',
            'Register',
            'Sebagai penghubung seluruh bagian dari CPU',
        ];
        $opsi3 = [
            'Hardware',
            'Mouse',
            'Programmers',
            'Bilangan yang berbasis 10 yaitu 0 – 9',
            '11110101',
            'Photoshop',
            '4',
            'Hardware',
            'Mengolah output jadi proses',
            '11111000(2)',
            'System Analyst',
            'Progam Storage',
            'Menerima informasi masukan',
            'CPU Interconnection',
            'Sebagai pembentuk fungsi-fungsi pengolahan data komputer',
        ];
        $opsi4 = [
            'Software',
            'Speaker',
            'Machine Operator',
            'Bilangan yang berbasis 8 yaitu 0 – 7',
            '1110011',
            'RAM',
            '6',
            'Software',
            'Mengolah informasi jadi output',
            '11110001(2)',
            'Spyware',
            'Floppy Disk',
            'Mengolah informasi',
            'Arithmetic And Logic Unit',
            'Sebagai pengontrol operasi secara keseluruhan',
        ];

        $opsi5 = [
            'Malware',
            'Scanner',
            'Data Entry Operator',
            'Bilangan yang berbasis 16 yaitu 0 – 9',
            '1110111',
            'Coreldraw',
            '8',
            'Semua Salah',
            'Mengolah data menjadi imformasi',
            '11111101(2)',
            'Proktor',
            'Hard Disk',
            'Mesin mekanik',
            'I/O',
            'Sebagai unit pemindahan data ke lingkungan luar',
        ];

        $jawaban =[
            3,3,1,5,2,4,3,2,5,4,4,3,2,4,1,
        ];


        foreach($pertanyaan as $key => $pertanyaan){
            $new_pertanyaan = mPertanyaan::first();
            
            $new_pertanyaan = new mPertanyaan();
            $new_pertanyaan->ujian_id = 2;
            $new_pertanyaan->judul_soal = $pertanyaan;
            
            $new_pertanyaan->opsi1 = $opsi1[$key];
            $new_pertanyaan->opsi2 = $opsi2[$key];
            $new_pertanyaan->opsi3 = $opsi3[$key];
            $new_pertanyaan->opsi4 = $opsi4[$key];
            $new_pertanyaan->opsi5 = $opsi5[$key];
            $new_pertanyaan->jawaban = $jawaban[$key];
            $new_pertanyaan->save();
    }
    }
}
