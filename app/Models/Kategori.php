<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'kategoris';
    protected $primaryKey = 'kd_kategori';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;


    // Mutator universal untuk mengubah inputan menjadi huruf kapital sebelum disimpan
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
    // kategori pk => barang fk
    // relasi satu ke satu //belongto biasanya yg memiliki primary //hasone/hasmany biasanya foreign
    // di model bikin func sebaliknya jika di model kategori bikin func menu 
    // maksudnya belongto kategori(satu) berelasi ke brang hasone satu
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
