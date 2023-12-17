<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $data = [
                [
                    'name' => 'Alice',
                    'email' => 'alice@mail.com',
                    'password' => '123456',
                ],
                [
                    'name' => 'Bob',
                    'email' => 'bob@mail.com',
                    'password' => '123456',
                ],
                
            ];

            foreach ($data as $key => $value) {
                DB::table('users')->Insert([
                    'name' => $value['name'],
                    'email' => $value['email'],
                    'password' => Hash::make($value['password']),
                ]);
            }

           
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
        }
    }
}
