@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="row m-custom">
               <div class="col-md-12 text-center">
                   <h4>Halo, {{Auth::user()->name}}!</h4>
                   <p class="text-secondary">Catat pemasukan dan pengeluaran Anda.</p>
               </div>
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-body text-center">
                           <small>Jumlah uang anda:</small>
                           <h2>{{number_format(Auth::user()->calculateTransaction())}}</h2>
                       </div>
                       
                   </div>
                   <a href="{{route('transaction.create')}}" class="btn btn-blue btn-block mt-2">Tambah Transaksi</a>
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

               <div class="col-md-12 mt-3">
                   @if ($models->count() > 0)
                   <h6 class="mb-3">Riwayat Transaksi</h6>
                   @endif
                    
                    @forelse ($models as $date => $row)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2 text-right">
                                        <h3 style="padding-top: 5px;">{{date('d', strtotime($date))}}</h3>
                                    </div>
                                    <div class="col-6">
                                        <small class="d-block">{{date('l', strtotime($date))}}</small>
                                        <small>{{date('M Y', strtotime($date))}}</small>
                                    </div>
                                    <div class="col-4 text-right">
                                        @php
                                            $val = 0;
                                            
                                            foreach($row as $item) {
                                                if($item->type == 1) {
                                                    $val += $item->value;
                                                } else {
                                                    $val -= $item->value;
                                                }
                                            }
                                        @endphp
                                        <h6 style="padding-top: 13px;">@if ($val > 0)
                                            +
    
                                        @endif {{number_format($val)}}</h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    @foreach ($row as $item)
                                        <div class="col-6 text-secondary">
                                            <small>{{$item->category ? $item->category->name : 'Tidak ada kategori'}}</small>
                                        </div>
                                        <div class="col-6 text-right @if($item->type == 2) text-danger @else text-success @endif">
                                            <small>{{number_format($item->value)}}</small>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
               </div>

               

               {{-- @endif --}}
           </div>
        </div>
    </div>
</div>
@endsection
