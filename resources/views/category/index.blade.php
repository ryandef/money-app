@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="row m-custom">
               
                <div class="col-md-6">
                    <h4 class="mt-2">Data Kategori</h4>
                    
                   </div>
                   <div class="col-md-6 text-right">
                        <a href="{{route('category.create')}}" class="btn btn-blue">Tambah Kategori</a>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
    
               @if($income->count() == 0 && $expense->count() == 0)
               <div class="col-md-12 text-center ">
                    <div class="mt-5">
                        <i class=" far fa-3x fa-smile-beam"></i>
                        <p class="mt-2">Yuk, tambah kategori</p>
                    </div>
               </div>
               @else
               @if(\Session::has('success'))
                    
                      <div class="col-md-12">
                          <br>
                       
                          <div class="alert alert-success alert-dismissible fade show">
                            {{\Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                    
                      </div>
       
                @endif

               <div class="col-md-12">
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link text-dark active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pemasukan</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pengeluaran</a>
                        </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @foreach ($income as $item)
                            <div class="card mt-2 card-list-item border-left-">
                                <div class="card-body  ">
                                    <h6>{{$item->name}}</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            {!!$item->getType()!!}
                                        </div>
                                        <div class="col-6 text-right">
                                            @if($item->user_id != null)
                                            <form action="{{route('category.destroy', $item->id)}}" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                                @method("DELETE")
                                                @csrf
                                                <a href="{{route('category.edit', $item->id)}}" class="text-black"><i class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn btn-sm ml-1"><i class="fa fa-trash"></i></button>
                                                
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach ($expense as $item)
                            <div class="card mt-2 card-list-item border-left-">
                                <div class="card-body  ">
                                    <h6>{{$item->name}}</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            {!!$item->getType()!!}
                                        </div>
                                        <div class="col-6 text-right">
                                            @if($item->user_id != null)
                                            <form action="{{route('category.destroy', $item->id)}}" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                                @method("DELETE")
                                                @csrf
                                                <a href="{{route('category.edit', $item->id)}}" class="text-black"><i class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn btn-sm ml-1"><i class="fa fa-trash"></i></button>
                                                
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                  </div>
                    
                 
               </div>
               @endif
           </div>
        </div>
    </div>
</div>
@endsection
