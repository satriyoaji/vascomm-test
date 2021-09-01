<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION', 'mysql') == 'mysql') {
            DB::statement("SET foreign_key_checks=0");
            User::truncate();
            DB::statement("SET foreign_key_checks=1");
        } else {
            User::truncate();
        }
        $users = json_decode(File::get(database_path('datas/user.json')));
        foreach ($users as $user) {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'role' => $user->role,
                'status' => $user->status
            ]);
        }
    }
}
