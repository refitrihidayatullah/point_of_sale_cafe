<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateCodeAuto extends Controller
{
    private static $prefix;
    private static $random;
    private static $code;
    private static $barcode;

    public static function generateCode($prefix, $model, $id)
    {
        self::$prefix = $prefix;
        self::$random = mt_rand(1000, 9999);
        self::$code = self::$prefix . self::$random;
        // $code = $prefix . mt_rand(1000, 9999);
        // cek didatabase jika sama maka render ulang
        while ($model::where($id, self::$code)->exists()) {
            self::$random = mt_rand(1000, 9999);
            self::$code = self::$prefix . self::$random;
            // $code = $prefix . mt_rand(1000, 9999);
        }
        return self::$code;
    }
    public static function barcode($model, $id)
    {
        self::$barcode = mt_rand(100000000000, 999999999999);
        while ($model::where($id, self::$barcode)->exists()) {
            self::$barcode = mt_rand(100000000000, 999999999999);
        }
        return self::$barcode;
    }
}
