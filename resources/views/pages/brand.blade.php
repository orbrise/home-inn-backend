@extends('layout.master')

@push('css')

@endpush

@section('content')
<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Brands / Manufacturer</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item"><span>Brnands</span></li>
                                
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
                <div class="row gutter-20">
                    <div class="col-md-6">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Create New Brand</h3>
                            </div>
                            <form method="post" action="{{ url('customers/addnewbrand') }}" enctype="multipart/form-data">
                                {{ csrf_field()}}

                            <div class="panel-content">
                                @if(!empty(session('successmsg')))<div class="alert alert-success">{{session('successmsg')}}</div>  @endif
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Brand Name</span>
                                        <input type="text" name="brandname" placeholder="Enter Your Brand..." class="form-control">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Logo</span>
                                        <input type="file" name="brandlogo" class="form-control">
                                    </label>
                                </div>

                                <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success">
                                
                            </div>
                        </form>
                        </div>
                        <!-- Panel End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">All Brands / Manufacturer</h3>
                            </div>

                            <div class="panel-content">
                                
                            <div class="records--list" data-title="Product Listing">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="not-sortable">Image</th>
                                    <th>Name</th>
                                    <th>Created Date</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody >
                                @forelse($brands as $key => $prod)
                                <tr>
                                    <td>
                                        <a href="#" class="btn-link">{{$prod->id}}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-link">
                                            <img width="50" src="@if(!empty($prod->logo)){{ url('public/assets/brands')}}/{{$prod->logo}} @endif" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-link">{{ $prod->name}}</a>
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($prod->created_at)) }}
                                    </td>                     
                                    
                                    <td>
                                        <a href="{{ url('customers/delbrand/')}}/{{$prod->id}}" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash text-orange"></i></a>
                                    </td>
                                </tr>
                                @empty
                                No products found!

                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>

                            </div>
                        </div>
                        <!-- Panel End -->
                    </div>
                </div>
            </section>


@endsection

@push('js')

@endpush