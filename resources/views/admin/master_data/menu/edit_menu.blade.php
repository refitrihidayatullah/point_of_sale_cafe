@extends('layout.main')
@section('title','Data Barang | edit Barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url("/menu/". encrypt($data_barang->kd_barang))}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="nama_barang" class="form-label">Nama Barang*</label>
                      <input type="text" class="form-control p-2 @error('nama_barang') is-invalid @enderror" value="{{old('nama_barang')?:$data_barang->nama_barang}}" id="nama_barang" name="nama_barang" placeholder="masukkan nama barang..">
                      @error('nama_barang')
                      <div class="form-text text-danger">{{$message}}.</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Barcode</label>
                        <input type="number" class="form-control p-2 @error('barcode') is-invalid @enderror" maxlength="12" id="barcode" value="{{old('barcode')?:$data_barang->barcode}}" name="barcode" placeholder="masukkan barcode barang..">
                        @error('barcode')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori*</label>
                        <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                            @foreach ($kategori as $ktgr)
                            <option value="{{$data_barang->kategori_id === $ktgr->kd_kategori?$data_barang->kategori_id:$ktgr->kd_kategori}}" {{$data_barang->kategori_id === $ktgr->kd_kategori?'selected':''}}>{{$ktgr->nama_kategori}}</option>
                            @endforeach
                          </select>
                          @error('kategori')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli(Rp) *</label>
                        <input type="text" min="0" step="any" class="form-control p-2 @error('harga_beli') is-invalid @enderror"  id="harga_beli" value="{{old('harga_beli')?:$data_barang->harga_beli}}" name="harga_beli" placeholder="masukkan harga beli barang..">
                        @error('harga_beli')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual(Rp) *</label>
                        <input type="text" min="0" step="any" class="form-control p-2 @error('harga_jual') is-invalid @enderror" id="harga_jual" value="{{old('harga_jual')?:$data_barang->harga_jual}}" name="harga_jual" placeholder="masukkan harga jual barang..">
                        @error('harga_jual')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock*</label>
                        <input type="number" min="0" step="1" class="form-control p-2 @error('stock') is-invalid @enderror"  id="stock" value="{{old('stock')?:$data_barang->stock}}" name="stock" placeholder="masukkan stock barang..">
                        @error('stock')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" value="{{old('keterangan')?:$data_barang->keterangan}}" placeholder="keterangan.." rows="3">{{old('keterangan')?:$data_barang->keterangan}}</textarea>
                        @error('keterangan')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                      </div>

                
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/menu')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.master_data.menu.hargabeli')
@extends('admin.master_data.menu.hargajual')