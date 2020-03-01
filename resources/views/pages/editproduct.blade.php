@extends('layout.master')

@push('css')
 <link rel="stylesheet" href="{{ asset('public/assets/css/sweetalert.min.css')}}">
<link rel="stylesheet" href="{{ asset('public/assets/css/sweetalert-overrides.css')}}">
@endpush

@section('content')


<section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Add New Product</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item"><span>New Product</span></li>
                                
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
                    <div class="col-lg-12">
                       
                                <!-- Tabs Nav Start -->
                                <ul class="nav nav-tabs nav-tabs-line-top" style="background-color: white">
                                    <li class="nav-item">
                                        <a href="#tab10" data-toggle="tab" class="nav-link active">Basic Information</a>
                                    </li>
                                    <li class="nav-item" id="combprod1">
                                        <a href="#tab11" data-toggle="tab" class="nav-link">Combination</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link">Attributes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab13" data-toggle="tab" class="nav-link">Images</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab14" data-toggle="tab" class="nav-link">SEO</a>
                                    </li>
                                </ul>
                                <!-- Tabs Nav End -->

                                <!-- Tab Content Start -->
                                <form method="post" action="{{ url('customers/editproduct') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="prod_id" value="{{$editdata->id}}">
                                <div class="tab-content" style="background-color: white">
                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade show active" id="tab10">
                                    	<div class="row">
                                        <div class="col-sm-8 col-xs-12 col-md-8">
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Product Name</span>

                                    <div class="col-md-10">
                                        <input type="text" name="prodname" id="product-title" value="{{ $editdata->title }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Friendly URL</span>

                                    <div class="col-md-10">
                                        <input type="text" name="url" value="{{ $editdata->url }}" id="url" class="form-control">
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Product Code</span>

                                    <div class="col-md-10">
                                        <input type="text" name="prodcode" id="product-code" value="{{ $editdata->product_code }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Short Description</span>

                                    <div class="col-md-10">
                                       <textarea id="short-desc" class="form-control" name="shortdesc">{{ $editdata->short_desc }}</textarea>
                                       <span class="text-info">Maximum 271 Chracters allow with space. </span><span class="text-orange" id="remainingwords"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Long Description</span>

                                    <div class="col-md-10">
                                       <textarea id="mymce" class="form-control" name="longdesc">{{ $editdata->long_desc}}</textarea>
                                       
                                    </div>
                                </div>




                            </div>
                                <div class="col col-sm-4 col-xs-12 col-md-4" style="border:1px solid #EBEBEA; padding: 15px;">

                                	<h4 class="label-text"><b>Combinations</b></h4><br>

                                	<div class="col-md-10">
                                        <label class="form-radio">
                                            <input type="radio" id="stdprod" name="prodtype" value="Standard" class="form-radio-input" checked>
                                            <span class="form-radio-label">Standard Product</span>
                                        </label>

                                        <label class="form-radio">
                                            <input type="radio" id="combprod" name="prodtype" value="Combination" class="form-radio-input">
                                            <span class="form-radio-label">Product With Combination</span>
                                        </label>
                                    </div><br>

                                	<div class="form-group">
    <label class="label-text">Barcode:</label>
    <input type="text" name="barcode" value="{{ $editdata->barcode }}" class="form-control">
  </div>

  <div class="form-group">
    <label class="label-text">SKU</label>
    <input type="text" name="sku" value="{{ $editdata->sku }}" class="form-control">
  </div>

  <div class="form-group row">
  	<div class="col col-sm-6">
    <label class="label-text">Quantity</label>
    <input type="text" name="qty" value="{{ $editdata->qty }}" class="form-control">
</div>
<div class="col col-sm-6">
    <label class="label-text">Shipping Days</label>
    <input type="text" name="shippingdays" value="{{ $editdata->delivery_days }}" class="form-control">
</div>
  </div>


    <div class="form-group row">
        <div class="col col-sm-6">
            <label class="label-text">Regular Price</label>
            <input name="rprice" value="{{ old('rprice', $editdata->r_price) }}" class="form-control">
        </div>
        <div class="col col-sm-6">
            <label class="label-text">Sale Price</label>
            <input name="dprice" value="{{ old('dprice', $editdata->d_price) }}" class="form-control">
        </div>

    </div>
    <?php 
    $countries = explode(',',Auth::user()->shop_country);
  ?>
  @if(count($countries) > 1)
