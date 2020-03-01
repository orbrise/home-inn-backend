@extends('layout.master')

@push('css')

@endpush


@section('content')
 <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Shipment Charges</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item"><span>Shipment  Charges</span></li>
                               
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
                    <div class="col-md-12">
                        <!-- Panel Start -->
                        <div class="panel">
                        	@if(!empty(session('successmsg'))) <div class="alert alert-success">{{ session('successmsg')}}</div> @endif
                            <div class="panel-heading">
                                <h3 class="panel-title">Manage Shipment Charges</h3>
                            </div>

                            <div class="panel-content">
                            	<form method="post" action="{{ url('customers/addshipment') }}">
                            		{{ csrf_field() }}
                                <div class="form-inline">

                                    <label class="mr-3  mb-3">
                                       <select name="country" class="form-control">
                                        <option>Select Currency</option>
                                        @if(!empty($countries))
                                        @foreach($countries as $country)
                                        <option value="{{$country->country}}">{{$country->country}} ({{$country->symbol}})</option>
                                        @endforeach

                                        @endif
                                       </select>
                                    </label>

                                    <label class="mr-3  mb-3">
                                        <input type="text" name="normal_rates" placeholder="Normal Rates" value="" class="form-control" >
                                    </label>

                                    <label class="mr-3  mb-3">
                                        <input type="text" name="urgent_rates" placeholder="Urgent Rates" value="" class="form-control" >
                                    </label>

                                    

                                    <input type="submit" value="Add Shipping Rates" class="btn btn-sm btn-rounded btn-success mr-2  mb-3">
 
                                </div>
                            
                            
                                   
                                   


                        </div>
                        <!-- Panel End -->

                        <div class="panel">
                        	
                            <div class="panel-heading">
                                <h3 class="panel-title">All Shipping Rates</h3>
                            </div>

                            <div class="panel-content">
                            	@if(!empty($rates))
                            	<ul class="note--list"> 
                            		@foreach($rates as $rate)
                            		<li class="active"> <a href="#" class="view-item border-blue" data-value="blue"> 
                            			<h4 class="title">{{$rate->country}} = Normal Rates: {{$rate->normal_rates}} | Urgent Rates: {{$rate->urgent_rates}} </h4> 
                            			 </a> 
                            			<a href="{{ url('customers/delshipment')}}/{{$rate->id}}" class="remove-item fa fa-times"></a> 
                            		</li>
                            		@endforeach
                            	
                            	 
                            	
                            	@endif
                            </div>
                        </div>
                    </div>

                    
                </div>
            </section>
@endsection

@push('js')

@endpush