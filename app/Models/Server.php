<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $table = 'servers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'servername',
        'serverip',
        'description',
        'user_id'
    ];

    /**
     * Método estático para crear un nuevo servidor.
     *
     * @param array $data Los datos del servidor a crear
     * @return Server El servidor creado
     */

    public static function crear(array $data): Server
    {
        return self::create([
            'servername' => $data['servername'],
            'serverip' => $data['serverip'],
            'description' => $data['description'] ?? 'Servidor a Monitorear',
            'status' => 'Desconocido',
            'statustime' => 'Desconocido',
            'lastcheck' => 'Desconocido',
            'lastresponse' => 'Desconocido',
            'user_id' => $data['user_id'] ?? null,
        ]);
    }

    public static function eliminar($id)
    {
        return self::where('id', $id)->delete();
    }
}
