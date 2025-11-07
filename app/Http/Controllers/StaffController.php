<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
//use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Storage;
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
        $roles = Role::select('id', 'name')->get();
        return view('users.staff_users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol'=>'required|exists:roles,id',
            'correo'=>'required|email|unique:users,email',
            'contraseña'=>'required|string|confirmed|min:8',
            'fotografia'=>'required|image|max:2048',
            'ci'=>'required|string|min:7|max:10|regex:/^[0-9]+$/',
            'nombre'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/',
            'telefono'=>'required|string|regex:/^[0-9 +()-]+$/',
            'genero'=>'required',
        ]);
        
        $staff = request()->all();
        $ci=$staff['ci'];
        $photo = $request->file('fotografia');

        //$extension = $photo->getClientOriginalExtension();
        $extension = $photo->guessExtension();
        $profile_picture = $ci.'.'.$extension; 
        //$profile_route = $photo->storeAs('public/profile_pictures', $profile_picture);
        $profile_route = $photo->storeAs('profile_pictures', $profile_picture, 'public');
        $url=Storage::url($profile_route);
        //$url=storage_path('app/'.$profile_route);
        $staff['profile_url'] = $url;

        $staff_user=User::create([
            'name'=>$staff['nombre'],
            'email'=>$staff['correo'],
            'password'=>bcrypt($staff['contraseña']),
            'role_id'=>$staff['rol'],
            'photo'=>$staff['profile_url'],
        ]);
        $staff_user->people()->create([
            'ci'=>$staff['ci'],
            'name'=>$staff['nombre'],
            'phone'=>$staff['telefono'],
            'gender'=>$staff['genero'],
        ]);

        return redirect()->route('staff.index')->with('mensaje', 'Personal registrado con exito')->with('icono', 'success' );    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person=People::with(['user.role'])->findOrFail($id);

        $fecha = Carbon::parse($person['created_at'])->format('Y-m-d');
        $hora = Carbon::parse($person['created_at'])->format('H:i:s');
        $fecha_M = Carbon::parse($person['updated_at'])->format('Y-m-d');
        $hora_M= Carbon::parse($person['updated_at'])->format('H:i:s');
        $result = [
            'person_id' => $person->id,
            'ci' => $person->ci,
            'nombre' => $person->name,
            'telefono' => $person->phone,
            'genero' => $person->gender,
            'registro'=>$fecha,
            'registro_hora'=>$hora,
            'actualizado'=>$fecha_M,
            'actualizado_hora'=>$hora_M,
        
            'usuario' => [
                'email' => $person->user->email ?? 'N/A',
                'photo' => $person->user->photo ?? 'N/A',
            ],
            
            'rol' => [
                'rol_nombre' => $person->user?->role->name ?? 'N/A',
            ],
        ];
    
        return view('users.staff_users.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $person=People::with(['user.role'])->findOrFail($id);
        $result = [
            'person_id' => $person->id,
            'ci' => $person->ci,
            'nombre' => $person->name,
            'telefono' => $person->phone,
            'genero' => $person->gender,
        
            'usuario' => [
                'email' => $person->user->email ?? 'N/A',
                'photo' => $person->user->photo ?? 'N/A',
            ],
            
            'rol' => [
                'rol_id' => $person->user?->role->id ?? 'N/A',
                'rol_nombre' => $person->user?->role->name ?? 'N/A',
            ],
        ];
        $norol=$result['rol']['rol_id'];
        $roles = Role::select('id', 'name')->where('id', '!=', $norol)->get();

        return view('users.staff_users.update', compact('roles','result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rol'=>'required|exists:roles,id',
            'correo'=>'required|email',
            'fotografia'=>'image|max:2048',
            'ci'=>'required|string|min:7|max:10|regex:/^[0-9]+$/',
            'nombre'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/',
            'telefono'=>'required|string|regex:/^[0-9 +()-]+$/',
            'genero'=>'required',
        ]);

        $staff = request()->all();
        $ci=$staff['ci'];
        $photo = $request->file('fotografia');

        $extension = $photo->guessExtension();
        $profile_picture = $ci.'.'.$extension; 
        $profile_route = $photo->storeAs('profile_pictures', $profile_picture, 'public');
        $url=Storage::url($profile_route);
        $staff['profile_url'] = $url;

        $staff_user = People::find($id); // o ->first() si usas where()

        $staff_user->update([
            'ci' => $staff['ci'],
            'name' => $staff['nombre'],
            'phone' => $staff['telefono'],
            'gender' => $staff['genero'],
        ]);

        $staff_user->user()->update([
            'name' => $staff['nombre'],
            'email' => $staff['correo'],
            'role_id' => $staff['rol'],
            'photo' => $staff['profile_url'],
        ]);

        return redirect()->route('staff.index')->with('mensaje', 'Personal actualizado con exito')->with('icono', 'success' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = People::findOrFail($id);
        $person->delete();
        if ($person->user) {
            $person->user->delete();
        }
        return redirect()->route('staff.index')->with('mensaje', 'Perosnal eliminado con exito')->with('icono', 'success' );
    }
}
