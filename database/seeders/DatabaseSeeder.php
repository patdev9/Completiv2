<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        DB::table('roles')->insert([
            'nom'=>'Etudiant'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Formateur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Tuteur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Superviseur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Admin'
        ]);

        DB::table('users')->insert([
            'nom' => 'LUNGU',
            'prenom' => 'LUNGU',
            'email' => 'patrick.lungu@live.fr',
            'password' => Hash::make('password'),
            'role_id'=>'5'
        ]);
        DB::table('users')->insert([
            'nom' => 'MEHDI',
            'prenom' => 'CHARIF',
            'email' => 'mehdi@imie.fr',
            'password' => Hash::make('password'),
            'role_id'=>'5'
        ]);
        
        DB::table('users')->insert([
            'nom' => 'formateur',
            'prenom' => 'formateur',
            'email' => 'formateur@imie.fr',
            'password' => Hash::make('password'),
            'role_id'=>'2'
        ]);
        DB::table('status')->insert([
            'statu' => 'a justifier',
        ]);
        DB::table('status')->insert([
            'statu' => 'justifier',
        ]);
        DB::table('status')->insert([
            'statu' => 'en cours de traitement',
        ]);
        DB::table('status')->insert([
            'statu' => 'Non recevable',
        ]);
    }
}
