<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Role;
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
            'role'=>'required|exists:roles,id',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed|min:8',
            'photo'=>'required|image|max:2048',
            'ci'=>'required|string|min:7|max:10|regex:/^[0-9]+$/',
            'name'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/',
            'phone'=>'required|string|regex:/^[0-9 +()-]+$/',
            'gander'=>'required',
        ]);
        return redirect()->route('staff.index');
        /* 
                $request -> validate([
            'ci'=>'required|string|min:7|max:10|regex:/^[0-9]+$/',
            'nombre'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/',
            'apellidos'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/',
            'especialidad'=>'required|string|regex:/^[a-zA-Zñáéíóú .]+$/',
            'email'=>'required|email',
            'password'=>'required|string|confirmed|min:8',
            'foto'=>'required',
        ]);
       
        $miembro = request()->all();
        $email=$miembro['email'];
        $name_full=$miembro['nombre'].' '.$miembro['apellidos'];
        $imagen = $request->file('foto');

        $user=User::create([
            'name'=>$name_full,
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
        ]);

        $usuario = User::where('email', $email)->first();
     
        $docente=Docente::create([
            'ci'=>$miembro['ci'],           
            'nombre'=>$miembro['nombre'],          
            'apellidos'=>$miembro['apellidos'],       
            'especialidad'=>$miembro['especialidad'],    
            'email'=>$miembro['email'],          
            'rol'=>$miembro['rol'],            
            'genero'=>$miembro['genero'],          
            'foto'=>null, 
            'departamento_id'=>$miembro['departamento'],           
            'user_id'=>$usuario['id']
        ]);

        $iduse= Docente::where('email', $email)->value('id');
        //return response()->json($iduse);
        //$nombreBase = \Illuminate\Support\Str::slug($iduse ?? 'default_user');
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo1 = $iduse . '1.' . $extension; 
        $rutaImagen1 = $imagen->storeAs('public/fotos_perfil', $nombreArchivo1);
          
        $urlPublica1 = Storage::url($rutaImagen1);
        $miembro['url_F1'] = $urlPublica1; 

        $nombreArchivo2 = $iduse . '2.' . $extension; 
        $rutaImagen2 = $imagen->storeAs('public/fotos_perfil', $nombreArchivo2);
        
        $urlPublica2 = Storage::url($rutaImagen2);
        $miembro['url_F2'] = $urlPublica2; 

        $docenteupdate = Docente::where('id',$iduse)->update([
            'foto'=>$miembro['url_F2'],            
        ]);

        return redirect()->route('miembros.index')->with('success', 'Usuario registrado correctamente');
        */
        //return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
