<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = "admin@example.com";
        $user->nama ="Admin";
        $user->password = bcrypt('rahasia');
        $user->role_id = 1;
        $user->status_akun = 2;
        $user->save();

        $user = new User();
        $user->email = "peserta1@example.com";
        $user->nama ="Peserta1";
        $user->password = bcrypt('rahasia');
        $user->role_id = 2;
        $user->status_akun = 2;
        $user->save();

        $nama = ['Peserta2','Peserta3','Peserta4','Peserta5','Peserta6','Peserta7','Peserta8','Peserta9','Peserta10',
        'Muslim ganteng', 'Agung Budi Prakoso', 'Rafli Adhiyaksa Putra', 'Nareswari Dyah Puspaningrum', 'Ara Fasaka Ardanta',
        'Muhammad Fadhli Hisyam', 'Moch Chamdan Erbono', 'Daffa SH', 'Prio Pambudi', 'Doni Hermawan',
    
    ];
        $email = ['peserta2@example.com','peserta3@example.com','peserta4@example.com'
        ,'peserta5@example.com','peserta6@example.com','peserta7@example.com'
        ,'peserta8@example.com','peserta9@example.com','peserta10@example.com'
        ,'muslim@gmail.com', 'bepe@gmail.com', 'rafli@gmail.com', 'nares@gmail.com', 'ara@gmail.com'
        ,'fadhli@gmail.com', 'chamdan@gmail.com', 'shidqi@gmail.com', 'prio@gmail.com', 'doni@gmail.com',
    
    ];


        foreach($nama as $key => $nama){
            $new_user = User::first();
            
            $new_user = new User();
            $new_user->nama = $nama;
            $new_user->email = $email[$key];
            $new_user->password = bcrypt('rahasia');
            $new_user->role_id = 2;
            $new_user->status_akun = 2;
            $new_user->save();
    }
}
}