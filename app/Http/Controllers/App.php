<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class App extends Controller
{
    //
    public function index()
    {
        $layanan = DB::select('SELECT state, SUM(pelayanan) AS pelayanan FROM (SELECT state, COUNT(kat_layanan) AS pelayanan FROM permintaan_layanan GROUP BY state UNION ALL SELECT state, COUNT(state) AS pelayanan FROM permintaan_gangguan GROUP BY state) x GROUP BY state;');
        $chart = DB::select('SELECT COUNT(a.kat_layanan) AS count, b.id FROM `permintaan_layanan` a RIGHT JOIN `kategori_layanan` b ON a.`kat_layanan` = b.`id` GROUP BY b.id ORDER BY b.id ASC;');
        $text = array();
        foreach ($chart as $char) {
            array_push($text, $char->count);
        }
        $table = DB::select("SELECT * FROM (SELECT 'pelayanan', a.nama AS nama, a.tim_kerja AS tim, a.desc_layanan AS 'desc', a.state AS state, b.timestamp AS 'timestamp' FROM permintaan_layanan a, state_layanan b WHERE a.id = b.id_layanan AND a.state = b.state UNION ALL SELECT 'gangguan', c.nama AS nama, c.tim_kerja AS tim, c.desc_gangguan AS 'desc', c.state AS state, d.timestamp AS 'timestamp' FROM permintaan_gangguan c, state_gangguan d WHERE c.id = d.id_gangguan AND c.state = d.state) tabel ORDER BY tabel.timestamp DESC LIMIT 10;");

        return view('template', ['navbar' => 'Dashboard', 'progress' => $layanan, 'chart' => $text, 'table' => $table]);
    }

    public function tabel()
    {
        $layanan = DB::select('SELECT a.id, a.tiket_number, a.kat_layanan, a.subkat_layanan, nama, no_telp, tim_kerja, desc_layanan, a.state, b.kat_layanan, c.nama_layanan, d.timestamp FROM permintaan_layanan a JOIN kategori_layanan b ON a.kat_layanan = b.id JOIN subkategori_layanan c ON a.subkat_layanan = c.id JOIN state_layanan d ON a.id = d.id_layanan AND a.state = d.state ORDER BY d.timestamp DESC LIMIT 10;');
        $gangguan = DB::select('SELECT * FROM permintaan_gangguan a JOIN state_gangguan b ON a.id = b.id_gangguan AND a.state = b.state ORDER BY b.timestamp DESC LIMIT 10');
        return view('tabel', ['navbar' => 'Tabel Layanan', 'layanan' => $layanan, 'gangguan' => $gangguan]);
    }

}
