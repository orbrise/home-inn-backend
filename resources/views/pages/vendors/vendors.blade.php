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
                            <h2 class="page--title h5">Vendors</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ecommerce.html">Ecommerce</a></li>
                                <li class="breadcrumb-item active"><span>Vendors</span></li>
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
                <div align="right">
                    <a href="{{ url('customers/newvendor')}}" class="btn btn-warning">New Vendor</a>
                </div>
                <br>
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Orders Listing" style="padding: 15px;">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Shop Name</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email</th>
                                    <th>Status</th>
                                   
                                    <th>No of Products</th>
                                    <th>No of Orders</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@if(!empty($vendors))
                            	@foreach($vendors as $key => $vendor)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <a href="#" class="btn-link">{{$vendor->shop_name}}</a>
                                    </td>
                                    <td>{{$vendor->vendor_name}}</td>
                                    <td>
                                        <a href="#" class="btn-link">{{$vendor->username}}</a>
                                    </td>
                                    <td>@if($vendor->delstatus == 0) Avtive @else Inactive @endif</td>
                                    <td>{{count($vendor->CountProds)}}</td>
                                    <td>{{count($vendor->CountOrders)}}</td>
                                    
                                    
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="{{ url('customers/orderview')}}/{{$vendor->id}}" class="dropdown-item">Details</a>
                                                <a href="{{ url('customers/orderview')}}/{{$vendor->id}}" class="dropdown-item">Edit</a>
                                                <a href="{{ url('customers/orderview')}}/{{$vendor->id}}" class="dropdown-item">Active</a>
                                                <a href="{{ url('customers/orderview')}}/{{$vendor->id}}" class="dropdown-item">Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               @endforeach
                               @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>

@endsection

@push('js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>
@endpush