
# UAS Praktikum Pemrograman Web 2

## Petunjuk Umum
- Waktu Pengerjaan: 90 Menit
- Silahkan isi form [di sini](https://docs.google.com/forms/d/e/1FAIpQLSdsGI76bli1F9NtgjBjymh9uuHxstz7TJRLdp7g69SxT_LhxA/viewform) jika sudah selesai mengerjakan
- Batas akhir pengisian form 2024-12-03 13:45:00 WIB

## Petunjuk Teknis
- Boleh menggunakan gitlab, github, atau sejenisnya
- Laravel Framework 10.48.25 [Dokumentasi](https://laravel.com/docs/10.x/releases)
- DataTables 2.1.8 [Dokumentasi](https://datatables.net/manual)
- Bootstrap 5.3.3 [Dokumentasi](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- 1 commit untuk 1 file change
- views 'resources/views/layouts.blade.php' adalah core views (dipakai untuk blade views lainnya) 

## Penilaian
- Point maksimal adalah 100
- Point yang tersedia 110

## Hints
- Pindah remote git (commit sebelumnya tidak terhapus) ![Points](https://img.shields.io/badge/Points-4-green)
- Migration tabel transaksi menggunakan softdelete dan timestamp ![Points](https://img.shields.io/badge/Points-2-green)
- Migration tabel transaksidetail menggunakan softdelete dan timestamp ![Points](https://img.shields.io/badge/Points-2-green)
- Password hash yang digunakan adalah 'argon2id' ![Points](https://img.shields.io/badge/Points-2-green)
- Seeder tabel transaksi ![Points](https://img.shields.io/badge/Points-3-green)
- Seeder tabel transaksidetail ![Points](https://img.shields.io/badge/Points-2-green)
- Model transaksi menggunakan softdelete ![Points](https://img.shields.io/badge/Points-2-green)
- Model transaksidetail menggunakan softdelete ![Points](https://img.shields.io/badge/Points-2-green)
- Home route setelah login adalah 'dashboard' ![Points](https://img.shields.io/badge/Points-2-green)
- Semua route dari dashboard, transaksi, transaksidetail wajib login untuk bisa akses (middleware('auth')) ![Points](https://img.shields.io/badge/Points-3-green)
- Data pada dashboard ![Points](https://img.shields.io/badge/Points-5-green)
- Controller Transaksi function index ![Points](https://img.shields.io/badge/Points-1-green)
- Controller Transaksi function store ![Points](https://img.shields.io/badge/Points-10-green)
- Controller Transaksi function edit ![Points](https://img.shields.io/badge/Points-2-green)
- Controller Transaksi function update ![Points](https://img.shields.io/badge/Points-3-green)
- Controller Transaksi function destroy ![Points](https://img.shields.io/badge/Points-2-green)
- Controller TransaksiDetail index ![Points](https://img.shields.io/badge/Points-1-green)
- Controller TransaksiDetail detail ![Points](https://img.shields.io/badge/Points-1-green)
- Controller TransaksiDetail edit ![Points](https://img.shields.io/badge/Points-1-green)
- Controller TransaksiDetail update ![Points](https://img.shields.io/badge/Points-15-green)
- Controller TransaksiDetail destroy ![Points](https://img.shields.io/badge/Points-4-green)
- View dashboard ![Points](https://img.shields.io/badge/Points-2-green)
- View login ![Points](https://img.shields.io/badge/Points-2-green)
- View component datatable ![Points](https://img.shields.io/badge/Points-3-green)
- View transaksi.index (+datatable) ![Points](https://img.shields.io/badge/Points-6-green)
- View transaksi.create ![Points](https://img.shields.io/badge/Points-7-green)
- View transaksi.edit ![Points](https://img.shields.io/badge/Points-6-green)
- View transaksidetail.index (+datatable) ![Points](https://img.shields.io/badge/Points-6-green)
- View transaksidetail.detail ![Points](https://img.shields.io/badge/Points-5-green)
- View transaksidetail.edit ![Points](https://img.shields.io/badge/Points-4-green)
