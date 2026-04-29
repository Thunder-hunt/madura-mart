<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sale_Detail;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sale.index', [
            'title' => 'Sale',
            'products' => Product::where('stok', '>', 0)->get(),
            'sale_details' => Sale_Detail::with(['sale', 'product'])->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sale.create', [
            'title' => 'Sale',
            'products' => Product::where('stok', '>', 0)->get(),
            'clients' => Client::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_struk' => 'required|unique:sales',
            'tgl_jual' => 'required|date',
            'items' => 'required|array',
            'items.*.id_barang' => 'required',
            'items.*.harga_jual' => 'required|numeric',
            'items.*.jumlah_jual' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $total_bayar = 0;
            foreach ($request->items as $item) {
                $total_bayar += $item['harga_jual'] * $item['jumlah_jual'];
            }

            $sale = Sale::create([
                'no_struk' => $request->no_struk,
                'tgl_jual' => $request->tgl_jual,
                'total_bayar' => $total_bayar,
            ]);

            foreach ($request->items as $item) {
                // Check stock
                $product = Product::find($item['id_barang']);
                if (!$product || $product->stok < $item['jumlah_jual']) {
                    throw new \Exception("Insufficient stock for product: " . ($product->name_product ?? 'Unknown'));
                }

                Sale_Detail::create([
                    'id_penjualan' => $sale->id,
                    'id_barang' => $item['id_barang'],
                    'harga_jual' => $item['harga_jual'],
                    'jumlah_jual' => $item['jumlah_jual'],
                    'subtotal' => $item['harga_jual'] * $item['jumlah_jual'],
                ]);

                // Update product stock
                $product->stok -= $item['jumlah_jual'];
                $product->save();
            }

            DB::commit();
            return redirect()->route('sale.index')->with('simpan', 'Sale ' . $request->no_struk . ' has been recorded!');
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
        $sale = Sale::with(['details.product'])->findOrFail($id);
        return view('sale.show', [
            'title' => 'Sale Detail',
            'data' => $sale
        ]);
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
        $sale = Sale::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Revert stock
            foreach ($sale->details as $detail) {
                $product = Product::find($detail->id_barang);
                if ($product) {
                    $product->stok += $detail->jumlah_jual;
                    $product->save();
                }
            }
            
            $sale->delete();
            DB::commit();
            return redirect()->route('sale.index')->with('hapus', 'Sale ' . $sale->no_struk . ' has been deleted and stock reverted.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
