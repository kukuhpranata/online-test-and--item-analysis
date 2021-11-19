<?php

use Illuminate\Database\Seeder;
use App\mPertanyaan;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaan = [
            'Air adalah salah satu sumber daya alam yang sangat penting bagi kehidupan manusia, antara lain berfungsi sebagai …',
            'Selain manusia, tumbuhan juga membutuhkan air antara lain untuk proses ….',
            'Ikan-ikan di sungai akan mati jika tidak ada air, hal ini mennandakan bahwa ada jenis hewan yang membutuhkan air sebagai ….',
            'Kegiatan manusia di bawah ini yang memanfaatkan air dalam bidang pertanian adalah ….',
            'Bu Rani mengambil air di sumur untuk mencuci baju keluarganya yang kotor, hal ini merupakan contoh bahwa air mempunyai fungsi bagi manusia dalam ….',
            'Bagi tumbuhan air juga dapat berfungsi sebagai pelarut ….',
            'Air di bumi mengalami siklus yang terus berputar, proses penguapan air laut dalam siklus air disebut juga dengan ….',
            'Uap air yang ada di atsmosfer akan berubah menjadi titik-titik air ketika suhu udara ….',
            'Air tanah mengalami proses perembesan ke danau atau sungai. Proses ini dinamakan dengan ….',
            'Sebagai manusia kita harus turut serta menjaga kelestarian air di bumi karena ….',
        ];

        $opsi1 = [
            'Sumber barang elektronik',
            'Respirasi',
            'Sumber makanan',
            'Pak Jaya mencuci mobil dengan air sumur',
            'Menjaga kebersihan',
            'Zat hara',
            'Kondensasi',
            'Naik',
            'Respirasi',
            'Option 1',
        ];
        $opsi2 = [
            'Alat untuk membuat tanaman',
            'Fotosintesis',
            'Alat transportasi',
            'Pak Budi memelihara ikan di tambak',
            'Menjaga kemananan',
            'Oksigen',
            'Evaporasi',
            'Stabil',
            'Evaporasi',
            'Option 2'
        ];
        $opsi3 = [
            'Sumber minuman',
            'Pengguguran',
            'Tempat hidupnya',
            'Bu Dwi menggunakan air untuk mencuci piring',
            'Mencegah kekeringan',
            'Cahaya matahari',
            'Presipitasi',
            'Turun',
            'Kondensasi',
            'Option 3'
        ];
        $opsi4 = [
            'Alat untuk bahan bakar',
            'Pelapukan',
            'Alat berkembangbiak',
            'Pak Jayus mengairi sawahnya dengan air sungai',
            'Membunuh penyakit',
            'Hama dan gulma',
            'Infiltrasi',
            'Memanas',
            'Infiltrasi',
            'Option 4'
        ];


        foreach($pertanyaan as $key => $pertanyaan){
            $new_pertanyaan = mPertanyaan::first();
            
            $new_pertanyaan = new mPertanyaan();
            $new_pertanyaan->ujian_id = 1;
            $new_pertanyaan->judul_soal = $pertanyaan;
            
            $new_pertanyaan->opsi1 = $opsi1[$key];
            $new_pertanyaan->opsi2 = $opsi2[$key];
            $new_pertanyaan->opsi3 = $opsi3[$key];
            $new_pertanyaan->opsi4 = $opsi4[$key];
            $new_pertanyaan->opsi5 = 'Semua Salah';
            $new_pertanyaan->jawaban = 1;
            $new_pertanyaan->save();
    }
    }
}
