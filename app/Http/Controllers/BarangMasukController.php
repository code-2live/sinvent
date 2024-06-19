<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

use Illuminate\Http\Request;
use DB;

class BarangMasukController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $query = BarangMasuk::with('barang');
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('merk', 'like', '%' . $search . '%')
                  ->orWhere('seri', 'like', '%' . $search . '%')
                  ->orWhere('spesifikasi', 'like', '%' . $search . '%');
            });
        }
    
        $rsetBarangMasuk = $query->latest()->paginate(10);
    
        return view('barangmasuk.index', compact('rsetBarangMasuk'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    
    public function create()
    {
        $abarangmasuk = Barang::all();
        return view('barangmasuk.create',compact('abarangmasuk'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);
        //create post
        BarangMasuk::create([
            'tgl_masuk'        => $request->tgl_masuk,
            'qty_masuk'        => $request->qty_masuk,
            'barang_id'        => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangMasuk'));
    }

    public function destroy($id)
    {
        // Cari data Barang Masuk berdasarkan ID
        $barangMasuk = BarangMasuk::findOrFail($id);
    
        // Periksa apakah ada Barang Keluar terkait
        $barangKeluar = BarangKeluar::where('barang_id', $barangMasuk->barang_id)->first();
        if ($barangKeluar) {
            return redirect()->route('barangmasuk.index')->with(['error' => 'Data Barang Masuk tidak dapat dihapus karena terdapat Barang Keluar yang terkait.']);
        }
    
        // Periksa stok sebelum penghapusan
        $barang = Barang::findOrFail($barangMasuk->barang_id);
        $stokSebelum = $barang->stok;
    
        // Jika stok setelah penghapusan menjadi minus, batalkan penghapusan
        if ($stokSebelum - $barangMasuk->jumlah < 0) {
            return redirect()->route('barangmasuk.index')->with(['error' => 'Penghapusan Data Barang Masuk akan menyebabkan stok barang menjadi minus.']);
        }
    
        // Lakukan penghapusan jika validasi berhasil
        $barangMasuk->delete();
    
        // Update stok barang setelah penghapusan
        $barang->update(['stok' => $stokSebelum - $barangMasuk->jumlah]);
    
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $abarangmasuk = Barang::all();

        return view('barangmasuk.edit', compact('barangMasuk', 'abarangmasuk'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);
        //create post
        $barangMasuk = BarangMasuk::findOrFail($id);
            $barangMasuk->update([
                'tgl_masuk' => $request->tgl_masuk,
                'qty_masuk' => $request->qty_masuk,
                'barang_id' => $request->barang_id,
            ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

}
