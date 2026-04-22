<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('order.index', [
            'title' => 'Order',
            'datas' => Order::with('user')->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', [
            'title' => 'Order',
            'products' => Product::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_pemesanan' => 'required|date',
            'id_user' => 'required',
            'status_pemesanan' => 'required',
            'status' => 'required',
            'metode_pembayaran' => 'required',
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

            $order = Order::create([
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'id_user' => $request->id_user,
                'status_pemesanan' => $request->status_pemesanan,
                'status' => $request->status,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $total_bayar,
                'keterangan' => $request->keterangan,
            ]);

            foreach ($request->items as $item) {
                // Check stock
                $product = Product::find($item['id_barang']);
                if (!$product || $product->stok < $item['jumlah_jual']) {
                    throw new \Exception("Insufficient stock for product: " . ($product->nama_barang ?? 'Unknown'));
                }

                Order_Detail::create([
                    'id_pemesanan' => $order->id,
                    'id_barang' => $item['id_barang'],
                    'harga_jual' => $item['harga_jual'],
                    'jumlah_jual' => $item['jumlah_jual'],
                    'subtotal' => $item['harga_jual'] * $item['jumlah_jual'],
                ]);

                // Deduct stock
                $product->stok -= $item['jumlah_jual'];
                $product->save();
            }

            DB::commit();
            return redirect()->route('order.index')->with('simpan', 'Order has been successfully recorded!');
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
        $order = Order::with(['user', 'details.product'])->findOrFail($id);
        return view('order.show', [
            'title' => 'Order Detail',
            'data' => $order
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
        $order = Order::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Revert stock
            foreach ($order->details as $detail) {
                $product = Product::find($detail->id_barang);
                if ($product) {
                    $product->stok += $detail->jumlah_jual;
                    $product->save();
                }
            }
            
            $order->delete();
            DB::commit();
            return redirect()->route('order.index')->with('hapus', 'Order has been deleted and stock reverted.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
