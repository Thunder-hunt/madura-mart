<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('couriers.index', [
            'title' => 'Couriers',
            'datas' => Courier::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('couriers.create', [
            'title' => 'Couriers'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'vehicle_type' => 'nullable',
            'license_plate' => 'nullable'
        ]);

        Courier::create($request->all());

        return redirect()->route('couriers.index')->with('simpan', 'New Courier ' . $request->name . ' has been successfully added!');
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
        return view('couriers.edit', [
            'title' => 'Couriers',
            'data' => Courier::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'vehicle_type' => 'nullable',
            'license_plate' => 'nullable'
        ]);

        $courier = Courier::findOrFail($id);
        $courier->update($request->all());

        return redirect()->route('couriers.index')->with('update', 'Courier ' . $request->name . ' has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $courier = Courier::findOrFail($id);
        $courier->delete();

        return redirect()->route('couriers.index')->with('hapus', 'Courier ' . $courier->name . ' has been successfully deleted!');
    }
}
