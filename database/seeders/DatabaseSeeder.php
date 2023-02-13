<?php

namespace Database\Seeders;
use  App\Models\ProductOrder;
use App\Models\Role;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->slug = 'admin';
        $adminRole->save();

        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->slug = 'user';
        $userRole->save();

        ProductOrder::factory()->count(1000)->create();
        $admin = Role::where('slug','admin')->first();
        $user1 = new User();
        $user1->name = 'admin';
        $user1->email = 'admin@example.com';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($admin);
       
        $user = Role::where('slug','user')->first();
        $user2 = new User();
        $user2->name = 'user';
        $user2->email = 'user@example.com';
        $user2->password = bcrypt('secret');
        $user2->save();
        $user2->roles()->attach($user);

    }
}
