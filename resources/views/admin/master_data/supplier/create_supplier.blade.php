@extends('layout.main')
@section('title','Data Supplier | create Supplier')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/supplier')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="kd_supplier" class="form-label">Kode Supplier</label>
                      <input type="text" class="form-control p-2" value="{{$kd_supplier}}"  id="kd_supplier" name="kd_supplier" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="nama_supplier" class="form-label">Nama Supplier</label>
                      <input type="text" class="form-control p-2 @error('nama_supplier') is-invalid @enderror" value="{{old('nama_supplier')}}" id="nama_supplier" name="nama_supplier" placeholder="masukkan nama supplier..">
                      @error('nama_supplier')
                      <div class="form-text text-danger">{{$message}}.</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                        <input type="text" class="form-control p-2 @error('alamat_supplier') is-invalid @enderror" id="alamat_supplier" value="{{old('alamat_supplier')}}" name="alamat_supplier" placeholder="masukkan alamat supplier..">
                        @error('alamat_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_supplier" class="form-label">Nomer Telp Supplier</label>
                        <input type="number" class="form-control p-2 @error('no_telp_supplier') is-invalid @enderror" id="no_telp_supplier" value="{{old('no_telp_supplier')}}" name="no_telp_supplier" placeholder="masukkan no telp supplier..">
                        @error('no_telp_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/supplier')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection