<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        // Mengambil semua transaksi detail dengan relasi transaksi
        $transaksidetail = TransaksiDetail::with('transaksi')
            ->orderBy('id', 'DESC')
            ->get();

        return view('transaksidetail.index', compact('transaksidetail'));
    }

    public function detail(Request $request)
    {
        // Mengambil transaksi berdasarkan id dan relasi transaksidetail
        $transaksi = Transaksi::with('transaksidetail')
            ->findOrFail($request->id_transaksi);

        return view('transaksidetail.detail', compact('transaksi'));
    }

    public function edit($id)
    {
        // Mengambil transaksi detail berdasarkan id
        $transaksidetail = TransaksiDetail::findOrFail($id);

        return view('transaksidetail.edit', compact('transaksidetail'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'nama_produk' => 'required|string',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();  // Memulai transaksi

            // Cari transaksi detail berdasarkan id
            $transaksidetail = TransaksiDetail::findOrFail($id);
            $transaksidetail->nama_produk = $request->input('nama_produk');
            $transaksidetail->harga_satuan = $request->input('harga_satuan');
            $transaksidetail->jumlah = $request->input('jumlah');
            $transaksidetail->subtotal = $request->input('harga_satuan') * $request->input('jumlah');
            $transaksidetail->save();

            // Update total harga transaksi
            $transaksi = Transaksi::findOrFail($transaksidetail->id_transaksi);
            $transaksi->total_harga = $transaksi->transaksidetail->sum('subtotal');
            $transaksi->kembalian = $transaksi->bayar - $transaksi->total_harga;
            $transaksi->save();

            DB::commit();  // Komit transaksi

            return redirect('transaksidetail/' . $transaksidetail->id_transaksi)
                ->with('pesan', 'Berhasil mengubah data');
        } catch (\Exception $e) {
            DB::rollback();  // Rollback jika ada error
            return redirect()->back()
                ->withErrors(['Transaction' => 'Gagal mengubah data'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();  // Memulai transaksi

            // Cari transaksi detail berdasarkan id
            $transaksidetail = TransaksiDetail::findOrFail($id);
            $transaksi = Transaksi::findOrFail($transaksidetail->id_transaksi);

            $transaksidetail->delete();  // Hapus transaksi detail

            // Update total harga di transaksi
            $transaksi->total_harga = $transaksi->transaksidetail->sum('subtotal');
            $transaksi->kembalian = $transaksi->bayar - $transaksi->total_harga;
            $transaksi->save();

            DB::commit();  // Komit transaksi

            return redirect('transaksidetail/' . $transaksidetail->id_transaksi)
                ->with('pesan', 'Berhasil menghapus data');
        } catch (\Exception $e) {
            DB::rollback();  // Rollback jika ada error
            return redirect()->back()
                ->withErrors(['Transaction' => 'Gagal menghapus data']);
        }
    }
}
