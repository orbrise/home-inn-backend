@extends('layout.master')

@section('content')

@push('css')

<link rel="stylesheet" href="{{asset('public/assets/css/sweetalert.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/sweetalert-overrides.css')}}">

@endpush
<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Contacts</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Contacts</span></li>
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
                <div class="panel">
                    <!-- App Start -->
                    <div class="app_wrapper row">
                        <!-- App Sidebar Start -->
                        <div class="app_sidebar col-lg-6">
                            <!-- Toolbar Start -->
                            <div class="toolbar">
                            	<input type="text" style="margin-right: 5px;" class="form-control" id="attrname" placeholder="write attribute name"><br>
                                <button type="button" id="creatnewattr" class="btn btn-block btn-rounded btn-warning fw--600">Create New Attribute</button>
                            </div>
                            <!-- Toolbar End -->

                            <!-- Contacts Navigation Start -->
                                <div id="getallattrs">
                                                        
                                @if(!empty($allttrs))
                        <ul class="navigation">
                            @forelse($allttrs as $attr)
                            <div class="row" id="{{ $attr->id}}" style="margin-bottom: 5px;">
                            
                        <div class="col col-sm-4">
                            <label class="form-radio "> 
                                <input type="radio" id="attrnameforopt" name="attr" data="{{ $attr->name}}" value="{{ $attr->id}}" class="form-radio-input" > 
                                <span class="form-radio-label">{{ $attr->name }}
                                </span> 

                            </label> 
                        </div>

                        <div class="col col-sm-2 pull-right">

                           <a href="#" id="deleteattr" class="label label-danger text-white" data="{{$attr->id}}"> <i class="fa fa-trash"></i> Trash</a>
                        </div>
</div>

                            @empty
                            No Record Found

                            @endforelse                    
                        </ul>
                        @endif

                            </div>
                            <!-- Contacts Navigation End -->
                        </div>
                        <!-- App Sidebar End -->

                        <!-- App Sidebar Start -->
                        
                        <!-- App Sidebar End -->
                        
                        <!-- App Content Start -->
                        <div class="app_content col-lg-6">
                            <!-- Toolbar Start -->

                            <div align="right">
                                <button type="button" id="addattroption" class="btn btn-warning pull-right">Add New</button>
                            </div>
                            <!-- Toolbar End -->

                            <!-- Contact View Start -->
                            <div class="contact--view">
                                <div class="contact--view__avatar">
                                    <img src="assets/img/avatars/03_150x150.png" alt="">
                                </div><br>


                                <div id="getattrvals">
                                    

                                </div>
                                <br>

                                <div id="appenddiv"></div>
                            </div>
                            <!-- Contact View End -->
                        </div>
                        <!-- App Content End -->
                    </div>
                    <!-- App Sidebar End -->
                </div>
            </section>
@endsection

@push('js')
<script src="{{ asset('public/assets/js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/sweetalert-init.js')}}"></script>

@include('ajax.product.product');
@endpush