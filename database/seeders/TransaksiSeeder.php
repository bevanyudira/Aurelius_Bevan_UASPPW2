<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tentukan tanggal mulai dan akhir
        $startDate = Carbon::create(2024, 11, 1); // Tanggal mulai (1 November 2024)
        $endDate = Carbon::create(2024, 11, 10); // Tanggal akhir (10 November 2024)

        // Loop melalui rentang tanggal dari startDate sampai endDate
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Gunakan Faker untuk menghasilkan jumlah transaksi acak antara 15 dan 20
            $numberOfTransactions = $faker->numberBetween(15, 20);

            // Loop untuk membuat transaksi sebanyak $numberOfTransactions
            for ($i = 0; $i < $numberOfTransactions; $i++) {
                Transaksi::create([
                    'tanggal_pembelian' => $date->format('Y-m-d'),
                    'total_harga' => 0, // Nilai sementara
                    'bayar' => 0, // Nilai sementara
                    'kembalian' => 0, // Nilai sementara
                ]);
            }
        }
    }
}
