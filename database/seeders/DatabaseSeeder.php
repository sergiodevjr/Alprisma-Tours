<?php

namespace Database\Seeders;

use App\Models\Destino;
use App\Models\Paquete;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@agencia.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin12345'),
                'rol' => 'admin',
            ]
        );

        $antigua = Destino::firstOrCreate(
            ['nombre' => 'Antigua Guatemala'],
            ['pais' => 'Guatemala', 'descripcion' => 'Ciudad colonial, Patrimonio de la Humanidad.']
        );

        $atitlan = Destino::firstOrCreate(
            ['nombre' => 'Lago de Atitlán'],
            ['pais' => 'Guatemala', 'descripcion' => 'Lago rodeado de volcanes y pueblos mayas en Sololá.']
        );

        $tikal = Destino::firstOrCreate(
            ['nombre' => 'Tikal'],
            ['pais' => 'Guatemala', 'descripcion' => 'Ciudad maya en la selva de Petén.']
        );

        Paquete::firstOrCreate(
            ['titulo' => 'Fin de semana colonial'],
            ['destino_id' => $antigua->id, 'precio' => 500, 'cupos' => 8, 'fecha_salida' => now()->addDays(30)]
        );

        Paquete::firstOrCreate(
            ['titulo' => 'Tour de volcanes'],
            ['destino_id' => $atitlan->id, 'precio' => 250, 'cupos' => 3, 'fecha_salida' => now()->addDays(45)]
        );

        Paquete::firstOrCreate(
            ['titulo' => 'Aventura en Tikal'],
            ['destino_id' => $tikal->id, 'precio' => 1200, 'cupos' => 10, 'fecha_salida' => now()->addDays(60)]
        );
    }
}