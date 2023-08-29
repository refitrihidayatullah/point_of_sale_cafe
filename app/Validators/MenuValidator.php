<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class MenuValidator
{
    public static function validatorRules(array $data)
    {
        return Validator::make($data, [
            'nama_barang' => 'required',
            // 'barcode' => 'digits:12',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric|min:0|not_in:-0',
            'harga_jual' => 'required|numeric|min:0|not_in:-0',
            'stock' => 'required|numeric|min:0|not_in:-0',
        ], [
            'nama_barang.required' => 'nama barang harus diisi',
            'kategori.required' => 'kategori harus diisi',
            'harga_beli.required' => 'harga beli harus diisi',
            'harga_beli.numeric' => 'harga beli harus angka',
            'harga_beli.min' => 'harga beli minimal 0 tidak boleh negatif',
            'harga_beli.not_in' => 'harga beli minimal 0 tidak boleh negatif',
            'harga_jual.required' => 'harga jual harus diisi',
            'harga_jual.numeric' => 'harga jual harus angka',
            'harga_jual.min' => 'harga jual minimal 0 tidak boleh negatif',
            'harga_jual.not_in' => 'harga jual minimal 0 tidak boleh negatif',
            'stock.required' => 'stock harus diisi',
            'stock.numeric' => 'stock harus angka',
            'stock.min' => 'stock minimal 0 tidak boleh negatif',
            'stock.not_in' => 'stock minimal 0 tidak boleh negatif',
            // 'barcode.digits' => 'barcode maximal 12 digits',

        ]);
    }
}
