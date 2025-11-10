<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Cast\String_;

class MembershipController extends Controller
{

    public function index()
    {
        $memberships=Membership::all();
        return view('memberships.index',compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memberships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:5|max:100|unique:memberships,name', 
            'meses' => 'required|integer|min:1', 
            'precio' => 'required|numeric|min:0.01', 
            'tipo' => 'required|boolean', 
            'descripcion' => 'nullable|string|max:500',
        ]);
        Membership::create([
            'name' => $request->nombre,
            'duration_months' => $request->meses,
            'price' => $request->precio,
            'is_group' => $request->tipo,
            'description' => $request->descripcion,
        ]);

        return redirect()->route('memberships.index')->with('mensaje', 'Membresía creada con éxito.')->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $membership=Membership::findOrFail($id);
        return view('memberships.show',compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $membership=Membership::findOrFail($id);
        return view('memberships.update',compact('membership'));
        //return response()->json($membership);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $membership=Membership::findOrFail($id);
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'min:5',
                'max:100',
                Rule::unique('memberships', 'name')->ignore($membership->id),
            ],
            'meses' => ['required', 'integer', 'min:1'],
            'precio' => ['required', 'numeric', 'min:0.01'],
            'tipo' => ['required', 'boolean'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ]);
        $membership->update([
            'name' => $request->nombre,
            'duration_months' => $request->meses,
            'price' => $request->precio,
            'is_group' => $request->tipo,
            'description' => $request->descripcion,
        ]);
        return redirect()->route('memberships.index')->with('mensaje', 'Membresía actualizada con éxito.')->with('icono','success');
        //return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();
        return redirect()->route('memberships.index')->with('mensaje', 'Membresia eliminad con éxito')->with('icono', 'success' );
    }
}
