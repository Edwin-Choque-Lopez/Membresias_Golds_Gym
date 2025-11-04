<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people_with_user = People::query()
            // Filtra solo aquellas personas cuyo user_id NO es NULL
            ->whereNotNull('user_id')
            // Carga las relaciones 
            ->with(['user.role'])
            // Ordena por nombre para una mejor visualización
            ->orderBy('name')
            // Especifica el resultado tiene multiples registros
            ->get();

        // 2. Formatear la salida para mostrar los datos relevantes
        /*$result = $people_with_user->map(function ($person) {
            return [
                'person_id' => $person->id,
                'nombre_completo' => $person->name,
                'telefono' => $person->phone,
                'fecha_registro' => $person->registration_date,
                
                // Datos del Usuario
                'usuario' => [
                    'user_id' => $person->user->id ?? null,
                    'email' => $person->user->email ?? 'N/A',
                    'rol' => $person->user->role->name ?? 'Sin Rol Asignado', // Nombre del Rol
                    'rol_descripcion' => $person->user->role->description ?? 'N/A',
                ],
            ];
        });*/

        //return response()->json($people_with_user);

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
