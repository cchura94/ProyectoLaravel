<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        // insertar roles a la tabla
        $r1 = new Role;
        $r1->nombre = "Admin";
        $r1->save();

        $r2 = new Role;
        $r2->nombre = "Contador";
        $r2->save();

        $r3 = new Role;
        $r3->nombre = "Cajero";
        $r3->save();


        //Buscar usuario para asignar rol
        $u1 = User::where("email", "blaise.lesch@example.com")->first();
        $u1->save();
        //relacion entre user y rol

        $u1->roles()->attach($r1->id);
        $u1->roles()->attach($r3->id);
    }
}
