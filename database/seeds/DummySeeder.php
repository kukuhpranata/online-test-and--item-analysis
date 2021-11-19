<?php

use Illuminate\Database\Seeder;
use App\User;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $adminRole = Role::where('name','superadmin')->first();

        // dd($adminRole);

        // if(!$adminRole){
        //     $adminRole = Role::create([
        //         'name' => 'superadmin',
        //         'display_name' => 'Super Admin'
        //     ]);
        // }

        $email = ['auditor@gmail.com','auditee@gmail.com','monitoring@gmail.com','reviewer@gmail.com'];
        $role_id = ['2','3','4','5'];
        
        foreach($email as $key => $mail){
            $users = User::where('email',$mail)->first();
        
            if(!$users)
            {
                $users = new User();
                $users->role_id = $role_id[$key];
                $users->email = $mail;
                // $users->email = $admin_nip.'@gmail.com';
                $users->password = bcrypt('rahasia');
                $users->bag_unit_id = 1;
                $users->obj_audit_id = 1;
                $users->save();
            }

            // if(!$nip_admin->hasRole($adminRole)){
            //     try{
            //         $nip_admin->attachRole($adminRole);
            //     }
            //     catch(Exception $e){
            //         // continue;
            //     }
            // }
        }
    }
}
