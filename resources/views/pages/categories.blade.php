@extends('layout.master')

@push('css')

@endpush

@section('content')

<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Categories</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ecommerce.html">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Manage Caegories</span></li>
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
                    <!-- Records Header Start -->
                    <div class="records--header">
                        <div class="title fa-shopping-bag">
                            <h3 class="h3">Create New Categories </h3>
                            <p>Found Total 1,330 Categories</p>
                            <form method="post" action="{{ url('customers/addcategory')}}" enctype="multipart/form-data">
                            	{{csrf_field()}}

                            	<input type="hidden" name="level" value="{{ $level }}">
                            	<input type="hidden" name="catid" value="{{ $catid }}">
                            	<input type="hidden" name="shopid" value="{{ $shopid }}">
                                <input type="hidden" name="id" value="{{ $id }}">


                            <div class="form-inline">
                                    <label class="mr-3  mb-3">
                                        <span class="label-text sr-only">Category Name</span>
                                        <input type="text" name="catname" placeholder="Enter Category Name" class="form-control">
                                    </label>

                                    

                                    <label class="mr-3  mb-3 ">
                                        <span class="label-text sr-only">Category Logo</span>
                                        <input type="file" name="catimg"  class="form-control">
                                    </label>

                                    

                                    <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success mr-2  mb-3">
                                    <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary mb-3">Cancel</button>
                                </div>
                        </div>

                    </div>
                    <!-- Records Header End -->
                </div>

                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="@if($level == 0) All Categories @else {{ $catname->name }} @endif">

                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Image</th>
                                    <th>Name</th>
									<th>URL</th>
										<th>Group Attribute</th>
                                    <th>Display</th>
                                    
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@forelse($cats as $key =>$cat)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <a href="{{ url('customers/categories/')}}/{{$level+1}}/{{$cat->cat_id}}/{{$cat->shop_id}}/{{ $cat->id}}" class="btn-link"><img width="100" src="{{ url('public/assets/products/catimages')}}/{{ $cat->catimg}}"></a>
                                    </td>
                                    <td><a href="{{ url('customers/categories/')}}/{{$level+1}}/{{$cat->cat_id}}/{{$cat->shop_id}}/{{ $cat->id}}">{{ $cat->name}}</a></td>
                                    <td><input type="text" class="form-control" name="url{{$cat->id}}" value="{{$cat->slug}}"><button type="button" id="updateurl" data="{{$cat->id}}" class="btn btn-primary btn-sm">Update</button>
									<span id="msg{{$cat->id}}"></span></td>
									<td>
								         <select id="group_attrs{{$cat->id}}">
										 <option></option>
										 @forelse($groupattrs as $gattr)
										 <option value="{{$gattr->id}}">{{$gattr->name}}</option>
										 @empty
										 @endforelse
										 
										 </select>
										 <button type="button" id="updategroup" data="{{$cat->id}}">Update</button>
										 <div id="successmsg{{$cat->id}}" class="text-success"></div>
									</td>
									
									<td>
                                        <span class="label label-success">display</span>
                                    </td>
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="{{ url('customers/editcat/')}}/{{$cat->id}}" class="dropdown-item">Edit</a>
                                                <a href="{{ url('customers/deletecat/')}}/{{$cat->id}}" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>

@endsection


@push('js')
<script>
$("button#updategroup").unbind('click').click(function(){
	var id = $(this).attr('data');
	var data = $("select#group_attrs"+id).val();
	var csrf = $('meta[name="_token"]').attr('content');
	$.post("{{ url('customers/updatecatgroup')}}",{_token:csrf, id:id, data:data}, function(data){
		$("div#successmsg"+id).html(data);
	});
	
});

$("button#updateurl").unbind('click').click(function(){

var id = $(this).attr('data');
var value = $("input[name='url"+id+"']").val();
var csrf = $('meta[name="_token"]').attr('content');
$.post('{{ url('/customers/updatecurl')}}', {_token:csrf,id:id,value:value}, function(data){
$("span#msg"+id).html(data);
});


});

</script>

@endpush

