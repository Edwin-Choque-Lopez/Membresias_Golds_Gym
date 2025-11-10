<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
//use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $people_with_user = People::query()
            ->whereNotNull('user_id')
            ->with(['user.role'])
            ->orderBy('name')
            ->get();

        $result = $people_with_user->map(function ($person) {
            return [
                'person_id' => $person->id,
                'nombre_completo' => $person->name,
                'fecha_registro' => $person->created_at->format('Y-m-d'),
                'email' => $person->user->email ?? 'N/A',
                'rol' => $person->user->role->name ?? 'Sin Rol Asignado',
            ];
        });

        return view('users.staff_users.index',compact('result'));
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return view('users.staff_users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required|exists:roles,id',
            'correo' => 'required|email|unique:users,email',
            'contraseña' => 'required|string|confirmed|min:8', 
            'fotografia' => 'required|image|max:2048', 
            'ci' => 'required|unique:peoples,ci|string|min:7|max:10', 
            'nombre' => 'required|string|regex:/^[a-zA-ZñáéíóúÁÉÍÓÚ ]+$/|min:10|max:50',
            'telefono' => 'required|string|digits:8', 
            'genero' => 'required',
        ]);
        
        $ci = $request->input('ci');
        $photo = $request->file('fotografia');

        $extension = $photo->guessExtension();
        $profile_picture = $ci . '.' . $extension; 
        
        $path = $photo->storeAs('profile_pictures', $profile_picture, 'public');
        
        $url = Storage::url($path);
        
        $user = User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('correo'),
            'password' => Hash::make($request->input('contraseña')),
            'role_id' => $request->input('rol'),
            'photo' => $url,
        ]);

        $user->people()->create([
            'ci' => $request->input('ci'),
            'name' => $request->input('nombre'),
            'phone' => $request->input('telefono'),
            'gender' => $request->input('genero'),
        ]);
        
        return redirect()->route('staff.index')->with('mensaje', 'Personal registrado con éxito')->with('icono', 'success' );    
    }

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
        $roles = Role::select('id', 'name')->get();
        return view('users.staff_users.update', compact('roles','result'));
    }

    public function update(Request $request, string $id)
    {
        $person = People::findOrFail($id);
        $user = $person->user;
        $request->validate([
            'rol' => 'required|exists:roles,id',
            'correo' => ['required','email',Rule::unique('users', 'email')->ignore($user->id),],
            'fotografia' => 'nullable|image|max:2048',
            'ci' => ['required','string','min:7','max:10','regex:/^[0-9]+$/',Rule::unique('peoples', 'ci')->ignore($person->id),],
            'nombre' => 'required|string|regex:/^[a-zA-Zñáéíóú ]+$/|min:10|max:50',
            'telefono' => 'required|string|digits:8',
            'genero' => 'required',
        ]);
        $photo_url = $user->photo;
        
        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            
            $filename = $request->input('ci');
            $extension = $photo->extension();
            $profile_picture = $filename . '.' . $extension;
            
            $path = $photo->storeAs('profile_pictures', $profile_picture, 'public');
            
            $photo_url = Storage::url($path);
        }
        
        $person->update([
            'ci' => $request->input('ci'),
            'name' => $request->input('nombre'),
            'phone' => $request->input('telefono'),
            'gender' => $request->input('genero'),
        ]);
        
        $user->update([
            'email' => $request->input('correo'),
            'role_id' => $request->input('rol'),
            'photo' => $photo_url, 
        ]);

        return redirect()->route('staff.index') ->with('mensaje', 'Datos actualizados del personal') ->with('icono', 'success');
    }

    public function destroy(string $id)
    {
        $person = People::findOrFail($id);
        $person->delete();
        if ($person->user) {
            $person->user->delete();
        }
        return redirect()->route('staff.index')->with('mensaje', 'Personal eliminado con éxito')->with('icono', 'success' );
    }
}
