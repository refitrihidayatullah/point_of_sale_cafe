<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\GenerateCodeAuto;
use Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'menus';
    protected $primaryKey = 'kd_barang';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;


    // insert data
    // public function insertBarang(array $options = [])
    // {
    //     return parent::save($options);
    // }
    public static function insertBarang(Request $request)
    {
        if ($request->barcode == null)
            $barcode = GenerateCodeAuto::barcode(Menu::class, 'barcode');
        else {
            $barcode = $request->barcode;
        }
        $harga_beli = str_replace('.', '', $request->harga_beli);
        $harga_jual = str_replace('.', '', $request->harga_jual);
        $newBarang = [
            'kd_barang' => GenerateCodeAuto::generateCode('MN-', Menu::class, 'kd_barang'),
            'barcode' => $barcode,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stock' => $request->stock,
            'keterangan' => $request->keterangan,
        ];
        return static::create($newBarang);
    }
    public static function updateBarang(array $newupdate, $id)
    {
        return static::update($newupdate);
    }
    // get read
    // public static function getBarang()
    // {
    //     return static::all();
    // }


    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
    public function kategori()
    {
        // jika tdk memakai id perlu definisikan foreignkey
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
