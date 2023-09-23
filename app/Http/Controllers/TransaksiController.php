<?php

namespace App\Http\Controllers;

use App\Models\Foodmenu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Transaksi';
        $transaksis = Transaksi::all()->sortDesc();

        return view('admin.transaksi.index', compact('transaksis', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        $transaksis = Transaksi::where('tanggal_transaksi', date('Y-m-d'))->latest()->first();
        $kode = 'TR';
        $tahun = date('ymd');
        if ($transaksis == null) {
            $nomorUrut = "1";
        } else {
            $nomorUrut = substr($transaksis->kode_transaksi, 9) + 1;
            // var_dump($nomorUrut);
            // die;
        }
        $kode_transaksi = $kode . $tahun . '-' . $nomorUrut;


        Transaksi::create([
            'kode_transaksi' => $kode_transaksi,
            'tanggal_transaksi' => date('Y-m-d'),
            'status' => ('Belum')

        ]);


        // Alert::success('Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('superadmin.transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = 'Edit Transaksi';
        $transaksi = Transaksi::find($id);
        $makanans = Foodmenu::all();

        return view('admin.transaksi.tambahpesanan', compact('title', 'transaksi', 'makanans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus!');
        return redirect()->route('superadmin.transaksi.index');
    }
}
