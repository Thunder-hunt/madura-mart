<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', [
            'title' => 'Products',
            'datas' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'title' => 'Products'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kd = DB::table('products')->where('kd_barang', $request->kd_barang)->value('kd_barang');
        $nama = DB::table('products')->where('nama_barang', $request->nama_barang)->value('nama_barang');

        if ($request->kd_barang == $kd) {
            return redirect()->route('products.create')->with('duplikat', 'Product ' . $request->kd_barang . ' data with code ' . $request->kd_barang . ' is already in the database!')->withInput();
        }else if ($request->nama_barang == $nama) {
            return redirect()->route('products.create')->with('duplikat', 'Product ' . $request->nama_barang . ' data with name ' . $request->nama_barang . ' is already in the database!')->withInput();
        }else{
            $data = $request->all();
            $data['foto_barang'] = $request->file('foto_barang')->store('product-images', 'public');
            Product::create($data);
            return redirect()->route('products.index')->with('simpan', 'The New Product data, ' . $request->nama_barang . ' has been successfully added to the database!');
        }
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
        $data = Product::find($id);
        return view('products.edit', [
            'title' => 'Products',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Product::find($id);
        $updateData = $request->all();

        if ($request->hasFile('foto_barang')) {
            $updateData['foto_barang'] = $request->file('foto_barang')->store('product-images', 'public');
        } else {
            unset($updateData['foto_barang']);
        }

        $data->update($updateData);
        return redirect()->route('products.index')->with('simpan', 'The Product data, ' . $request->nama_barang . ' has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
