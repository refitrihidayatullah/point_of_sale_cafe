<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Validators\KategoriValidator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kategori = Kategori::orderByDesc('created_at')->get();
        return view(
            'admin.master_data.kategori.data_kategori',
            [
                'data_kategori' => $data_kategori,
            ]
        );
    }

    /**
     * generate kode kategori.
     *
     * 
     */
    // private function generateCode()
    // {
    //     $prefix = "KTG-";
    //     $random = mt_rand(1000, 9999);
    //     $code = $prefix . $random;
    //     // cek agar tidak duplicate
    //     while (Kategori::where('kd_kategori', $code)->exists()) {
    //         $random = mt_rand(1000, 9999);
    //         $code = $prefix . $random;
    //     }
    //     return $code;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $code = $this->generateCode();
        $code = GenerateCodeAuto::generateCode('KTG-', Kategori::class, 'kd_kategori');
        return view(
            'admin.master_data.kategori.create_kategori',
            [
                'kd_kategori' => $code,
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
        $data = [
            'kd_kategori' => GenerateCodeAuto::generateCode('KTG-', Kategori::class, 'kd_kategori'),
            'nama_kategori' => $request->nama_kategori,
        ];
        $validator = KategoriValidator::validatorRules($data);
        if ($validator->fails()) {
            return redirect('/kategori/create')->withErrors($validator)->withInput();
        }
        try {
            Kategori::create($data);
            return redirect('/kategori')->with('success', 'data kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('failed', 'Terjadi kesalahan' . $e->getMessage());
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
        $data_kategori = Kategori::where('kd_kategori', decrypt($id))->first();
        return view(
            'admin.master_data.kategori.edit_kategori',
            [
                'data_kategori' => $data_kategori,
            ]
        );
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
        $validator = KategoriValidator::validatorRules($data);
        if ($validator->fails()) {
            return redirect("/kategori/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->all();
            $kategori = Kategori::where('kd_kategori', decrypt($id))->first();
            $kategori->fill($data);
            $kategori->save();
            return redirect('/kategori')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $kategori = kategori::find(decrypt($id));
        if ($kategori) {
            $kategori->delete();
            return redirect('/kategori')->with('success', 'data berhasil dihapus');
        } else {
            return redirect('/kategori')->with('failed', 'data tidak ditemukan');
        }
    }
}
