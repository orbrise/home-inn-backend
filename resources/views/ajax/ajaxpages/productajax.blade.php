
@if(!empty($allatrs))
<ul class="navigation">
	@forelse($allatrs as $attr)
    <div class="row" id="{{ $attr->id}}" style="margin-bottom: 5px;">
                            
                        <div class="col col-sm-4" >
                            <label class="form-radio "> 
                                <input type="radio" id="attrnameforopt" name="attr" value="{{ $attr->id}}" class="form-radio-input" > 
                                <span class="form-radio-label">{{ $attr->name }}
                                </span> 

                            </label> 
                        </div>

                        <div class="col col-sm-2 pull-right">

                           <a href="#" id="deleteattr" class="label label-danger" data="{{$attr->id}}"> <i class="fa fa-trash text-white"></i> trash</a>
                        </div>
</div>
    @empty
    No Record Found

    @endforelse                    
</ul>
@endif

@if(!empty($getattropts))

@forelse($getattropts as $key => $option)
<div class="row" id="d{{$option->id}}">
    
    @if(!empty($option->value))
    <div class="col col-sm-3">
        <input type="text" name="f{{$option->id}}" value="{{ $option->name}}" class="form-control">
    </div>
       <div class="col col-sm-3">
        <input type="color" name="c{{$option->id}}" value="{{ $option->value}}" class="form-control">
        
    </div>

    @else
    <div class="col col-sm-6">
        <input type="text" name="f{{$option->id}}" value="{{ $option->name}}" class="form-control">        
    </div>

    @endif
        
    <div class="col col-sm-5">


    <button type="button" data="{{$option->id}}" class="btn btn-sm btn-rounded btn-success mr-2  mb-3 updateoption"><i class="fa fa-save"></i> Update</button>
    <button type="button" id="deleteoption" data="{{$option->id}}" class="btn btn-sm btn-rounded btn-danger mr-2  mb-3 deleteoption"><i class="fa fa-trash"></i> Trash</button>
           </div>                         
</div>
<hr>
@empty
No Record Found
@endforelse
@endif




    @if(!empty($levels1))
    <div class="form-group row">
        <input type="hidden" name="level" value="{{ $level}}">
        <select id="level1cats" name="catlevel{{ $level }}" class="form-control">
            <option value="">Select</option>
            @foreach($levels1 as $level1)
            <option value="{{ $level1->id }}">{{ $level1->name }}</option>
            @endforeach
           
        </select>
        </div>
        @endif
    
    

@if(!empty($groupattrs))
    <div class="form-group row" id="{{ $at}}">
        <input type="hidden" name="totalattr"  value="{{$at}}">
        <div class="col-sm-3">
        <select id="getattroptions" data="{{$at}}" name="groupattr{{$at}}" class="form-control">
            <option value="">Select</option>
            @forelse($groupattrs as $groupattr)
            <option value="{{ $groupattr->id }}">{{ $groupattr->name }}</option>
            @empty
            @endforelse
        </select>
        </div>
        <div id="attropts{{$at}}" class="col-sm-3">
            
            <select class="form-control" >
            <option value="">Select</option>
        </select>
        </div>
        <div class="col-sm-2">
            <input type="text" name="attrprice{{$at}}" class="form-control">
        </div>
        <div class="col-sm-2">
            <input type="text" name="attrsale{{$at}}" class="form-control">
        </div>
        <div class="col-sm-1"><i id="delrow" class="fa fa-trash" data="{{ $at}}"></i></div>
    </div>
        @endif



@if(!empty($opts))
<select name="opts{{$at}}" id=""  class="form-control">
            <option value="">Select</option>
            @forelse($opts as $opt)
            <option value="{{ $opt->name }}">{{ $opt->name }}</option>
            @empty
            @endforelse
        </select>
@endif



@if(!empty($allbrands))
<select name="brandname" id="" class="form-control">
            <option value="">Select</option>
            @forelse($allbrands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @empty
            @endforelse
        </select>
@endif

@if(!empty($searchprods))
@forelse($searchprods as $key => $prod)
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
                                        <a href="#" class="btn-link">@if(!empty($prod->cat_id)) {{$prod->PCatName->name}} @endif @if(!empty($prod->subcat_id)) > {{$prod->SCatName->name}} @endif @if(!empty($prod->subchild_cat)) > {{$prod->SCCatName->name}} @endif</a>
                                    </td>
                                    <td>@if(!empty($prod->prices))
                                        @forelse($prod->prices as $price)
                                        {{ $price->currency}} = <b>{{ $price->price}}</b><br>
                                        @empty
                                        @endforelse
                                        @endif</td>
                                    <td class="text-center">{{ $prod->qty }}</td>
                                    <td>{{ $prod->created_at}}</td>
                                    <td>@if($prod->delstatus == 0) <i class="fas fa-check-square fa-3x text-green"></i> @else <i class="fas fa-times-circle fa-3x text-red"></i> @endif / <input type="checkbox" id="isfeatured" data="{{$prod->id}}" @if($prod->is_featured == 'yes') checked @endif></td>
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
                                No Product Found!!
                                @endforelse
@endif

<script>
	var csrf = $('meta[name="_token"]').attr('content');
$("input[id='attrnameforopt']").unbind('click').click(function(){
	var attrid = $(this).val();
	$.post("{{ url('/customers/getattrval')}}", {_token:csrf,attrid:attrid}, function(data){
		$("#getattrvals").html(data);
		$("#appenddiv").empty();
	});
});

$("button.updateoption").unbind('click').click(function(){
var id = $(this).attr('data');
var value = $("input[name='f"+id+"']").val();
var color = $("input[name='f"+id+"']").val();
$.post('{{ url('/customers/updateattroption')}}', {_token:csrf,id:id,value:value,color:color}, function(){
swal("Data Updated!", "Click Ok button to continue", "success");
});
});


$("a#deleteattr").unbind('click').click(function(){
var valid = confirm('are you sure to delete?');
if(valid){
var id = $(this).attr('data');
$.post('{{ url('/customers/deletegroupattr')}}', {_token:csrf,id:id}, function(){
$("div#"+id).remove();
});
}
});

$("button#deleteoption").unbind('click').click(function(){
var validoption = confirm('are you sure to delete?');
if(validoption){
var optionid = $(this).attr('data');
$.post('{{ url('/customers/deleteattroption')}}', {_token:csrf,optionid:optionid}, function(){
$("div#d"+optionid).remove();
});
}
});

$("#level1cats").unbind("change").change(function(){
var catid = $(this).val();
var level = $("input[name='level']").val();
level = parseInt(level)+1;
$.post('{{ url('/customers/getlevels1')}}', {_token:csrf,catid:catid,level:level}, function(data){
$("div#level"+level).html(data);
});
});

$("i#delrow").unbind('click').click(function(){
var i = $(this).attr('data');
$("div#"+i).remove();
});


$("select#getattroptions").unbind("change").change(function(){

    var attrid = $(this).val();
    var at = $(this).attr('data');
    $.post('{{ url('/customers/getopts')}}', {_token:csrf,attrid:attrid, at:at}, function(data){
    $("div#attropts"+at).html(data);
    });

});

$("input#isfeatured").unbind('click').click(function(){

 var check = $(this).is(':checked');
 var data = $(this).attr('data');
 
 if(check == true) {
  $.post("{{ url('customers/isfeatured') }}", {_token:csrf, is:1, data:data }, function(){

  });
 } else 
 {
  $.post("{{ url('customers/isfeatured') }}", {_token:csrf, is:0, data:data }, function(){

  });
 }


});
</script>