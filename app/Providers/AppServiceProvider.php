<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;
use App\Models\Gangguan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Permintaan Layanan: join ke tabel state dan tindak lanjut
            $notif_layanan = DB::table('minidb_permintaan_layanan as pl')
                ->join('minidb_state_layanan as st', 'pl.id', '=', 'st.id_layanan')
                ->leftJoin('minidb_tindak_lanjut_layanan as tl', 'pl.id', '=', 'tl.id_layanan')
                ->where('st.state', 0)
                ->orderByDesc('st.timestamp')
                ->select(
                    'pl.*',
                    'st.state',
                    'st.timestamp',
                    'tl.tindak_lanjut as tindak_lanjut'
                )
                ->limit(5)
                ->get();

            // Laporan Gangguan: join ke tabel state dan tindak lanjut
            $notif_gangguan = DB::table('minidb_permintaan_gangguan as pg')
                ->join('minidb_state_gangguan as st', 'pg.id', '=', 'st.id_gangguan')
                ->leftJoin('minidb_tindak_lanjut_gangguan as tl', 'pg.id', '=', 'tl.id_gangguan')
                ->where('st.state', 0)
                ->orderByDesc('st.timestamp')
                ->select(
                    'pg.*',
                    'st.state',
                    'st.timestamp',
                    'tl.tindak_lanjut as tindak_lanjut'
                )
                ->limit(5)
                ->get();

            $view->with('notif_layanan', $notif_layanan)
                 ->with('notif_gangguan', $notif_gangguan);
        });
    }
}
