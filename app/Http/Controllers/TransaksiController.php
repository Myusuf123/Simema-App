<?php

namespace App\Http\Controllers;

use App\Models\Foodmenu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksipembelian;
use Illuminate\Support\Facades\DB;
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

    public function tambah_transaksi_menu(Request $request)
    {
        //
        // var_dump('ok');
        $harga = Foodmenu::find($request->foodmenu_id);
        $total_harga = $harga->harga * $request->jumlah;
        // die;
        $transaksi_pembelians = Transaksipembelian::create([
            'kode_transaksi_id' => $request->kode_transaksi_id,
            'foodmenu_id' => $request->foodmenu_id,
            'jumlah_pesanan' => $request->jumlah,
            'totalharga' => $total_harga

        ]);


        // Alert::success('Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('superadmin.transaksi.edit', $request->transaksi_id);
        // return redirect()->route('superadmin.transaksi.index');
    }

    public function update_transaksi_menu(Request $request, $id)
    {
        //
        // var_dump('ok');
        $update = Transaksi::find($id);

        // die;
        $data = [

            'total_harga' => $request->total_bayar,
            'jumlah_bayar' => $request->jumlah_bayar,
            'status' => 'Selesai',
        ];

        $update->update($data);


        Alert::success('Berhasil', 'Data Berhasil disimpan');
        return redirect()->route('superadmin.transaksi.index');
        // return redirect()->route('superadmin.transaksi.index');
    }

    public function cetak_struk($id)
    {
        // $pdf = Pdf::loadView('admin.cetak.struk');

        $transaksi = Transaksi::find($id);
        $transaksi_pembelians = Transaksipembelian::with('foodmenu')->where('kode_transaksi_id', $transaksi->kode_transaksi)->get();
        $total_bayar = Transaksipembelian::where('kode_transaksi_id', $transaksi->kode_transaksi)->sum('totalharga');
        return view('admin.cetak.struk', compact('transaksi', 'transaksi_pembelians', 'total_bayar'));
        // return $pdf->stream('testfile.pdf');
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
        $transaksi_pembelians = Transaksipembelian::with('foodmenu')->where('kode_transaksi_id', $transaksi->kode_transaksi)->get();
        $total_bayar = Transaksipembelian::where('kode_transaksi_id', $transaksi->kode_transaksi)->sum('totalharga');
        $makanans = Foodmenu::all();

        return view('admin.transaksi.tambahpesanan', compact('title', 'transaksi', 'transaksi_pembelians', 'makanans', 'total_bayar'));
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
        DB::table('transaksi_pembelians')->where('kode_transaksi_id', $transaksi->kode_transaksi)->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus!');
        return redirect()->route('superadmin.transaksi.index');
    }
}
