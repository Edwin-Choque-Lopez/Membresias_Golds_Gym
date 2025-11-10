<?php

namespace App\Http\Controllers;

use App\Models\People;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use PhpParser\Node\Expr\Cast\String_;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=People::query()
            ->whereNull('user_id')
            ->orderBy('name')
            ->get();
        return view('users.customer_users.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.customer_users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ci'=>'required|unique:peoples,ci|string|min:7|max:10|regex:/^[0-9]+$/',
            'nombre'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/|min:10|max:50',
            'telefono'=>'required|string|regex:/^[0-9]+$/|digits:8',
            'genero'=>'required',
        ]);
        People::create([
            'ci'=>$request->ci,
            'user_id'=>null,
            'name'=>$request->nombre,
            'phone'=>$request->telefono,
            'gender'=>$request->genero,
        ]);

        return redirect()->route('clients.index')->with('mensaje', 'Cliente registrado con éxito')->with('icono', 'success' );  
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $people=People::findOrFail($id);
        $fecha = Carbon::parse($people['created_at'])->format('Y-m-d');
        $hora = Carbon::parse($people['created_at'])->format('H:i:s');
        $fecha_M = Carbon::parse($people['updated_at'])->format('Y-m-d');
        $hora_M= Carbon::parse($people['updated_at'])->format('H:i:s');
        $client=[
            'ci'=>$people->ci,
            'name'=>$people->name,
            'phone'=>$people->phone,
            'gender'=>$people->gender,
            'created_at_date'=>$fecha,
            'created_at_time'=>$hora,
            'updated_at_date'=>$fecha_M,
            'updated_at_time'=>$hora_M,
        ];
        return view('users.customer_users.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $people=People::findOrFail($id);
        $client=[
            'id'=>$people->id,
            'ci'=>$people->ci,
            'name'=>$people->name,
            'phone'=>$people->phone,
            'gender'=>$people->gender,
        ];
        return view('users.customer_users.update', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $person = People::findOrFail($id);
        $request->validate([
            'ci' => ['required','string','min:7','max:10','regex:/^[0-9]+$/',Rule::unique('peoples', 'ci')->ignore($person->id),],
            'nombre'=>'required|string|regex:/^[a-zA-Zñáéíóú ]+$/|min:10|max:50',
            'telefono'=>'required|string|regex:/^[0-9]+$/|digits:8',
            'genero'=>'required',
        ]);
        $people=People::find($id);
        $people->update([
            'ci' => $request['ci'],
            'name' => $request['nombre'],
            'phone' => $request['telefono'],
            'gender' => $request['genero'],
        ]);
        return redirect()->route('clients.index')->with('mensaje','Datos del cliente actualizados')->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $client=People::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('mensaje','Cliente eliminado con éxito')->with('icono','success');
        
    }
}
