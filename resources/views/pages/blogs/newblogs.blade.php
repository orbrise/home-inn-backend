@extends('layout.master')

@push('css')

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
                <div class="row gutter-20">
                    <div class="col-md-8">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">New Post</h3>
                            </div>

                            <div class="panel-content">
                            @if(!empty(session('successmsg')))	<div class="alert alert-success">{{ session('successmsg')}}</div> @endif
                            	<form method="post" action="{{ url('/customers/addnewpost')}}" enctype="multipart/form-data">
                            		{{csrf_field()}}
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Title</span>
                                        <input type="text" name="title" placeholder="Enter Your title..." class="form-control">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Short Description</span>
                                        <textarea class="form-control" name="short_desc"></textarea>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Long Description</span>
                                        <textarea id="mymce" class="form-control" name="long_desc"></textarea>
                                    </label>
                                </div>

                                

                                <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success">
                                <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                        <!-- Panel End -->
                    </div>

                    <div class="col-md-4">
                    	<div class="panel" style="padding: 15px">
                    		

                                    			<h5 class="label-text">Select Category</h5>

                                        <br>
                                    			<div class="form-group">
                                    @if(!empty($allparents))
                                        <select  name="cat" class="form-control" required >
                                            <option value="">Select</option>
                                            @foreach($allparents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        @endif
                                    </div>

                                    
<br>
<h5 class="label-text">Select images</h5>
<input type="file" name="fimg" class="form-control">
<br>
<h5 class="label-text">Write Tag</h5>
<input type="text" name="tag" class="form-control">
	</div>

</div>
                    </div>
                
            </section>



@endsection

@push('js')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=eslvaow8fan5qg0cxdwb3i8445n3j1eonhd8e0bckqjp22hm"></script>

<script>
    $(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>
    @include('ajax.product.product');
@endpush