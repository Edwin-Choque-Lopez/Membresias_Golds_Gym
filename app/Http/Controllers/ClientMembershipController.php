<?php

namespace App\Http\Controllers;

use App\Models\Client_Membership;
use App\Models\Membership;
use App\Models\Membership_Statuse;
use App\Models\Payment_Statuse;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tipo_pago = $request->input('tipo_pago');
        $rules = [
            'tipo_pago'        => 'required|in:1,0',
            'client_id'        => 'required|exists:peoples,id',
            'duration_months'  => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'membership_id'    => 'required|exists:memberships,id',
            'fecha_de_inicio'  => 'required|date|after_or_equal:today',
            'fecha_final'      => 'required|date|after:fecha_de_inicio',
            'estado_membresia' => 'required|exists:membership_statuses,id',
            'estado_pago'      => 'required|exists:payment_statuses,id',
        ];

        if ($tipo_pago == 1) {
            $rules['pago'] = 'required|numeric|min:0|same:price';
        } elseif ($tipo_pago == 0) {
            $rules['pago'] = [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < ($request->price * 0.5)) {
                        $fail('El pago debe ser al menos el 50% del precio.');
                    }
                },
            ];
        }
        
        $request->validate($rules);
       
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
    public function show(Client_Membership $client_Membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client_Membership $client_Membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client_Membership $client_Membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client_Membership $client_Membership)
    {
        //
    }
    public function form(){
        $individual_plans = Membership::query()
            ->where('is_group', false)
            ->get(['id', 'name']); 
        $grupal_plans = Membership::query()
            ->where('is_group', true)
            ->get(['id', 'name']);
        return view('memberships_solds.escoger',compact('individual_plans','grupal_plans'));
    }
    public function individual(Request $request){
        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
        ]);
        $membership_id = $request->input('membership_id');
        //return response()->json($membership_id);
        return redirect()->route('individual_membership_form', $membership_id);
    }
    public function individual_form(String $id){
        //$membership_id = $request->input('membership_id');
        $membership=Membership::find($id);
        $duration=$membership->duration_months;
        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addMonths($duration);
        $clients=People::query()
            ->whereNull('user_id')
            ->orderBy('name')
            ->get();
        $membership_status = Membership_Statuse::all();
        $payment_methods = Payment_Statuse::all();
        return view('memberships_solds.customer_memberships.salesform',compact('membership','clients','membership_status','payment_methods','start_date','end_date'));
        //return response()->json($duration);
        //return response()->json(['redirect_url' => route('memberships_solds.individual.create', ['membership_id' => $membership_id])]);
        //return redirect()->route('memberships_solds.individual.create', ['membership_id' => $membership_id]);
    }
}
