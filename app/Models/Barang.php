<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

	protected $table = 'barang';

   	 protected $fillable = ['merk','seri','spesifikasi','stok','kategori_id','foto'];

  	  public function kategori()
 	{
  	   return $this->belongsTo(Kategori::class, 'kategori_id');
 	}
	 public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