@forelse($countries as $c => $country)
    <div class="form-group row">
        <div class="col col-sm-6">
            <label class="label-text">Price in {{$country}}</label>
            <input pattern="^\d*(\.\d{0,2})?$" id="prodprice" name="{{str_replace(' ', '', $country)}}" min="0" value="{{ old('prodprice', (isset($editdata->prices[$c]) && $editdata->prices[$c]->price > 0 ? $editdata->prices[$c]->price : null)) }}" class="form-control" required>
        </div>
        <div class="col col-sm-6">
            <label class="label-text">Sale in {{$country}}</label>
            <input pattern="^\d*(\.\d{0,2})?$" id="prodprice" name="{{str_replace(' ', '', $country)}}_sale" min="0" value="{{ old('dprice', (isset($editdata->prices[$c]) && $editdata->prices[$c]->dprice > 0 ? $editdata->prices[$c]->dprice : null)) }}" class="form-control">
        </div>
    </div>
@empty
@endforelse
@endif

<div class="form-group">
    <label class="label-text">Tag</label>
    <input type="text" name="tag" value="{{ $editdata->tag }}" class="form-control">
  </div>
                                </div>
                               


</div>
                                    </div>

                                    <!-- Tab Pane End -->

                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade combprod1" id="tab11" >
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ex quas, nostrum. Officia suscipit possimus inventore adipisci corporis?</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptatum voluptas quas debitis ex sit incidunt repudiandae pariatur?</p>
                                    </div>
                                    <!-- Tab Pane End -->

                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade" id="tab12">

                                    	<div class="row">

                                    		<div class="col-sm-12">
                                                <p class="text-orange">Please Select Only One Attribute for Now!!</p>
                                    		<div id="appendattribute"></div>
                                            
                                                @if(!empty($editdata->is_attr))
                                                <div class="row"> 

                                                @forelse($editdata->attrs as $index => $attr)

                                                <div class="form-group row" id="{{ $index}}">
                                                <div class="col-sm-3">
                                                <select id="getattroptions" name="groupattr{{ $attr->id }}" data="{{ $attr->id }}" class="form-control">
                                                    <option value="">Select</option>
                                                    @forelse($groupattrs as $groupattr)
                                                    <option value="{{ $groupattr->id }}" @if($groupattr->id == $attr->attrid) selected @endif>{{ $groupattr->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                </div>
                                                <div id="attropts{{$attr->id}}" class="col-sm-3">
                                                    
                                                    <select id="opts{{$attr->id}}" class="form-control">
                                                    <option value="">Select</option>
                                                    @forelse($attr->attrOpts as $opt)
                                                    <option value="{{ $opt->name }}" @if($opt->name == $attr->name) selected @endif>{{ $opt->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="attrprice{{$attr->id}}" value="{{ $attr->value}}" class="form-control">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="attrsale{{$attr->id}}" value="{{ $attr->sale}}" class="form-control">
                                                </div>
                                                <div class="col-sm-1"><i id="delrow" prodid="{{$attr->id}}" class="fa fa-trash" data="{{ $index}}"></i></div> <div class="col-sm-1"><i id="saverow" prodid="{{$attr->id}}" class="fa fa-save"></i></div>
                                            </div>

                                                @empty

                                                @endforelse
                                            </div>

                                                @endif

                                                <p> <button id="appendattr" type="button" class="btn btn-rounded btn-primary">Add Feature</button></p>

                                            @if(!empty($editdata->brand))
                                            <p id="addbrandfeature">

                                            <select name="brandname" id="" class="col-sm-3 form-control">
                                            <option value="">Select</option>
                                            @forelse($brands as $brand)
                                            <option value="{{ $brand->id }}" @if($brand->id == $editdata->brand) selected @endif>{{ $brand->name }}</option>
                                            @empty
                                            @endforelse
                                           </select>
                                         </p>

                                            @else
                                            
                                            <p id="addbrandfeature">    <button id="appendoptions" class="btn btn-rounded btn-primary">Add Brand</button></p>

                                            @endif
                                    		

                                    		</div>

                                    		<div class="col-sm-6">
                                                <br><br>
                                    			<h4 class="label-text">Select Category</h4>
                                                <br>
                                    			<div class="form-group row">
                                    @if(!empty($allparents))
                                        <select id="parentcat-addprod" name="levelcat0" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($allparents as $parent)
                                            <option value="{{ $parent->id }}" @if($parent->id == $editdata->cat_id) selected="selected" @endif>{{ $parent->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        @endif
                                    </div>
                                    

                                    <div id="level1">
                                        <div class="form-group row">
                                          <input type="hidden" name="level" value="1">
                                          <select id="level1cats" name="catlevel1" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($editdata->pcat as $level1)
                                            <option value="{{ $level1->id }}" @if($level1->id == $editdata->subcat_id) selected @endif>{{ $level1->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                    </div>
                                    </div>

                                    <div id="level2">
                                        <div class="form-group row">
                                         <select id="level1cats" name="catlevel2" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($editdata->scat as $level2)
                                            <option value="{{ $level2->id }}" @if($level2->id == $editdata->subchild_cat) selected @endif>{{ $level2->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                    </div>
                                    </div>
                                    <div id="level3"></div>
                                    <div id="level4"></div>


	</div>



                                    	</div>
                                        
                                    </div>

                                    <div class="tab-pane fade" id="tab13">

                                        <h4 class="label-text"> First Image Will be Cover Image</h4><br>
                                       All images will be resizes and optimize<br><br><br>
                                       <div class="clearfix"></div>

                                       <div class="row"> 

                                       @forelse($editdata->AllProductImgs as $n => $img )
                                       <div class="col-sm-2" id="{{$img->id}}">
                                        <div class="imggalary">

                                        <img class="img" src="{{ url($img->location)}}/{{$img->file_name}}">

                                       </div>
                                       <div class="row">
                                       <div class="col-sm-2 pull-left"><input id="coverimg" data="{{$img->id}}" prodid="{{$img->product_id}}" type="radio" name="frontimg" @if($img->coverimg == 1) checked @endif></div>
                                        <div class="col-sm-2 pull-right"><button type="button" id="delimg" data="{{$img->id}}" class="btn btn-sm btn-danger">Delete</button></div>
                                    </div>
                                       </div>

                                        




                                       @empty

                                       @endforelse
                                   </div>





                                       <div class="clearfix"><br></div>
                                        <div class="row">
                                            
                                            <div class="col-sm-3">
                                                <div id="image-preview1">
                                                  <label for="image-upload" id="image-label">Choose File</label>
                                                  <input type="file" name="prodimage[]" id="image-upload1" />
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div id="image-preview2">
                                                  <label for="image-upload" id="image-label">Choose File</label>
                                                  <input type="file" name="prodimage[]" id="image-upload2" />
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div id="image-preview3">
                                                  <label for="image-upload" id="image-label">Choose File</label>
                                                  <input type="file" name="prodimage[]" id="image-upload3" />
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div id="image-preview4">
                                                  <label for="image-upload" id="image-label">Choose File</label>
                                                  <input type="file" name="prodimage[]" id="image-upload4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab14">
                                       <h3 class="label-text"> Search Engine Optimization</h3><br>
                                       Improve your ranking and how your product page will appear in search engines results.
                                       <br><br>
                                       <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Meta Title</span>

                                    <div class="col-md-10">
                                        <input type="text" value="{{$editdata->meta_title}}" name="meta_title" id="url" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Short Description</span>

                                    <div class="col-md-10">
                                       <textarea id="short-desc" class="form-control" name="meta_content">{{$editdata->meta_content}} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right">Keywords</span>

                                    <div class="col-md-10">
                                       <textarea class="form-control" name="keywords">{{$editdata->keywords}}</textarea>
                                    </div>
                                </div>

                                    </div>
                                    <!-- Tab Pane End -->
                                </div>
                            
                                <!-- Tab Content End -->
                           
                        
                    </div>
</div>
</section>

<section class="main--content">
<div class="panel"> 
	<div class="panel-content py-5"> 
		<input type="submit">
	</div>
</div>
</form>
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
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.uploadPreview.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload1",   // Default: .image-upload
    preview_box: "#image-preview1",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });
  $.uploadPreview({
    input_field: "#image-upload2",   // Default: .image-upload
    preview_box: "#image-preview2",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });

  $.uploadPreview({
    input_field: "#image-upload3",   // Default: .image-upload
    preview_box: "#image-preview3",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });

  $.uploadPreview({
    input_field: "#image-upload4",   // Default: .image-upload
    preview_box: "#image-preview4",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });

});
</script>

<script src="{{ asset('public/assets/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('public/assets/js/sweetalert-init.js')}}"></script>


@include('ajax.product.product');
@endpush

