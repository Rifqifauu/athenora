<?php

namespace App\Http\Controllers;

use App\Models\TiketDetail;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TiketDetailController extends Controller
{
    public function index()
    {
        $tiketDetail = TiketDetail::with('tiket', 'user')->get();
        return Inertia::render('TiketDetail/Index', [
            'tiketDetail' => $tiketDetail
        ]);
    }

    public function show()
    {
        $user = Auth::user();
        $user_id = $user->id;
    
        // Ambil satu tiket detail untuk user tertentu
        $tiket = TiketDetail::where('user_id', $user_id)->first(); 
    
        return Inertia::render('Dashboard', [
            'tiket' => $tiket,  // Ini akan menjadi objek, bukan array
            'user' => $user
        ]);
    }
    
    
    public function create()
    {
        $tiket = Tiket::all();
        return Inertia::render('TiketDetail/Create', [
            'tiket' => $tiket
        ]);
    }

    public function store(Request $request)
    { 
        $data = $request->validate([
            'tiket_id' => 'required|exists:tiket,tiket_id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        // Menambahkan kode otomatis
        $data['kode'] = strtoupper('TIK-' . uniqid());
        $data['status'] = 'belum_bayar'; // Status default
        TiketDetail::create($data);
        return redirect()->route('detail-tiket.show')->with('message', 'Detail Tiket created successfully');
    }
    
    public function edit($id)
    {
        $tiketDetail = TiketDetail::with('tiket', 'user')->findOrFail($id);
        $tiket = Tiket::all();
        
        return Inertia::render('TiketDetail/Edit', [
            'tiketDetail' => $tiketDetail,
            'tiket' => $tiket
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:detail_tiket,kode,' . $id,
            'tiket_id' => 'required|exists:tiket,tiket_id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:belum_bayar,dibayar,digunakan,dibatalkan'
        ]);

        $tiketDetail = TiketDetail::findOrFail($id);
        $tiketDetail->update($data);

        return redirect()->route('detail-tiket.index')->with('message', 'Detail Tiket updated successfully');
    }

    public function destroy($id)
    {
        $tiketDetail = TiketDetail::findOrFail($id);
        $tiketDetail->delete();

        return redirect()->route('detail-tiket.index')->with('message', 'Detail Tiket deleted successfully');
    }
}
