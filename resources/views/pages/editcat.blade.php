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
                            <h2 class="page--title h5">Update Category Information</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                      
                                <li class="breadcrumb-item active"><span>Category Info</span></li>
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
                                <h3 class="panel-title">Update Category Information</h3>
                            </div>
                            <form method="post" action="{{ url('customers/updatecat')}}" enctype="multipart/form-data">
                            	{{ csrf_field() }}
                            	<input type="hidden" name="id" value="{{$editdata->id}}">

                            <div class="panel-content">
                                <!-- Form Group Start -->
                                @if(!empty(session('successmsg'))) <div class="alert alert-success">{{session('successmsg')}}</div>@endif
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Category Name</span>

                                    <div class="col-md-10">
                                        <input type="text" name="cname" value="{{ $editdata->name}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Category Current Image</span>

                                    <div class="col-md-10">
                                        <img width="100" src="{{url('public/assets/products/catimages')}}/{{ $editdata->catimg}}">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Shop Logo</span>

                                    <div class="col-md-10">
                                        <label class="custom-file">
                                            <input type="file" name="catimg" class="custom-file-input" accept="image/x-png,image/jpg,image/jpeg">
                                            <span class="custom-file-label">Choose File</span>
                                        </label>
                                    </div>
                                </div>

                              
                                <hr>
                                <div align="center"><button type="submit" class="btn btn-rounded btn-primary"><i class="fa fa-save"></i> Submit</button> @if(!empty(session('successmsg')))<button class="btn btn-rounded btn-info" type="button" onclick="window.history.go(-2)">Back</button>@endif</div>



                            </div>
                        </form>
                        </div>
                    </div>

                        </section>



            @endsection