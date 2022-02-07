@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/vendor/select2/style.css">
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #d1d3e2;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        padding: 4px 12px;
        color: #6e707e;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="row m-custom">
               <div class="col-md-12 ">
                   <a href="{{url()->previous()}}" class="text-black"><small><i class="fa fa-long-arrow-alt-left" ></i> Kembali</small></a>
                   <h4 class="mt-2">@if($model->exists) Edit @else Tambah @endif Transaksi</h4>
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
                    <form action="@if($model->exists) {{route('transaction.update', $model->id)}} @else {{route('transaction.store')}} @endif" method="POST">
                        @if($model->exists)
                            @method("PUT")
                        @else
                            @method("POST")
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="">Nominal <span class="text-danger">*</span></label>
                            <input type="number" min="1"  name="value" value="{{old('value', $model->value)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kategori <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single form-control" name="category_id" required>
                                @foreach ($category as $item)
                                    <option @if($model->exists && $model->category_id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
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

@section('script')
    <script src="/vendor/select2/app.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
