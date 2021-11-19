<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['admin','peserta'];
        $display_name = ['Admin','Peserta'];

        foreach($name as $key => $nama){
            
            $new_role = Role::first();
            
                $new_role = new Role();
                $new_role->display_name = $display_name[$key];
                $new_role->name = $nama;
                $new_role->save();
        }
    }
}
