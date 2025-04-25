<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Layanan extends Controller
{
    //
    public function send_wa($no_telp, $message)
    {
        // Send message to WhatsApp
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $no_telp, //required
        'message' => $message, 
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: mdXtY4zGAF2V9BRmRdgS' //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function pelayanan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'no_telp' => ['required', 'regex:/(\+62|62|0)8[0-9]{10}/'],
            'tim_kerja' => 'required',
            'kat_layanan' => 'required',
            'subkat_layanan' => 'required',
            'desc_layanan' => 'required'
        ]);

        try {
            $post_req = $request->post();
            $user_id = auth()->user()->id;
            $rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 5);

            $add_on = [
                'id_pelapor' => $user_id,
                'state' => '0',
                'tiket_number' => "REQ-" . date('Ymd') . "-" . $rand,
            ];
            $post = array_merge($post_req, $add_on);
            unset($post['_token']);
            $id_layanan = DB::table('permintaan_layanan')->insertGetId($post);

            $state = [
                'id_layanan' => $id_layanan,
                'state' => '0',
                'operator' => $user_id
            ];
            DB::table('state_layanan')->insertGetId($state);

            $message = "Permintaan Layanan Anda [" . $add_on['tiket_number'] ."]  terkait \"" . $post_req['desc_layanan'] . "\" telah kami terima.\n";
            $message .= "Kami akan segera memproses permintaan Anda dan menghubungi Anda melalui nomor telepon yang telah Anda berikan.\n";
            $message .= "Terima kasih " . $post_req['nama'] . " telah menggunakan layanan kami.";

            $this->send_wa($post_req['no_telp'], $message);

            return redirect()->back()->with('success', 'Permintaaan layanan berhasil diajukan.');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            return redirect()->back()->with('error', 'Permintaan layanan gagal diajukan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function gangguan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'no_telp' => ['required', 'regex:/(\+62|62|0)8[0-9]{10}/'],
            'tim_kerja' => 'required',
            'desc_gangguan' => 'required'
        ]);

        try {

            $post_req = $request->post();
            $user_id = auth()->user()->id;
            $rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 5);

            $add_on = [
                'id_pelapor' => $user_id,
                'state' => '0',
                'tiket_number' => "INC-" . date('Ymd') . "-" . $rand,
            ];
            $post = array_merge($post_req, $add_on);

            unset($post['_token']);
            $id_gangguan = DB::table('permintaan_gangguan')->insertGetId($post);

            $state = [
                'id_gangguan' => $id_gangguan,
                'state' => '0',
                'operator' => $user_id
            ];
            DB::table('state_gangguan')->insertGetId($state);

            $message = "Laporan Gangguan Anda [" . $add_on['tiket_number'] ."] terkait \"" . $post_req['desc_gangguan'] . "\" telah kami terima.\n";
            $message .= "Kami akan segera memproses laporan Anda dan menghubungi Anda melalui nomor telepon yang telah Anda berikan.\n";
            $message .= "Terima kasih " . $post_req['nama'] . " telah menggunakan layanan kami.";

            $this->send_wa($post_req['no_telp'], $message);

            return redirect()->back()->with('success', 'Gangguan berhasil dilaporkan.');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            return redirect()->back()->with('error', 'Laporan gangguan gagal diajukan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function user()
    {
        return auth()->user();
    }

    public function profile()
    {
        $username = auth()->user()['name'];

        return view('profile', ['navbar' => 'Profil', 'username' => auth()->user()['name']]);
    }

    public function proses_layanan($tiket, $state)
    {

        $layanan = DB::table('permintaan_layanan')
            ->where('tiket_number', $tiket)
            ->first();

        if ($layanan) {
            if ($state == "2") {
                $is_tl = DB::table('tindak_lanjut_layanan')
                ->where('id_layanan', $layanan->id)
                ->first();
                if (!$is_tl) {
                    return redirect()->back()->with('error', 'Tindak lanjut layanan belum tersedia.');
                }
            }

            // Update kolom state
            DB::table('permintaan_layanan')
                ->where('tiket_number', $tiket)
                ->update(['state' => $state]);
    
            // Tambahkan ke state_layanan untuk mencatat perubahan state
            $insert = [
                'id_layanan' => $layanan->id,
                'state' => $state,
                'operator' => auth()->user()->id
            ];
            DB::table('state_layanan')->insert($insert);
    
            return redirect()->back()->with('success', 'State berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function proses_gangguan($tiket, $state)
    {

        $gangguan = DB::table('permintaan_gangguan')
            ->where('tiket_number', $tiket)
            ->first();

        if ($gangguan) {
            if ($state == "2") {
                $is_tl = DB::table('tindak_lanjut_gangguan')
                ->where('id_gangguan', $gangguan->id)
                ->first();
                if (!$is_tl) {
                    return redirect()->back()->with('error', 'Tindak lanjut gangguan belum tersedia.');
                }
            }

            // Update kolom state
            DB::table('permintaan_gangguan')
                ->where('tiket_number', $tiket)
                ->update(['state' => $state]);
    
            // Tambahkan ke state_gangguan untuk mencatat perubahan state
            $insert = [
                'id_gangguan' => $gangguan->id,
                'state' => $state,
                'operator' => auth()->user()->id
            ];
            DB::table('state_gangguan')->insert($insert);
    
            return redirect()->back()->with('success', 'State berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function tindak_lanjut_layanan(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'tindak_lanjut' => 'required'
        ]);

        try {
            $post_req = $request->post();
            $user_id = auth()->user()->id;

            $layanan = DB::table('permintaan_layanan')
            ->where('tiket_number', $post_req['token'])
            ->first();

            if ($layanan) {
                $post = [
                    'id_layanan' => $layanan->id,
                    'tindak_lanjut' => $post_req['tindak_lanjut'],
                    'operator' => auth()->user()->id
                ];

                // Insert data ke tabel tindak_lanjut_layanan
                DB::table('tindak_lanjut_layanan')->insert($post);

                // Update kolom state
                DB::table('permintaan_layanan')
                ->where('tiket_number', $post_req['token'])
                ->update(['state' => '2']);
                
                // Update state_layanan untuk mencatat perubahan state
                $insert = [
                    'id_layanan' => $layanan->id,
                    'state' => '2',
                    'operator' => auth()->user()->id
                ];
                DB::table('state_layanan')->insert($insert);

                // Kirim pesan WhatsApp
                $message = "Tindak lanjut untuk permintaan layanan Anda [" . $post_req['token'] . "] telah berhasil ditambahkan oleh " . auth()->user()->name . ".\n";
                $message .= "Tindak lanjut: " . $post_req['tindak_lanjut'] . "\n";
                $message .= "Terima kasih telah menggunakan layanan kami.";
                $this->send_wa($layanan->no_telp, $message);

                return redirect()->back()->with('success', 'Tindak lanjut berhasil ditambahkan.');

            } else {
                // Jika data tidak ditemukan, tampilkan pesan error
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            return redirect()->back()->with('error', 'Tindak lanjut gagal ditambahkan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }
    
    public function tindak_lanjut_gangguan(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'tindak_lanjut' => 'required',
            'tindak_lanjut_desc' => 'required'
        ]);

        try {
            $post_req = $request->post();
            $user_id = auth()->user()->id;

            $add_on = [
                'id_gangguan' => $post_req['id_gangguan'],
                'operator' => $user_id,
                'state' => '2',
            ];
            $post = array_merge($post_req, $add_on);
            unset($post['_token']);
            DB::table('tindak_lanjut_gangguan')->insertGetId($post);

            return redirect()->back()->with('success', 'Tindak lanjut berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            return redirect()->back()->with('error', 'Tindak lanjut gagal ditambahkan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }
}
