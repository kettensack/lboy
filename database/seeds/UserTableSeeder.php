<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();
        $role_pruefer = Role::where('name','pruefer')->first();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@mail.com';
        $admin->password = bcrypt('welcome');
        $admin->save();
        $admin->roles()->attach($role_admin);
        
        $pruefer = new User();
        $pruefer->name = 'pruefer';
        $pruefer->email = 'pruefer@mail.com';
        $pruefer->password = bcrypt('welcome');
        $pruefer->save();
        $pruefer->roles()->attach($role_pruefer);

        $user = new User();
        $user->name = 'user';
        $user->email = 'user@mail.com';
        $user->password = bcrypt('welcome');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
