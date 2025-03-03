<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;

class StokController extends Controller
{
    public function index()
    {
        $stoklar = Stok::all();
        $stoklar = Stok::paginate(10);
        return view('admin.stok', compact('stoklar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'urun_adi' => 'required|string',
            'fiyat' => 'required|numeric',
            'miktar' => 'required|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('images', 'public');
        } else {
            $imgPath = null;
        }
    
        Stok::create([
            'urun_adi' => $request->urun_adi,
            'fiyat' => $request->fiyat,
            'miktar' => $request->miktar,
            'img' => $imgPath
        ]);
    
        return redirect()->back()->with('success', 'Ürün eklendi.');
    }
    

    public function update(Request $request, $id)
    {
        $stok = Stok::findOrFail($id);
    
        $request->validate([
            'urun_adi' => 'required|string',
            'fiyat' => 'required|numeric',
            'miktar' => 'required|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('images', 'public');
            $stok->img = $imgPath;
        }
    
        $stok->update([
            'urun_adi' => $request->urun_adi,
            'fiyat' => $request->fiyat,
            'miktar' => $request->miktar,
            'img' => $stok->img
        ]);
    
        return redirect()->back()->with('success', 'Ürün güncellendi.');
    }
    

    public function destroy($id)
{
    $stok = Stok::find($id);
    if ($stok) {
        $stok->delete();
        return redirect()->route('admin.stok')->with('success', 'Stok başarıyla silindi.');
    }
    return redirect()->route('admin.stok')->with('error', 'Stok bulunamadı.');
}
}


