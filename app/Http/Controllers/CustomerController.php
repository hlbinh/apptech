<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
$customers =  Customer::all();
    return view('customers.index', compact('customers'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
$request->validate([
'first_name'=>'required',
'last_name'=>'required',
'email'=>'required'
]);
    $cust= new Customer([
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'email' => $request->get('email'),
        'tel' => $request->get('tel'),
        'city' => $request->get('city'),
        'country' => $request->get('country')
    ]);
    $cust->save();
    return redirect('/customers')->with('success', 'Customer saved!');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));        
    }

public function update(Request $request, $id)
{
$request->validate([
'first_name'=>'required',
'last_name'=>'required',
'email'=>'required',
'tel'=>'required|digits_between:10,11']);
    $customer = Customer::find($id);
    $customer->first_name =  $request->get('first_name');
    $customer->last_name = $request->get('last_name');
    $customer->email = $request->get('email');
    $customer->tel = $request->get('tel');
    $customer->city = $request->get('city');
    $customer->country = $request->get('country');
    $customer->save();

    return redirect('/customers')->with('success', 'Customer updated!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
	{
	$customer= Customer::find($id);
	$customer->delete();
    return redirect('/customers')->with('success', 'Customer deleted!');
  }

}
