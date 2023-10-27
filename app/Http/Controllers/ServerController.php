<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use DateTime;

class ServerController extends Controller
{
    /**
     * Muestra los servidores.
     */
    public function index()
    {
        // Obtener el ID del usuario
        $userId = Auth::id();

        // Obtén los servidores relacionados con el ID del usuario que no están eliminados
        $servers = Server::where('user_id', $userId)->where('status', '!=', 'Eliminado')->latest()->get();

        // Pasa los servidores a la vista
        return view('servers', compact('servers'));
    }

    /**
     * Muestra interfaz de creacion.
     */
    public function create()
    {
        return view('createserver');
    }

    /**
     * Guarda nuevo servidor en database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:25'],
            'ip_part1' => ['required', 'numeric', 'between:1,255'],
            'ip_part2' => ['required', 'numeric', 'between:0,255'],
            'ip_part3' => ['required', 'numeric', 'between:0,255'],
            'ip_part4' => ['required', 'numeric', 'between:0,255'],
            'description' => ['string', 'min:5', 'max:200', 'nullable'],
        ]);

        $userId = Auth::id();

        $ipComplete = $request->ip_part1 . '.' . $request->ip_part2 . '.' . $request->ip_part3 . '.' . $request->ip_part4;

        $description = $request->description;

        $server = Server::create([
            'servername' => $request->name,
            'serverip' => $ipComplete,
            'description' => $description,
            'user_id' => $userId,
        ]);

        return redirect()->route('servers.show');
    }

    /**
     * Obtener datos para editar.
     */
    public function edit($id)
    {
        // Obtén los datos del servidor según el ID ($id)
        $server = Server::findOrFail($id);

        // Devuelve el servidor y sus valores en formato JSON
        return response()->json(['server' => $server]);
    }


    /**
     * Actualizar datos.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:30'],
            'ip_part1' => ['required', 'numeric', 'between:1,255'],
            'ip_part2' => ['required', 'numeric', 'between:0,255'],
            'ip_part3' => ['required', 'numeric', 'between:0,255'],
            'ip_part4' => ['required', 'numeric', 'between:0,255'],
            'description' => ['required', 'string', 'min:5', 'max:200'],
        ]);

        // Obtener el servidor
        $server = Server::find($id);

        if ($server) {
            // Actualizar los atributos
            $server->servername = $request->name;
            $ipComplete = $request->ip_part1 . '.' . $request->ip_part2 . '.' . $request->ip_part3 . '.' . $request->ip_part4;
            $server->serverip = $ipComplete;
            $server->description = $request->description;
            $server->status = 'Desconocido';
            $server->statustime = 'Desconocido';
            $server->lastcheck = 'Desconocido';
            $server->lastresponse = 'Desconocido';

            // Guardar los cambios
            $server->save();

            // Respondemos con una respuesta JSON
            return response()->json(['success' => true, 'message' => 'El servidor se ha actualizado correctamente']);
        } else {
            // Si no se encuentra el servidor, respondemos con un error
            return response()->json(['success' => false, 'message' => 'No se pudo encontrar el servidor'], 404);
        }
    }

    /**
     * Comprueba Todos los servidores.
     */
    public function checkall()
    {
    }

    /**
     * Comprueba Todos los servidores de un usuario.
     */
    public function checkone()
    {
        // Obtener el ID del usuario
        $userId = Auth::id();

        // Obtén los servidores relacionados con el ID del usuario que no están eliminados
        $servers = Server::where('user_id', $userId)->where('status', '!=', 'Eliminado')->get();

        foreach ($servers as $server) {
            // Realiza la lógica de comprobación para cada servidor
            $isServerActive = $this->checkServerStatus($server->serverip);

            if ($isServerActive) {
                if ($server->status == 'Activo') {
                    // Cuando revisa y el servidor sigue activo
                    try {
                        $server->lastcheck = now();

                        $datetime1 = new DateTime($server->lastcheck);
                        $datetime2 = new DateTime($server->lastresponse);
                        $interval = $datetime1->diff($datetime2, true);
                        // Obtén la diferencia en días, horas, minutos y segundos
                        $diferencia = $interval->format("%a Dias, %H Horas, Minutos %I");
                        Log::error('Diferencia: ' . $diferencia);
                        $server->statustime = $diferencia;
                    } catch (\Exception $e) {
                        Log::error('Ocurrió una excepción: ' . $e->getMessage());
                    }
                } else {
                    // Cuando revisa y el servidor recién está activo
                    $server->status = 'Activo';
                    $server->lastcheck = now();
                    $server->lastresponse = now();
                    $server->statustime = "0 Minutos";
                }
            } else {
                if ($server->status == 'Inactivo') {
                    // Cuando revisa y el servidor sigue inactivo
                    try {
                        $server->lastcheck = now();

                        $datetime1 = new DateTime($server->lastcheck);
                        $datetime2 = new DateTime($server->lastresponse);
                        $interval = $datetime1->diff($datetime2, true);
                        // Obtén la diferencia en días, horas, minutos y segundos
                        $diferencia = $interval->format("%a Dias, %H Horas, Minutos %I");
                        Log::error('Diferencia: ' . $diferencia);
                        $server->statustime = $diferencia;
                    } catch (\Exception $e) {
                        Log::error('Ocurrió una excepción: ' . $e->getMessage());
                    }
                } else {
                    // Cuando revisa y el servidor está inactivo
                    $server->status = 'Inactivo';
                    $server->lastcheck = now();
                    $server->lastresponse = now();
                    $server->statustime = "0 Minutos";
                }
            }
            $server->save(); // Guarda los cambios en la base de datos
        }
        // Redirige o responde según tus necesidades
        return response()->json(['success' => true, 'message' => 'Se han comprobado los servidores']);
    }

    private function checkServerStatus($serverIP)
    {
        try {
            $timeout = 5; // Tiempo de espera en segundos
            $command = "ping -n 1 -w $timeout $serverIP"; // Comando de ping de Windows
            //$command = "ping -n 1 -W $timeout $serverIP"; Comando de ping de Ubuntu
        
            // Ejecuta el comando de ping en el sistema
            exec($command, $output, $result);
        
            // Verifica el resultado del ping
            if ($result === 0) {
                // El servidor respondió al ping
                return true;
            } else {
                // El servidor no respondió al ping
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Ocurrió una excepción: ' . $e->getMessage());
        }
        
    }

    /**
     * Elimina de vista un elemento.
     */
    public function destroy($id)
    {
        // Encuentra el servidor por su ID
        $server = Server::find($id);

        // Verifica si se encontró el servidor
        if ($server) {

            // Actualizar los atributos
            $server->status = 'Eliminado';

            // Guardar los cambios
            $server->save();

            // Redirecciona a la vista de servidores con un mensaje de éxito
            return redirect()->route('servers.show')->with('success', 'Servidor eliminado correctamente');
        } else {
            // Redirecciona con un mensaje de error si el servidor no se encontró
            return redirect()->route('servers.show')->with('error', 'No se encontró el servidor');
        }
    }
}
