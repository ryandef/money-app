@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="row m-custom">
               <div class="col-md-6">
                <h4 class="mt-2">Riwayat Transaksi</h4>
                
               </div>
               <div class="col-md-6 text-right">
                    <a href="{{route('transaction.create')}}" class="btn btn-blue">Tambah Transaksi</a>
                </div>

               <div class="col-12">
                <hr>
                <div class="card">
                    <div class="card-body text-center">
                        <small>Jumlah uang anda:</small>
                        <h2>{{number_format(Auth::user()->calculateTransaction())}}</h2>
                        @if (Auth::user()->calculateTransaction() != 0)
                        <hr>
                        <div class="row">
                            <div class="col-6 text-left">
                                <small>Inflow</small>
                            </div>
                            <div class="col-6 text-right">
                                <small class="text-success">{{number_format(Auth::user()->calculateTransactionInflow())}}</small>
                            </div>
                            <div class="col-6 text-left">
                                <small>Outflow</small>
                            </div>
                            <div class="col-6 text-right">
                                <small class="text-danger">{{number_format(Auth::user()->calculateTransactionOutflow())}}</small>
                            </div>
                        </div>
                        @endif
                        
                    
                    </div>
                    
                </div>
               </div>
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

               {{-- <div class="col-md-12">
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
                    
                 
               </div> --}}
               <div class="col-md-12">
                @foreach ($models as $date => $row)
                <h6 class="pt-3 pb-1">{{date('d M Y', strtotime($date))}}</h6>
                @foreach ($row as $item)
                <div class="card mt-2 card-list-item border-left-">
                    <div class="card-body  ">
                        
                        <div class="row">
                            <div class="col-6">
                                <small class="text-secondary">{{date('H:i', strtotime($item->created_at))}}</small>
                                <h6>{{$item->category ? $item->category->name : '-'}}</h6>
                                <small class="@if($item->type == 2) text-danger @else text-success @endif">{{number_format($item->value)}}</small>
                            </div>
                            <div class="col-6 text-right pt-3">
                                
                                <form action="{{route('transaction.destroy', $item->id)}}" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                    @method("DELETE")
                                    @csrf
                                    <a href="{{route('transaction.edit', $item->id)}}" class="text-black"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm ml-1"><i class="fa fa-trash"></i></button>
                                    
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @endforeach
               </div>
               
           </div>
        </div>
    </div>
</div>
@endsection
