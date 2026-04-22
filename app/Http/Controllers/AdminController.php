<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'    => User::where('role', '!=', 'admin')->count(),
            'total_admins'   => User::where('role', 'admin')->count(),
            'total_products' => class_exists(\App\Models\Product::class) ? \App\Models\Product::count() : 0,
            'total_orders'   => class_exists(\App\Models\Order::class)   ? \App\Models\Order::count()   : 0,
        ];

        $latestUsers = User::where('role', '!=', 'admin')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestUsers'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        $orders = class_exists(\App\Models\Order::class)
            ? \App\Models\Order::with('user')->latest()->paginate(10)
            : collect();
        return view('admin.orders', compact('orders'));
    }
}
