@extends('layout.master')

@push('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush

@section('content')
<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Blogs</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ecommerce.html">Ecommerce</a></li>
                                <li class="breadcrumb-item active"><span>Blogs</span></li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <!-- Summary Widget Start -->
                            <div class="summary--widget">
                                <div class="summary--item">
                                    <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>

                                    <p class="summary--title">This Month</p>
                                    <p class="summary--stats text-green">2,371,527</p>
                                </div>

                                <div class="summary--item">
                                    <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>

                                    <p class="summary--title">Last Month</p>
                                    <p class="summary--stats text-orange">2,527,371</p>
                                </div>
                            </div>
                            <!-- Summary Widget End -->
                        </div>
                    </div>
                </div>
            </section>

 <section class="main--content">

    <a href="{{ url('/customers/newblog')}}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> Add New</a>
    <div class="clearfix"></div>
    <br>
                <div class="row gutter-20">
                    <div class="col-md-12">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">All Posts</h3>
                            </div>

                            <div class="panel-content">
                            
                            	
                               <div class="records--list" data-title="Orders Listing" style="padding: 15px;">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($blogs))
                                @foreach($blogs as $key => $blog)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <a href="#" class="btn-link"><img src="{{ url($blog->blogimg)}}" width="100" class="img"></a>
                                    </td>
                                    <td>{{ $blog->title}}</td>
                                    <td>
                                        <a href="#" class="btn-link">{{ date('d M Y', strtotime($blog->created_at))}}</a>
                                    </td>
                                    <td>@if($blog->delstatus == 0) <i class="fa fa-check text-center text-green"></i> @else <i class="fa fa-times text-center text-orange"></i> @endif</td>
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="{{ url('customers/editpost')}}/{{$blog->id}}" class="dropdown-item">Edit</a>
                                                <a href="{{ url('customers/activepost')}}/{{$blog->id}}" class="dropdown-item">Active</a>
                                                <a href="{{ url('customers/inactive')}}/{{$blog->id}}" class="dropdown-item">Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               @endforeach
                               @endif
                            </tbody>
                        </table>
                    </div>


                            </div>
                        </div>
                        <!-- Panel End -->
                    </div>

                   
                    </div>
                </div>
            </section>



@endsection

@push('js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>
    @include('ajax.product.product');
@endpush