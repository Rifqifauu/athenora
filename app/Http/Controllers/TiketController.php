<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\TiketDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    public function index()
    {   
        $tiket = Tiket::all();
        return Inertia::render('Tiket/Index', [
            'tiket' => $tiket,
        ]);
    }
    public function show($tiket_id)
    {   
        $user = Auth::user();
        $tiket = Tiket::findOrFail($tiket_id);
        $havingTicket = TiketDetail::where('user_id', $user->id)
        ->where('tiket_id', $tiket_id)
        ->exists();
        return Inertia::render('Tiket', [
            'tiket' => $tiket,
            'user' =>$user,
        'havingTicket' =>$havingTicket,
        ]);
    }

    public function create()
    {
        return Inertia::render('Tiket/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:50',
            'harga' => 'required|numeric'
        ]);

        Tiket::create($data);

        return redirect()->route('tiket.index')->with('message', 'Tiket created successfully');
    }

    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);
        return Inertia::render('Tiket/Edit', [
            'tiket' => $tiket
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:50',
            'harga' => 'required|numeric'
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->update($data);

        return redirect()->route('tiket.index')->with('message', 'Tiket updated successfully');
    }

    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();

        return redirect()->route('tiket.index')->with('message', 'Tiket deleted successfully');
    }
}
