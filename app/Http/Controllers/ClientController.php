<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index', [
            'title' => 'Clients',
            'datas' => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create', [
            'title' => 'Clients'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'nullable',
            'address' => 'nullable'
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('simpan', 'New Client ' . $request->name . ' has been successfully added!');
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
        return view('clients.edit', [
            'title' => 'Clients',
            'data' => Client::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:clients,email,' . $id,
            'phone' => 'nullable',
            'address' => 'nullable'
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('clients.index')->with('update', 'Client ' . $request->name . ' has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('hapus', 'Client ' . $client->name . ' has been successfully deleted!');
    }
}
