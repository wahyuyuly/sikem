<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\User;
use App\Role;
use App\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new Role;
        $superAdmin->name = 'super-admin';
        $superAdmin->display_name = 'Super Admin';
        $superAdmin->save();

        $adminBerita = new Role();
        $adminBerita->name = 'admin-berita';
        $adminBerita->display_name = 'Admin Berita';
        $adminBerita->save();

        $adminJurusan = new Role();
        $adminJurusan->name = 'admin-jurusan';
        $adminJurusan->display_name = 'Admin Jurusan';
        $adminJurusan->save();

        $bem = new Role();
        $bem->name = 'bem';
        $bem->display_name = 'BEM';
        $bem->save();

        $mahasiswa = new Role();
        $mahasiswa->name = 'mahasiswa';
        $mahasiswa->display_name = 'Mahasiswa';
        $mahasiswa->save();        

        $manageUser = new Permission();
        $manageUser->name = 'kelola-pengguna';
        $manageUser->display_name = 'Kelola Pengguna'; // optional
        $manageUser->description  = 'Mengelola pengguna aplikasi'; // optional
        $manageUser->save();
        $superAdmin->attachPermission($manageUser);

        $manageMahasiswa = new Permission();
        $manageMahasiswa->name = 'kelola-mahasiswa';
        $manageMahasiswa->display_name = 'Kelola Data Mahasiswa'; // optional
        $manageMahasiswa->description = 'Mengelola data mahasiswa'; // optional
        $manageMahasiswa->save();
        $superAdmin->attachPermission($manageMahasiswa);
        $adminJurusan->attachPermission($manageMahasiswa);

        $manageMaster = new Permission();
        $manageMaster->name = 'kelola-master';
        $manageMaster->display_name = 'Kelola Master Data'; // optional
        $manageMaster->description = 'Mengelola master data aplikasi'; // optional
        $manageMaster->save();
        $superAdmin->attachPermission($manageMaster);

        $manageNews = new Permission();
        $manageNews->name = 'kelola-berita';
        $manageNews->display_name = 'Kelola Portal Berita'; // optional
        $manageNews->description = 'Mengelola portal berita'; // optional
        $manageNews->save();
        $superAdmin->attachPermission($manageNews);
        $adminBerita->attachPermission($manageNews);
        $bem->attachPermission($manageNews);

        $user = new User();
        $user->name = 'Maulidya Laila Izati';
        $user->username = 'lidya';
        $user->email = 'lidya@sikem.id';
        $user->password = bcrypt('tes123');
        $user->photo = 'foto.jpg';
        $user->status = 'active';
        $user->save();
        $user->attachRole($superAdmin);

        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 3; $i++){
            $user = new User();
            $user->name = $faker->name;
            $user->username = $faker->username;
            $user->email = $faker->email;
            $user->password = bcrypt('tes123');
            $user->status = $faker->randomElement($array = array ('pending', 'active', 'non-active'));
            $user->save();
            $user->attachRole($adminBerita);
        }
        
        for($i = 1; $i <= 3; $i++){
            $user = new User();
            $user->name = $faker->name;
            $user->username = $faker->username;
            $user->email = $faker->email;
            $user->password = bcrypt('tes123');
            $user->status = $faker->randomElement($array = array ('pending', 'active', 'non-active'));
            $user->save();
            $user->attachRole($adminJurusan);
        }
        
        for($i = 1; $i <= 3; $i++){
            $user = new User();
            $user->name = $faker->name;
            $user->username = $faker->username;
            $user->email = $faker->email;
            $user->password = bcrypt('tes123');
            $user->status = $faker->randomElement($array = array ('pending', 'active', 'non-active'));
            $user->save();
            $user->attachRole($bem);
    	}
 
    	// for($i = 1; $i <= 20; $i++){
        //     $user = new User();
        //     $user->name = $faker->name;
        //     $user->username = $faker->regexify('[1][2-8][20-22][0-9]{6}');
        //     $user->email = $faker->email;
        //     $user->password = bcrypt('tes123');
        //     $user->status = $faker->randomElement($array = array ('pending', 'active', 'non-active'));
        //     $user->save();
        //     $user->attachRole($mahasiswa);
    	// }        
    }
}
