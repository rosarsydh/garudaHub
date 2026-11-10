<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [1, 'Admin Garuda', 'admin@example.com', 'admin'],
            [2, 'Budi Santoso', 'budi@example.com', 'klien'],
            [3, 'Siti Rahayu', 'siti@example.com', 'klien'],
            [4, 'Agus Wijaya', 'agus@example.com', 'klien'],
            [5, 'Dewi Lestari', 'dewi@example.com', 'developer'],
            [6, 'Eko Prasetyo', 'eko@example.com', 'developer'],
            [7, 'Fitri Handayani', 'fitri@example.com', 'developer'],
            [8, 'Gilang Ramadhan', 'gilang@example.com', 'developer'],
        ];
        foreach ($users as [$id, $name, $email, $role]) {
            User::forceCreate([
                'id' => $id, 'name' => $name, 'email' => $email,
                'role' => $role, 'password' => 'password',
            ]);
        }

        $projects = [
            [1, 2, 'Website Toko Batik Online', 'Membutuhkan toko online dengan katalog produk, keranjang, dan halaman kontak. Desain responsif.', 'Web', 5000000, 10000000, '2027-12-31', 'terbuka'],
            [2, 2, 'Aplikasi Kasir Android', 'Aplikasi kasir sederhana untuk warung: catat transaksi, laporan harian, cetak struk via Bluetooth.', 'Mobile', 8000000, 15000000, '2027-11-30', 'terbuka'],
            [3, 3, 'Redesain Logo dan UI Kit', 'Redesain identitas visual startup kuliner beserta UI kit untuk aplikasi pemesanan.', 'Desain', 2000000, 4000000, '2026-09-01', 'ditutup'],
            [4, 3, 'Dashboard Analitik Penjualan', 'Dashboard grafik penjualan bulanan dari file CSV, dengan filter per cabang dan ekspor laporan.', 'Data', 6000000, 12000000, '2027-10-15', 'terbuka'],
            [5, 4, 'Chatbot Layanan Pelanggan', 'Chatbot FAQ untuk situs sekolah, dapat dijawab dalam bahasa Indonesia.', 'AI', 4000000, 8000000, '2026-08-20', 'terbuka'],
            [6, 4, 'Sistem Absensi Sekolah', 'Sistem absensi siswa berbasis web dengan rekap per kelas dan laporan bulanan untuk wali kelas.', 'Web', 7000000, 14000000, '2026-07-10', 'ditutup'],
            [7, 2, 'Migrasi Database ke MySQL', 'Memindahkan data inventaris dari spreadsheet ke MySQL dan membuat skrip impor.', 'Data', 3000000, 6000000, '2026-06-30', 'ditutup'],
            [8, 3, 'Landing Page Event Kampus', 'Satu halaman informasi acara seminar teknologi dengan formulir pendaftaran sederhana.', 'Web', 1500000, 3000000, '2027-09-01', 'terbuka'],
        ];
        foreach ($projects as [$id, $client, $judul, $desk, $kat, $min, $max, $batas, $status]) {
            Project::forceCreate([
                'id' => $id, 'client_id' => $client, 'judul' => $judul, 'deskripsi' => $desk,
                'kategori' => $kat, 'budget_min' => $min, 'budget_max' => $max,
                'batas_lelang' => $batas, 'status' => $status,
            ]);
        }

        $bids = [
            [1, 1, 5, 8500000, 30, 'Saya akan membangun dengan PHP dan MySQL, lengkap dengan panel admin produk.', 0],
            [2, 1, 6, 7000000, 40, 'Pengalaman 3 tahun membuat toko online. Termasuk pelatihan penggunaan.', 0],
            [3, 1, 7, 9500000, 25, 'Desain premium bernuansa batik, dukungan perawatan 3 bulan.', 0],
            [4, 2, 5, 12000000, 45, 'Aplikasi native Kotlin, dukungan printer Bluetooth termasuk.', 0],
            [5, 2, 8, 10000000, 50, 'Memakai Flutter agar bisa juga dipakai di iOS nanti.', 0],
            [6, 3, 6, 3000000, 14, 'Tiga konsep logo dan UI kit lengkap di Figma.', 1],
            [7, 3, 7, 3500000, 10, 'Revisi tak terbatas selama 2 minggu.', 0],
            [8, 4, 8, 9000000, 35, 'Dashboard dengan Chart dan ekspor PDF.', 0],
            [9, 4, 5, 11000000, 30, 'Termasuk modul impor CSV otomatis.', 0],
            [10, 4, 6, 7500000, 45, 'Fokus pada grafik interaktif dan filter cabang.', 0],
            [11, 5, 7, 6000000, 30, 'Chatbot berbasis aturan dengan basis pengetahuan FAQ sekolah.', 0],
            [12, 6, 8, 11000000, 40, 'Sistem lengkap dengan rekap otomatis dan ekspor Excel.', 1],
            [13, 6, 5, 13000000, 35, 'Termasuk aplikasi pemindai kode QR untuk absensi.', 0],
            [14, 7, 6, 4500000, 15, 'Skrip impor dengan validasi data dan laporan galat.', 1],
            [15, 7, 7, 5000000, 12, 'Termasuk dokumentasi skema dan pelatihan singkat.', 0],
        ];
        foreach ($bids as [$id, $pid, $dev, $harga, $durasi, $proposal, $win]) {
            Bid::forceCreate([
                'id' => $id, 'project_id' => $pid, 'developer_id' => $dev,
                'harga' => $harga, 'durasi' => $durasi, 'proposal' => $proposal,
                'is_winner' => (bool) $win,
            ]);
        }
    }
}
