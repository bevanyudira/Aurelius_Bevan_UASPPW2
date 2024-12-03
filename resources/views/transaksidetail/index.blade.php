@extends('layouts')

@section('content')
    <h2>Data Detail Transaksi</h2>
    <div class="card">
        <div class="card-header bg-white">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pembelian</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksidetail as $index => $data)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->transaksi->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $data->nama_produk }}</td>
                            <td class="text-end">{{ number_format($data->harga_satuan, 0, '.', '.') }}</td>
                            <td class="text-end">{{ number_format($data->jumlah, 0, '.', '.') }}</td>
                            <td class="text-end">{{ number_format($data->subtotal, 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
