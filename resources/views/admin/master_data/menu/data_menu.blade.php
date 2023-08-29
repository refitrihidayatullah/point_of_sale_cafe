@extends('layout.main')
@section('title','Data Menu')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Menu Makanan</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <!-- first alert -->
          @if(Session::has('failed'))
          <div style="width: 50%" class="alert alert-danger alert-dismissible text-white mx-3" role="alert" id="myAlert">
            <span class="text-sm">Failed {{Session::get('failed')}}.</span>
          </div>
          @elseif(Session::has('success'))
          <div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
            <span class="text-sm">Success {{Session::get('success')}}.</span>
          </div>
          @else
          @endif
          <!-- end alert -->
          <a href="{{url('/menu/create')}}" class="btn btn-success mx-3">Add Menu</a>
          <div style="height:40px; black" class="d-flex">
    
            <form action="{{url('menu')}}" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" value="{{Request::get('key')}}" name="key" class="form-control">
              </div>
              <button style="align-self:center;margin-top:15px;" class="btn btn-sm w-50 btn-outline-secondary mx-3" type="submit">Search</button>
            </form>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barcode</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Beli</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Jual</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Margin</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($get_barang as $barang)
                <tr>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$barang->nama_barang}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang->barcode}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0 ">{{$barang->kategori->nama_kategori}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{number_format($barang->harga_beli,0,'.')}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{number_format($barang->harga_jual,0,'.')}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang->harga_jual-$barang->harga_beli != null ?number_format($barang->harga_jual-$barang->harga_beli,0,'.'):'0'}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="badge badge-sm bg-gradient-success">{{$barang->stock??'0'}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang->keterangan?$barang->keterangan:'--'}}</p>
                  </td>
                  <td class="align-middle">
                    <a href="{{url("/menu/". encrypt($barang->kd_barang)."/edit")}}" class="text-secondary font-weight-bold text-xs">
                      Edit
                    </a>
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteMenuModal{{$barang->kd_barang}}">
                      Delete
                    </a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
           
              {{ $get_barang->links()}}

        
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('admin.master_data.menu.delete_modal_menu')