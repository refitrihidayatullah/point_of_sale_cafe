<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class SupplierValidator
{
    public static function validatorStore(array $data)
    {
        return Validator::make(
            $data,
            [
                'nama_supplier' => 'required',
                'alamat_supplier' => 'required',
                'no_telp_supplier' => 'required',
            ],
            [
                'nama_supplier.required' => 'nama supplier harus diisi',
                'alamat_supplier.required' => 'alamat supplier harus diisi',
                'no_telp_supplier.required' => 'no telp harus diisi',
            ]
        );
    }
}
