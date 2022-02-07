@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="row m-custom">
               <div class="col-md-12 ">
                   <a href="{{url()->previous()}}" class="text-black"><small><i class="fa fa-long-arrow-alt-left" ></i> Kembali</small></a>
                   <h4 class="mt-2">@if($model->exists) Edit @else Tambah @endif Kategori</h4>
                   <hr>
                   @if (count($errors) > 0)
                   <div class="row">
                     <div class="col-md-12">
                       <small>
                         <div class="alert alert-danger alert-dismissible fade show">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                       </small>
                     </div>
                   </div>
                   @endif
                    <form action="@if($model->exists) {{route('category.update', $model->id)}} @else {{route('category.store')}} @endif" method="POST">
                        @if($model->exists)
                            @method("PUT")
                        @else
                            @method("POST")
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="">Nama <span class="text-danger">*</span></label>
                            <input type="text"  name="name" value="{{old('name', $model->name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tipe</label>
                            <select name="type" id="" class="form-control">
                                <option @if($model->exists && $model->type == 1) selected @endif value="1">Pemasukan</option>
                                <option @if($model->exists && $model->type == 2) selected @endif value="2">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue btn-block">Simpan</button>
                        </div>
                    </form>
               </div>
           </div>
        </div>
    </div>
</div>
@endsection

