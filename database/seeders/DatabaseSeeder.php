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
       // \App\Models\User::factory(10)->create();
        DB::table('roles')->insert([
            'nom'=>'Etudiant',
            'description'=>'étudiant'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Formateur',
            'description'=>'Formateur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Tuteur',
            'description'=>'Formateur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Superviseur',
            'description'=>'Formateur'
        ]);
        DB::table('roles')->insert([
            'nom'=>'Admin',
            'description'=>'Formateur'
        ]);

        DB::table('users')->insert([
            'nom' => 'LUNGU',
            'prenom' => 'LUNGU',
            'email' => 'patrick.lungu@live.fr',
            'Date_naissance'=>'1998-05-09',
            'Lieu_naissance'=>'Moldavie',
            'Nationalite'=>'Français',
            'password' => Hash::make('password'),
            'role_id'=>'5'
        ]);
        DB::table('users')->insert([
            'nom' => 'MEHDI',
            'prenom' => 'CHARIF',
            'email' => 'mehdi@imie.fr',
            'Date_naissance'=>'1998-05-09',
            'Lieu_naissance'=>'Moldavie',
            'Nationalite'=>'Français',
            'password' => Hash::make('password'),
            'role_id'=>'5'
        ]);
        
        
        DB::table('users')->insert([
            'nom' => 'formateur',
            'prenom' => 'formateur',
            'email' => 'formateur@imie.fr',
            'Date_naissance'=>'1998-05-09',
            'Lieu_naissance'=>'Moldavie',
            'Nationalite'=>'Français',
            'password' => Hash::make('password'),
            'role_id'=>'2'
        ]);
        DB::table('users')->insert([
            'nom' => 'etudiant',
            'prenom' => 'etudiant',
            'email' => 'aa@a.fr',
            'Date_naissance'=>'1998-05-09',
            'Lieu_naissance'=>'Moldavie',
            'Nationalite'=>'Français',
            'password' => Hash::make('password'),
            'role_id'=>'1'
        ]);
    }
}
