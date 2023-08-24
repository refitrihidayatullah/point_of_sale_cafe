<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Validators\SupplierValidator;

class SupplierAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_supplier = Supplier::select('kd_supplier', 'nama_supplier', 'alamat_supplier', 'no_telp_supplier')->orderByDesc('updated_at')->get();
        return view(
            'admin.master_data.supplier.data_supplier',
            ['data_supplier' => $data_supplier]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->generateSupplierCode();

        return view('admin.master_data.supplier.create_supplier', [
            'kd_supplier' => $data
        ]);
    }

    /**
     * Generate kode supplier
     *
     *
     *
     */
    protected function generateSupplierCode()
    {
        $prefix = 'SUP';
        $random = mt_rand(1000, 9999);
        $code = $prefix . $random;
        // cek di database pastikan code unique
        while (Supplier::where('kd_supplier', $code)->exists()) {
            $random = mt_rand(1000, 9999);
            $code = $prefix . $random;
        }
        return $code;
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
        $validator = SupplierValidator::validatorStore($data);
        if ($validator->fails()) {
            return redirect('/supplier/create')->withErrors($validator)->withInput();
        }
        try {
            Supplier::create($data);
            return redirect('/supplier')->with('success', 'Data Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $data_supplier = Supplier::where('kd_supplier', decrypt($id))->first();
        return view('admin.master_data.supplier.edit_supplier', ['data_supplier' => $data_supplier]);
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
        $validator = SupplierValidator::validatorStore($data);
        if ($validator->fails()) {
            return redirect("/supplier/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->all();
            $supplier = Supplier::where('kd_supplier', decrypt($id))->first();
            $supplier->fill($data); // Mengisi atribut model dengan data dari request
            $supplier->update();
            // DB::table('suppliers')
            //     ->where('kd_supplier', decrypt($id))
            //     ->update($data);
            return redirect('/supplier')->with('success', 'Data Berhasil diupdate');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $supplier = Supplier::find(decrypt($id));
        if ($supplier) {
            $supplier->delete();
            return redirect('/supplier')->with('success', 'data berhasil dihapus');
        } else {
            return redirect('/supplier')->with('failed', 'data tidak ditemukan');
        }
    }
}
