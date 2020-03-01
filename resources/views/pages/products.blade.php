@extends('layout.master')

@push('css')

@endpush

@section('content')

<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Products</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ecommerce.html">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>All Products</span></li>
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
                            <h3 class="h3">All Products <a href="{{ url('customers/products/featured')}}" class="btn btn-sm btn-outline-info">Manage Featured Products</a></h3>
                            <p>Found Total {{ count($prods)}} Products</p>
                        </div>

                        <div class="actions">
                            <form action="#" class="search flex-wrap flex-md-nowrap">
                                <input type="text" id="keywords" class="form-control" placeholder="Product Name..." required>
                                <button type="button" id="searchprod" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                            </form>

                            <a href="{{ url('customers/add-new-product')}}" class="addProduct btn btn-lg btn-rounded btn-warning">Add Product</a>
                        </div>
                    </div>
                    <!-- Records Header End -->
                </div>

                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Product Listing">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="not-sortable">Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Created Date</th>
                                    <th>Status / Featured</th>
                                    
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="filterdata">
                            	@forelse($prods as $key => $prod)
                                <tr>
                                    <td>
                                        <a href="#" class="btn-link">{{$prod->id}}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-link">
                                            <img width="50" src="@if(!empty($prod->ProdSingleImg->location)){{ url($prod->ProdSingleImg->location)}}/{{$prod->ProdSingleImg->file_name}} @endif" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-link">{{ $prod->title}}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-link">@if(!empty($prod->cat_id)) {{$prod->PCatName->name}} @endif 
                                            @if(!empty($prod->subcat_id)) > {{$prod->SCatName->name}} @endif 
                                            @if(!empty($prod->subchild_cat)) > {{$prod->SCCatName->name}} @endif</a>
                                    </td>
                                    <td>
                                        @if(!empty($prod->prices))
                                        @forelse($prod->prices as $price)
                                        {{ $price->currency}} = <b>{{ $price->price}}</b><br>
                                        @empty
                                        @endforelse
                                        @endif

                                    </td>

                                    <td class="text-center">{{ $prod->qty }}</td>
                                    <td>{{ $prod->created_at}}</td>
                                    <td>@if($prod->delstatus == 0) <i class="fas fa-check-square fa-2x text-green"></i> @else <i class="fas fa-times-circle fa-2x text-red"></i> @endif / <input type="checkbox" id="isfeatured" data="{{$prod->id}}" @if($prod->is_featured == 'yes') checked @endif></td>
                                    
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="{{ url('customers/edit-product/') }}/{{$prod->id}}" class="dropdown-item">Edit</a>
                                                <a onclick="return confirm('are you sure to inactive?');" href="{{ url('customers/delprod')}}/{{$prod->id}}" class="dropdown-item">Inactive</a>

                                                <a onclick="return confirm('are you sure to activate?');" href="{{ url('customers/activeprod')}}/{{$prod->id}}" class="dropdown-item">Activate</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                No products found!

                                @endforelse
                                
                            </tbody>
                        </table>
                        
                
                    </div>
                    
                    <!-- Records List End -->
                </div>
                <div class="float-right">{{ $prods->links("pagination::bootstrap-4") }}<br></div><br>
            </section>
@endsection

@push('js')
@include('ajax.product.product');
@endpush