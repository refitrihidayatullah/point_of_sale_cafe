@extends('layout.main')
@section('title','Data Supplier | edit Supplier')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url("/supplier/".encrypt($data_supplier->kd_supplier))}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="nama_supplier" class="form-label">Nama Supplier</label>
                      <input type="text" class="form-control p-2 @error('nama_supplier') is-invalid @enderror" id="nama_supplier" value="{{old('nama_supplier')?:$data_supplier->nama_supplier}}" name="nama_supplier" placeholder="masukkan nama supplier..">
                      @error('nama_supplier')
                      <div class="form-text text-danger">{{$message}}.</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                        <input type="text" class="form-control p-2 @error('alamat_supplier') is-invalid @enderror" id="alamat_supplier" value="{{old('alamat_supplier')?:$data_supplier->alamat_supplier}}" name="alamat_supplier" placeholder="masukkan alamat supplier..">
                        @error('alamat_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_supplier" class="form-label">Nomer Telp Supplier</label>
                        <input type="number" class="form-control p-2 @error('no_telp_supplier') is-invalid @enderror" id="no_telp_supplier" value="{{old('no_telp_supplier')?:$data_supplier->no_telp_supplier}}" name="no_telp_supplier" placeholder="masukkan no telp supplier..">
                        @error('no_telp_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/supplier')}}" class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection