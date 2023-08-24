<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'suppliers';
    protected $primaryKey = 'kd_supplier';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;


    // Mutator universal untuk mengubah inputan menjadi huruf kapital sebelum disimpan
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
}
