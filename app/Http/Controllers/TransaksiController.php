<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Menampilkan semua transaksi dengan urutan berdasarkan tanggal pembelian terbaru
        $transaksi = Transaksi::orderBy('tanggal_pembelian', 'DESC')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        // Menampilkan form untuk menambahkan transaksi baru
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'bayar' => 'required|numeric',
            'nama_produk1' => 'required|string',
            'harga_satuan1' => 'required|numeric',
            'jumlah1' => 'required|numeric',
            'nama_produk2' => 'required|string',
            'harga_satuan2' => 'required|numeric',
            'jumlah2' => 'required|numeric',
            'nama_produk3' => 'required|string',
            'harga_satuan3' => 'required|numeric',
            'jumlah3' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // Menyimpan transaksi
            $transaksi = new Transaksi();
            $transaksi->tanggal_pembelian = $request->input('tanggal_pembelian');
            $transaksi->total_harga = 0;
            $transaksi->bayar = $request->input('bayar');
            $transaksi->kembalian = 0;
            $transaksi->save();

            // Menyimpan detail transaksi
            $total_harga = 0;
            for ($i = 1; $i <= 3; $i++) {
                $transaksidetail = new TransaksiDetail();
                $transaksidetail->id_transaksi = $transaksi->id;
                $transaksidetail->nama_produk = $request->input('nama_produk' . $i);
                $transaksidetail->harga_satuan = $request->input('harga_satuan' . $i);
                $transaksidetail->jumlah = $request->input('jumlah' . $i);
                $transaksidetail->subtotal = $transaksidetail->harga_satuan * $transaksidetail->jumlah;
                $transaksidetail->save();
                $total_harga += $transaksidetail->subtotal;
            }

            // Mengupdate total harga dan kembalian transaksi
            $transaksi->total_harga = $total_harga;
            $transaksi->kembalian = $transaksi->bayar - $total_harga;
            $transaksi->save();

            DB::commit();

            return redirect('transaksidetail/' . $transaksi->id)->with('pesan', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['Transaction' => 'Gagal menambahkan data'])->withInput();
        }
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit transaksi
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'bayar' => 'required|numeric'
        ]);

        // Mengupdate transaksi
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->bayar = $request->input('bayar');
        $transaksi->kembalian = $transaksi->bayar - $transaksi->total_harga;
        $transaksi->save();

        return redirect('/transaksi')->with('pesan', 'Berhasil mengubah data');
    }

    public function destroy($id)
    {
        // Menghapus transaksi
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect('/transaksi')->with('pesan', 'Berhasil menghapus data');
    }
}
