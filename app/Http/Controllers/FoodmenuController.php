<?php

namespace App\Http\Controllers;

use File;
use Alert;

use App\Models\Foodmenu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FoodmenuController extends Controller
{
    protected $routeIndex;
    public function __construct()
    {
        $this->routeIndex = route('menu.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Makanan & Minuman';
        $foods = Foodmenu::all();
        return view('admin.index', compact('foods', 'title'));
    }
    public function dashboard()
    {

        $bulan = Carbon::now()->format('m');
        $hari = date('Y-m-d');
        $penghasilan_perbulan = Transaksi::whereMonth('created_at', '=', $bulan)->sum('total_harga');
        $penghasilan_perhari = Transaksi::where('tanggal_transaksi', $hari)->sum('total_harga');
        $title = 'Dashboard Admin';
        $foods = Foodmenu::all();
        return view('admin.dashboard', compact('foods', 'title', 'penghasilan_perbulan', 'penghasilan_perhari'));
    }

    public function menu_makanan()
    {
        $title = 'Daftar Makanan Dapur Rempong';
        $foods = Foodmenu::where('food_jenis', 'Makanan')->get();
        // dd($foods);
        return view('customer.index', compact('foods', 'title'));
    }

    public function menu_minuman()
    {
        $title = 'Daftar Minuman Dapur Rempong';
        $foods = Foodmenu::where('food_jenis', 'Minuman')->get();
        // dd($foods);
        return view('customer.index', compact('foods', 'title'));
    }
    public function menu_cemilan()
    {
        $title = 'Daftar Cemilan Dapur Rempong';
        $foods = Foodmenu::where('food_jenis', 'Cemilan')->get();
        // dd($foods);
        return view('customer.index', compact('foods', 'title'));
    }
    public function menu_catering()
    {
        $title = 'Daftar Catering Dapur Rempong';
        $foods = Foodmenu::where('food_jenis', 'Catering')->get();
        // dd($foods);
        return view('customer.index', compact('foods', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Makanan & Minuman';
        $foods = Foodmenu::where('food_jenis', 'Makanan')->get();
        // dd($foods);
        return view('admin.tambah', compact('foods', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = $request->validate([
            'food_name' => ['required', 'unique:foodmenus,food_name'],
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'deskripsi' => ['required'],
            'harga' => ['required'],
        ]);

        $nm = $request->image;
        $namafile = $nm->getClientOriginalName();
        $rename = date('YmdHis') . '.' . $namafile;
        $nm->move(public_path() . '/img', $rename);
        $data['food_name'] =  $request->food_name;
        $data['food_jenis'] =  $request->jenis;
        $data['status'] = $request->status;
        $data['harga'] = $request->harga;
        $data['deskripsi'] = $request->deskripsi;
        // $data['created_by'] =  auth()->user()->name;
        // var_dump($data['food_jenis']);
        // exit();

        $data['foto'] = $rename;

        Foodmenu::create($data);
        Alert::success('Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('superadmin.menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foodmenu  $foodmenu
     * @return \Illuminate\Http\Response
     */
    public function show(Foodmenu $foodmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foodmenu  $foodmenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = 'Edit Data Makanan & Minuman';
        $foods = Foodmenu::find($id);
        return view('admin.edit', compact('foods', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foodmenu  $foodmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $foods = Foodmenu::findOrFail($id);
        $path = public_path() . '/img/';
        // dd($foods->foto);

        $data = $request->validate([
            'food_name' => ['required'],
            'deskripsi' => ['required'],
        ]);


        $data['food_name'] =  $request->food_name;
        $data['food_jenis'] =  $request->jenis;
        $data['status'] = $request->status;
        $data['harga'] = $request->harga;
        $data['deskripsi'] = $request->deskripsi;

        if ($request->image != null) {
            $data = $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            ]);
            if ($foods->foto != ''  && $foods->foto != null) {
                $file_old = $path . $foods->foto;
                unlink($file_old);
            }
            $nm = $request->image;
            $namafile = $nm->getClientOriginalName();
            $rename = date('YmdHis') . '.' . $namafile;
            $nm->move(public_path() . '/img', $rename);
            $data['foto'] = $rename;
        }

        $foods->update($data);

        Alert::success('Berhasil', 'Data Berhasil diedit');
        return redirect()->route('superadmin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foodmenu  $foodmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    // hapus file
        $gambar = Foodmenu::where('id', $id)->first();
        File::delete('img/' . $gambar->foto);

        $foodmenu = Foodmenu::findOrFail($id);
        $foodmenu->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus!');
        return redirect()->route('superadmin.menu.index');
    }
}
