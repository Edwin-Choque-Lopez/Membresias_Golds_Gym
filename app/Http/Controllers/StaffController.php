<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class StaffController extends Controller
{
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
        $result = $people_with_user->map(function ($person) {
            return [
                'person_id' => $person->id,
                'nombre_completo' => $person->name,
                'fecha_registro' => $person->registration_date,
                'email' => $person->user->email ?? 'N/A',
                'rol' => $person->user->role->name ?? 'Sin Rol Asignado',
            ];
        });

        return view('users.staff_users.index',compact('result'));
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
