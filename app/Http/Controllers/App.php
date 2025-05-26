<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class App extends Controller
{

    public function index()
    {
        // Ambil data progress layanan dan gangguan
        $progress = collect(
            \DB::select("
                SELECT state, SUM(pelayanan) AS pelayanan FROM (
                    SELECT state, COUNT(kat_layanan) AS pelayanan FROM minidb_permintaan_layanan GROUP BY state
                    UNION ALL
                    SELECT state, COUNT(state) AS pelayanan FROM minidb_permintaan_gangguan GROUP BY state
                ) x GROUP BY state
            ")
        );

        // Ambil data chart jumlah permintaan per kategori layanan
        $chartRaw = \DB::select("
            SELECT COUNT(a.kat_layanan) AS count, b.id
            FROM minidb_permintaan_layanan a
            RIGHT JOIN minidb_kategori_layanan b ON a.kat_layanan = b.id
            GROUP BY b.id
            ORDER BY b.id ASC
        ");
        $chart = array_map(fn($item) => $item->count, $chartRaw);

        // Ambil data tabel 10 aktivitas terakhir
        $table = \DB::select("
            SELECT * FROM (
                SELECT 'pelayanan' AS tipe, a.nama, a.tim_kerja AS tim, a.desc_layanan AS `desc`, a.state, b.timestamp
                FROM minidb_permintaan_layanan a
                JOIN minidb_state_layanan b ON a.id = b.id_layanan AND a.state = b.state
                UNION ALL
                SELECT 'gangguan' AS tipe, c.nama, c.tim_kerja AS tim, c.desc_gangguan AS `desc`, c.state, d.timestamp
                FROM minidb_permintaan_gangguan c
                JOIN minidb_state_gangguan d ON c.id = d.id_gangguan AND c.state = d.state
            ) tabel
            ORDER BY tabel.timestamp DESC
            LIMIT 10
        ");

        return view('template', [
            'navbar'   => 'Dashboard',
            'progress' => $progress,
            'chart'    => $chart,
            'table'    => $table,
        ]);
    }

    public function tabel()
    {
        $layanan = DB::select('SELECT a.id, a.tiket_number, a.kat_layanan, a.subkat_layanan, nama, no_telp, tim_kerja, desc_layanan, a.state, b.kat_layanan, c.nama_layanan, d.timestamp, e.tindak_lanjut FROM minidb_permintaan_layanan a JOIN minidb_kategori_layanan b ON a.kat_layanan = b.id JOIN minidb_subkategori_layanan c ON a.subkat_layanan = c.id JOIN minidb_state_layanan d ON a.id = d.id_layanan AND a.state = d.state LEFT JOIN minidb_tindak_lanjut_layanan e ON a.id = e.id_layanan ORDER BY d.timestamp DESC LIMIT 10');
        $gangguan = DB::select('SELECT a.*, c.tindak_lanjut FROM minidb_permintaan_gangguan a JOIN minidb_state_gangguan b ON a.id = b.id_gangguan AND a.state = b.state LEFT JOIN minidb_tindak_lanjut_gangguan c ON a.id = c.id_gangguan ORDER BY b.timestamp DESC LIMIT 10');
        
        // return view('tabel', ['navbar' => 'Tabel Layanan', 'layanan' => $layanan, 'gangguan' => $gangguan]);
        $user = Auth::user();
        if ($user && in_array($user->role, ['admin', 'pj'])) {
            return view('tabel_admin', ['navbar' => 'Manajemen Tabel', 'layanan' => $layanan, 'gangguan' => $gangguan]);
        } else {
            return view('tabel', ['navbar' => 'Tabel Layanan', 'layanan' => $layanan, 'gangguan' => $gangguan]);
        }
    }

}
