@extends('layouts.backend.main')
@section('title', 'Dashboard')
@section('css')
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>    
            <div class="col-xs-12 col-md-3 p-0">NFT Products</div>
            <div class="pull-right">
                <a class="btn btn-success btn-sm" href="{{ route('nft-product.create')}}"><i class="fa fa-add-user"></i> Create New NFT Product</a>
            </div>
        </h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content bg-dark-blue">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th colspan="2">Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($products) > 0)
                                @foreach($products as  $key=>$row)
                                <tr>
                                    @php
                                        $index = $key+1;
                                    @endphp
                                    <td>{{$row->id}}</td>
                                    <td colspan="2" width="30%">
                                        {{$row->name}}  
                                    </td>
                                    <td>
                                        {{$row->description}}  
                                    </td>
                                    <td>
                                        @if($row->status=='active')
                                            <label class="label label-primary">Active</label>   
                                        @else
                                            <label class="label label-danger">In-active</label>   

                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['nft-product.update',$row->id],'onsubmit'=>"return confirmDelete(this,'Are you sure to want delete this product ?')"]) !!}
                                        <a class="btn btn-primary btn-xs" href="{{route('nft-product.edit',[$row->id])}}"><i class="fa fa-edit"></i></a>
                                        @method('delete')
                                        <button class="btn btn-danger  btn-xs" type="submit" ><i class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>                                        
                                @endforeach                            
                                @else
                                <tr>
                                    <td>Oops! No Record Found</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="8" align="right">{!! $products->render() !!}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection