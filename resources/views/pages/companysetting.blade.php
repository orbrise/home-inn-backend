@extends('layout.master')

@push('css')

@endpush

@section('content')

            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Cormpany Settings</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                      
                                <li class="breadcrumb-item active"><span>Company Settings</span></li>
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
<div class="col-md-12">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Company Information</h3>
                            </div>
                            <form method="post" action="{{ url('customers/savecompanydata')}}" enctype="multipart/form-data">
                            	{{ csrf_field() }}
                            	<input type="hidden" name="id" value="{{Auth::user()->id}}">

                            <div class="panel-content">
                                <!-- Form Group Start -->
                                @if(!empty(session('successmsg'))) <div class="alert alert-success">{{session('successmsg')}}</div>@endif
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop Name</span>

                                    <div class="col-md-10">
                                        <input type="text" name="sname" value="{{ Auth::user()->shop_name}}" class="form-control">
										@if($errors->first('sname'))<span class="text-danger">{{$errors->first('sname')}}</span>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop Owner Name</span>

                                    <div class="col-md-10">
                                        <input type="text" name="soname" value="{{ Auth::user()->shop_owner}}" class="form-control">
										@if($errors->first('soname'))<span class="text-danger">{{$errors->first('soname')}}</span>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop Address</span>

                                    <div class="col-md-10">
                                        <textarea name="address" class="form-control" placeholder="write your shop address">{{ Auth::user()->address}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop City</span>

                                    <div class="col-md-10">
                                        <input type="text" name="city" value="{{ Auth::user()->shop_city}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Selected Countries</span>

                                    <div class="col-md-10">
                                        <input type="text" name="count" 
                                        value="{{ Auth::user()->shop_country}}" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Select Country</span>

                                    <div class="col-md-10">
                                        <select name="country[]" class="form-control" multiple>
                                            @if(!empty($allcur))
                                            @foreach($allcur as $currency)
                                            <option value="{{$currency->symbol}}">
                                                {{ $currency->country }} ({{$currency->symbol}})</option>
                                            @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Default Currency</span>

                                    <div class="col-md-10">
                                        <select name="currency" class="form-control">
                                        	@if(!empty($allcur))
                                        	@foreach($allcur as $currency)
                                            <option value="{{$currency->symbol}}" 
                                            	@if(Auth::user()->currency == $currency->symbol) selected @endif>{{ $currency->name }}</option>
                                            @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop Logo</span>

                                    <div class="col-md-10">
                                        <label class="custom-file">
                                            <input type="file" name="shoplogo" class="custom-file-input" accept="image/x-png,image/jpg,image/jpeg">
                                            <span class="custom-file-label">Choose File</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Registered Email</span>

                                    <div class="col-md-10">
                                        <!-- Input Group Start -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>

                                            <input type="text" name="text" value="{{ Auth::user()->shop_user}}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Password</span>

                                    <div class="col-md-10">
                                        <input type="password" name="pass" value="" class="form-control">
										@if($errors->first('pass'))<span class="text-danger">{{$errors->first('pass')}}</span>@endif
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Repeat Password</span>

                                    <div class="col-md-10">
                                        <input type="password" name="rpass" value="" class="form-control">
										@if($errors->first('rpass'))<span class="text-danger">{{$errors->first('rpass')}}</span>@endif
                                    </div>
                                </div>
								
								
                                <hr>
                                <div align="center"><button type="submit" class="btn btn-rounded btn-primary"><i class="fa fa-save"></i> Submit</button></div>



                            </div>
                        </form>
                        </div>
                    </div>

                        </section>



            @endsection