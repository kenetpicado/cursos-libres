<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => "Administrador",
            'email' => "admin@master.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        //alumnos
        \App\Models\Alumno::factory(50)->create();

        //cursos
        \App\Models\Curso::factory(10)->create();

        //docentes
        \App\Models\Docente::factory(50)->create();

        //grupos
        \App\Models\Grupo::factory(10)->create();

    }
}
