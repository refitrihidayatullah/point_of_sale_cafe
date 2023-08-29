<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class KategoriValidator
{
    public static function validatorRules(array $data)
    {
        return Validator::make(
            $data,
            [
                'nama_kategori' => 'required',
            ],
            [
                'nama_kategori.required' => 'nama kategori harus diisi',
            ]
        );
    }
}
