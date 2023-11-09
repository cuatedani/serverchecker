<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Server;

class ServerSeeder extends Seeder
{
    public function run()
    {
        // Crear registros de servidores
        // Server::create([
        //     'servername' => 'Servidor Desconocido',
        //     'serverip' => '192.168.1.1',
        //     'user_id' => 3,  // ID de un usuario existente en la tabla 'users'
        // ]);
        // Server::create([
        //     'servername' => 'Servidor Online',
        //     'serverip' => '192.168.1.2',
        //     'status' => 'Activo',
        //     'user_id' => 3,  // ID de un usuario existente en la tabla 'users'
        // ]);
        // Server::create([
        //     'servername' => 'Servidor Offline',
        //     'serverip' => '192.168.1.3',
        //     'status' => 'Inactivo',
        //     'user_id' => 3,  // ID de un usuario existente en la tabla 'users'
        // ]);
        Server::create([
            'servername' => 'Servidor 1',
            'serverip' => '192.168.1.1',
            'user_id' => 4,  // ID de un usuario existente en la tabla 'users'
        ]);
    }
}

