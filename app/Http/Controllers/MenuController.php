<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Validators\MenuValidator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $key = $request->key;
        if (strlen($key)) {
            $get_barang = Menu::with('kategori')->where('nama_barang', 'like', "%$key%")
                ->orWhere('barcode', 'like', '%$key%')
                ->orWhere('kategori_id', 'like', '%$key%')
                ->orWhere('harga_beli', 'like', '%$key%')
                ->orWhere('harga_jual', 'like', '%$key%')
                ->orWhere('stock', 'like', '%$key%')
                ->orWhere('keterangan', 'like', '%$key%')
                ->paginate();
        } else {
            $get_barang = Menu::with('kategori')->orderByDesc('created_at')->Paginate(5);
        }

        return view(
            'admin.master_data.menu.data_menu',
            [
                'get_barang' => $get_barang,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kategori = Kategori::all();
        return view(
            'admin.master_data.menu.create_menu',
            [
                'data_kategori' => $data_kategori,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = MenuValidator::validatorRules($data);
        if ($validator->fails()) {
            return redirect('/menu/create')->withErrors($validator)->withInput();
        }
        try {
            // if ($request->barcode == null)
            //     $barcode = GenerateCodeAuto::barcode(Menu::class, 'barcode');
            // else {
            //     $barcode = $request->barcode;
            // }

            // instance object
            // $newBarang = new Menu([
            //     'kd_barang' => GenerateCodeAuto::generateCode('MN-', Menu::class, 'kd_barang'),
            //     'barcode' => $barcode,
            //     'nama_barang' => $request->nama_barang,
            //     'kategori_id' => $request->kategori,
            //     'harga_beli' => $request->harga_beli,
            //     'harga_jual' => $request->harga_jual,
            //     'stock' => $request->stock,
            //     'keterangan' => $request->keterangan,
            // ]);
            // custom query create di model
            // $newBarang->insertBarang();
            Menu::insertBarang($request);
            return redirect('/menu')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/menu')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_barang = Menu::with('kategori')->where('kd_barang', decrypt($id))->first();
        $kategori = Kategori::all();
        // dd($data_barang);
        return view('admin.master_data.menu.edit_menu', ['data_barang' => $data_barang, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = MenuValidator::validatorRules($data);
        if ($validator->fails()) {
            return redirect("/menu/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $barang = Menu::find(decrypt($id));
            if ($barang) {
                if ($request->barcode == null) {
                    $barcode = GenerateCodeAuto::barcode(Menu::class, 'barcode');
                } else {
                    $barcode = $request->barcode;
                }
                $harga_beli = str_replace('.', '', $request->harga_beli);
                $harga_jual = str_replace('.', '', $request->harga_jual);
                $newupdate = [
                    'nama_barang' => $request->nama_barang,
                    'barcode' => $barcode,
                    'kategori_id' => $request->kategori,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'stock' => $request->stock,
                    'keterangan' => $request->keterangan,
                ];

                $barang->update($newupdate);
                return redirect('/menu')->with('success', 'data berhasil diubah');
            } else {
                return redirect('/menu')->with('failed', 'data Tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect('/menu')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Menu::find(decrypt($id));
        if ($barang) {
            $barang->delete();
            return redirect('/menu')->with('success', 'data berhasil dihapus');
        } else {
            return redirect('/menu')->with('failed', 'data tidak ditemukan');
        }
    }
}
