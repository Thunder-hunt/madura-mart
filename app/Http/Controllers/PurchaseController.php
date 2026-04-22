<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Purchase_Detail;
use App\Models\Distributor;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('purchase.index', [
            'title' => 'Purchase',
            'datas' => Purchase::with('distributor')->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase.create', [
            'title' => 'Purchase',
            'distributors' => Distributor::all(),
            'products' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_nota' => 'required|unique:purchases',
            'tgl_nota' => 'required|date',
            'id_distributor' => 'required',
            'items' => 'required|array',
            'items.*.id_barang' => 'required',
            'items.*.harga_beli' => 'required|numeric',
            'items.*.jumlah_beli' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $total_bayar = 0;
            foreach ($request->items as $item) {
                $total_bayar += $item['harga_beli'] * $item['jumlah_beli'];
            }

            $purchase = Purchase::create([
                'no_nota' => $request->no_nota,
                'tgl_nota' => $request->tgl_nota,
                'id_distributor' => $request->id_distributor,
                'total_bayar' => $total_bayar,
            ]);

            foreach ($request->items as $item) {
                Purchase_Detail::create([
                    'id_pembelian' => $purchase->id,
                    'id_barang' => $item['id_barang'],
                    'harga_beli' => $item['harga_beli'],
                    'margin_jual' => $item['margin_jual'] ?? 0,
                    'jumlah_beli' => $item['jumlah_beli'],
                    'subtotal' => $item['harga_beli'] * $item['jumlah_beli'],
                ]);

                // Update product stock if needed
                $product = Product::find($item['id_barang']);
                if ($product) {
                    $product->stok += $item['jumlah_beli'];
                    $product->save();
                }
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('simpan', 'Purchase ' . $request->no_nota . ' has been successfully recorded!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::with(['distributor', 'details.product'])->findOrFail($id);
        return view('purchase.show', [
            'title' => 'Purchase Detail',
            'data' => $purchase
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Typically purchases are not edited for audit reasons, but I'll leave it empty or implement later if requested.
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
        $purchase = Purchase::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Revert stock
            foreach ($purchase->details as $detail) {
                $product = Product::find($detail->id_barang);
                if ($product) {
                    $product->stok -= $detail->jumlah_beli;
                    $product->save();
                }
            }
            
            $purchase->delete();
            DB::commit();
            return redirect()->route('purchase.index')->with('hapus', 'Purchase ' . $purchase->no_nota . ' has been deleted and stock reverted.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
