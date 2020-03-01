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
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5"
                           data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>

                        <p class="summary--title">This Month</p>

                        <p class="summary--stats text-green">2,371,527</p>
                    </div>

                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5"
                           data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>

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
        <div style="background-color: white">


            <ul class="nav nav-tabs nav-tabs-line-top">
                <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#basic">Basic Information</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#meta">SEO</a></li>
            </ul>
            <form method="post" action="{{ url('customers/updatecat')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $editdata->id }}">
                <div class="tab-content">

                    <div id="basic" class="tab-pane fade show active">
                        <!-- Form Group Start -->
                        @if(!empty(session('successmsg')))
                            <div class="alert alert-success">{{session('successmsg')}}</div>@endif
                        @if($errors->any())
                            <div class="alert alert-danger">Fill all required fields.</div>@endif
                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">* Category Name</span>

                            <div class="col-md-10">
                                <input type="text" name="cname" id="cname" value="{{ old('cname', $editdata->name) }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">* SEO Url</span>

                            <div class="col-md-10">
                                <input type="text" name="slug" id="slug" value="{{  old('slug', $editdata->slug)}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">Category Current Image</span>

                            <div class="col-md-10">
                                @if($editdata->catimg)
                                    <img width="100" src="{{url('public/assets/products/catimages')}}/{{ $editdata->catimg}}">
                                @endif
                                <label class="custom-file" style="margin-top: 10px">
                                    <input type="file" name="catimg" class="custom-file-input"
                                           accept="image/x-png,image/jpg,image/jpeg">
                                    <span class="custom-file-label">Choose File</span>
                                </label>

                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">Long Description</span>

                            <div class="col-md-10">

                                <textarea type="text" id="mymce" name="longdesc" placeholder="optional" class="form-control">{{  old('longdesc', $editdata->longdesc) }}</textarea>
                            </div>
                        </div>


                    </div>
                    <div id="meta" class="tab-pane fade">

                        {{-- meta title --}}
                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">Meta Title</span>

                            <div class="col-md-10">
                                <input type="text" name="meta_title" value="{{  old('meta_title', $editdata->meta_title)}}" class="form-control">
                            </div>
                        </div> {{-- end: meta title --}}

                        {{-- shot description--}}
                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">Short Description</span>

                            <div class="col-md-10">

                                <textarea type="text" name="meta_content" id="shortdesc" placeholder="optional" class="form-control" maxlength="180">{{  old('meta_content', $editdata->meta_content) }}</textarea>
                                <span class="text-info">Maximum 180 Chracters allow with space. </span><span class="text-orange" id="remainingwords"></span>
                            </div>
                        </div> {{-- end: short descriptipn --}}

                        {{-- Keywords --}}
                        <div class="form-group row">
                            <span class="label-text col-md-2 col-form-label text-md-right">Keywords</span>

                            <div class="col-md-10">

                                <textarea type="text" name="keywords" placeholder="optional" class="form-control">{{  old('keywords', $editdata->keywords) }}</textarea>
                            </div>
                        </div> {{-- end: Keywords --}}




                    </div>

                    <hr>
                    <div class="row">

                        <div class="offset-2 col-md-10">
                            <button type="submit" class="btn btn-rounded btn-primary"><i class="fa fa-save"></i> Submit
                            </button>
                            @if(!empty(session('successmsg')))
                                <button class="btn btn-rounded btn-info" type="button" onclick="window.history.go(-2)">
                                    Back
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

</section>


@endsection

@push('js')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=eslvaow8fan5qg0cxdwb3i8445n3j1eonhd8e0bckqjp22hm"></script>

<script>
    $(document).ready(function(){
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

        $("#shortdesc").keyup(function(){
            var desc = $(this).val().length;
            if(desc >= 180 )
            {
                $("#remainingwords").text('You Reached Maximum Words Limit');
            }
            else {$("#remainingwords").text(180-desc);}
        });

        $("#cname").keyup(function(){
            var titile = $(this).val().toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            $("#slug").val(titile);

        });
    });
</script>
@endpush