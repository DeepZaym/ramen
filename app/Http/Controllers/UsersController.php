<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Orders_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use function Laravel\Prompts\alert;

class UsersController extends Controller
{
    public function loginForm() {
        return view('Ramen.login');
    }

    public function registrasiForm() {
        return view('Ramen.registrasi');
    }

    public function submitRegistrasi(Request $request) {
        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users',
            'users_email' => 'required|email|unique:tb_users',
            'users_password' => 'required|min:7|confirmed',
            'users_alamat' => 'required|string|max:255',
        ]);

        Users::create([
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_password' => Hash::make($request->users_password),
            'users_alamat' => $request->users_alamat,
        ]);

        return redirect()->route('loginForm')->with('success', 'Registrasi berhasil!');
    }

    public function submitLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Manual authentication untuk Users model
        $user = Users::where('users_nama', $request->username)->first();

        if ($user && Hash::check($request->password, $user->users_password)) {
            // Login user menggunakan guard customers
            Auth::guard('customers')->login($user);
            $request->session()->regenerate();
            return redirect()->route('landing')->with('success', 'Login berhasil');
        }

        // return back()->with('gagal', 'Username atau password salah');
        return view("errorhandling");

    }

    public function landing() {
    if (Auth::guard('customers')->check()) {
        $user = Auth::guard('customers')->user();

        $tb_users = Session::get('tb_users');
        if (!$tb_users) {
            $tb_users = [
                'users_id' => $user->users_id,
                'users_nama' => $user->users_nama,
                'users_email' => $user->users_email,
                'users_alamat' => $user->users_alamat,
            ];
            Session::put('tb_users', $tb_users);
        }

        return view('users.landing', [
            'users_nama' => $user->users_nama,
            'users_email' => $user->users_email,
            'users_alamat' => $user->users_alamat,
            'tb_users' => $tb_users,
        ]);
    }

    return redirect()->route('loginForm')->with('gagal', 'Silakan login terlebih dahulu.');
    }


    public function logout(Request $request) {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Logout berhasil');
    }

    // Menu method
    public function menu() {
        return view('users.menu');
    }

    public function statusmenu()
{
    $menus = Menu::where('status','tersedia')->where('stok','>',0)->get();
    $user = Auth::guard('customers')->user(); // ambil user yang sedang login
    return view('users.order', compact('menus', 'user'));
}


    public function submitorder(Request $request)
{
    $user = Auth::user();

    // Decode items dari JSON string
    $items = json_decode($request->input('items'), true);

    if (!$items || !is_array($items)) {
        return back()->with('error', 'Data item tidak valid.');
    }

    // Hitung total harga
    $total_price = 0;
    foreach ($items as $item) {
        $menu = Menu::find($item['menu_id']);
        if ($menu) {
            $total_price += $menu->harga * $item['quantity'];
        }
    }

    DB::beginTransaction();
    try {
        // Buat order baru
        $order = Orders::create([
            'users_id' => $user->users_id,
            'delivery_address' => $request->input('delivery_address'),
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        // Cek apakah berhasil membuat order
        if (!$order || !$order->orders_id) {
            throw new \Exception("Gagal menyimpan order.");
        }

        // Simpan item-item order
        foreach ($items as $item) {
            Orders_Item::create([
                'orders_id' => $order->orders_id, // pastikan ini tidak NULL
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        DB::commit();
        return redirect()->route('order.success')->with('success', 'Pesanan berhasil dibuat.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



    // Pembayaran method
    public function pembayaran() {
        return view('users.pembayaran');
    }

    // CRUD methods untuk admin panel
    public function index() {
        $users = Users::all();
        return view('admin.users.view-users', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users',
            'users_email' => 'required|email|unique:tb_users',
            'users_password' => 'required|min:7',
            'users_alamat' => 'required|string|max:255',
        ]);

        Users::create([
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_password' => Hash::make($request->users_password),
            'users_alamat' => $request->users_alamat,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id) {
        $user = Users::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = Users::findOrFail($id);

        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users,users_nama,' . $id . ',users_id',
            'users_email' => 'required|email|unique:tb_users,users_email,' . $id . ',users_id',
            'users_alamat' => 'required|string|max:255',
        ]);

        $updateData = [
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_alamat' => $request->users_alamat,
        ];

        if ($request->filled('users_password')) {
            $updateData['users_password'] = Hash::make($request->users_password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id) {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
