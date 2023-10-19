<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID del usuario
        $userId = Auth::id();

        // Obtén los servidores relacionados con el ID del usuario
        $servers = Server::where('user_id', $userId)->latest()->get();

        // Pasa los servidores a la vista
        return view('servers', compact('servers'), ['servers' => $servers]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createserver');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'ip_part1' => ['required', 'numeric', 'between:1,255'],
            'ip_part2' => ['required', 'numeric', 'between:0,255'],
            'ip_part3' => ['required', 'numeric', 'between:0,255'],
            'ip_part4' => ['required', 'numeric', 'between:0,255'],
            'description' => ['string', 'min:10', 'max:200', 'nullable'],
        ]);

        $userId = Auth::id();

        $ipComplete = $request->ip_part1 . '.' . $request->ip_part2 . '.' . $request->ip_part3 . '.' . $request->ip_part4;

        $description = $request->filled('description') ? $request->description : 'Servidor a Monitorear';

        $server = Server::create([
            'servername' => $request->name,
            'serverip' => $ipComplete,
            'description' => $description,
            'user_id' => $userId,
        ]);

        return redirect()->route('servers.show');
    }


    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);
        return view('editserver', compact('server'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'ip_part1' => ['required', 'numeric', 'between:1,255'],
            'ip_part2' => ['required', 'numeric', 'between:0,255'],
            'ip_part3' => ['required', 'numeric', 'between:0,255'],
            'ip_part4' => ['required', 'numeric', 'between:0,255'],
            'description' => ['required', 'string', 'min:10', 'max:200'],
        ]);

        // Obtener el servidor
        $server = Server::find($id);

        // Actualizar los atributos
        $server->servername = $request->name;
        $ipComplete = $request->ip_part1 . '.' . $request->ip_part2 . '.' . $request->ip_part3 . '.' . $request->ip_part4;
        $server->serverip = $ipComplete;
        $server->description = $request->description;

        // Guardar
        $server->save();

        return redirect()->route('servers.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Server::eliminar($id);

        return redirect()->route('servers.show')->with('success', 'Servidor eliminado correctamente');
    }
}
