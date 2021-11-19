<?php

use Illuminate\Database\Seeder;
use App\mOrganization;
use App\Role;
use Carbon\Carbon;
use App\User;

class AdminCompSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sdmRole  = Role::where('name', 'admin_sdm')->first();

        if(!$sdmRole){
            $sdmRole = new Role();
            $sdmRole->name = "admin_sdm";
            $sdmRole->display_name = "Admin SDM";
            $sdmRole->save();
        }

        $organizations = mOrganization::get();
                
        foreach($organizations as $key => $org){
            $user = new User();
            $user->org_id = $org->id;
            $user->join_org_id = $org->id;
            $user->name = "Admin SDM " . $org->org_code;
            $user->nip = "admin_sdm_" . $org->org_code;
            $user->email = "admin_sdm_" . $org->org_code . '@inkagroup.id';
            $user->password = bcrypt('asdm');
            $user->sex = "L";
            $user->address = "Jalan Yos Sudarso";
            $user->address_city = "Madiun";
            $birth = Carbon::today()->subYear(25+$key)->subMonth($key)->addDay($key)->toDateString();
            $user->birthday = $birth;
            $user->birth_city = "Madiun";
            $user->nik = 100000000000 + $key;
            $user->phone_number = 200000000000 + $key;
            // $user->photo_path = "/";
            $user->join_date = Carbon::today()->toDateString();
            $user->save();

            $user->attachRole($sdmRole);
        }
                
    }
}
