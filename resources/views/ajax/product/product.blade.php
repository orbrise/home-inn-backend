<script>
$(document).ready(function(){
	$("#combprod1,.combprod1").hide();
var csrf = $('meta[name="_token"]').attr('content');



//functions

function ReloadOptions(i)
{
	$.post("{{ url('/customers/getattrval')}}", {_token:csrf,attrid:i}, function(data){

		$("#getattrvals").html(data);
		$("#appenddiv").empty();
	});
}


//end functions ===========


$("#creatnewattr").unbind('click').click(function(){

	var attrname = $('#attrname').val();
	if(attrname == '')
	{
		swal("Error!", "please write attribute name", "error");

	}
	
	$.post("{{ url('/customers/addnewattr')}}", {_token:csrf,attrname:attrname}, function(data){

		$("#getallattrs").html(data);
	});


});



$("input[id='attrnameforopt']").unbind('click').click(function(){

var attrid = $(this).val();
ReloadOptions(attrid);
});



var inc = 0;
$("#addattroption").unbind('click').click(function(){
	inc++;
	//var csrf = $('meta[name="_token"]').attr('content');
	var attrid = $("input[id = 'attrnameforopt']:checked").val();
	var attributename = $("input[id = 'attrnameforopt']:checked").attr('data');
	var attr = $( "input#attrnameforopt" ).is( ":checked" );
    if(attr == false){ return swal("Error!", "please select attribute", "error");}

    if(attributename == 'Color')
    {
    	$("#appenddiv").append("<input type='text' style='margin:5px 5px' name='f"+inc+"' class='col col-sm-4'><input type='color' style='margin:5px 5px' name='c"+inc+"' class='col col-sm-4'><button type='button' id='form-submit"+inc+"' data='"+inc+"' class='btn btn-success btn-sm saveoption'>Update</button><b><a class='text-danger col-sm-1' href='#' id='ar' data='"+inc+"'><i class='fa fa-times-circle'></i></a></b><div class='col col-sm-3'></div><div class='clearfix'></div>");

    }else 
    {
    	$("#appenddiv").append("<input type='text' style='margin:5px 5px' name='f"+inc+"' class='col col-sm-4'><button type='button' id='form-submit"+inc+"' data='"+inc+"' class='btn btn-success btn-sm saveoption'>Update</button><b><a class='text-danger col-sm-1' href='#' id='ar' data='"+inc+"'><i class='fa fa-times-circle'></i></a></b><div class='col col-sm-3'></div><div class='clearfix'></div>");
    }

	



$("a#ar").unbind('click').click(function(){

	inc--;
	var inc1 = $(this).attr('data');
	$("button#form-submit"+inc1).remove();
	$("input[name='f"+inc1+"']").remove();
	$("input[name='c"+inc1+"']").remove();
	$(this).remove();
	if(inc == 0) { $("#appenddiv").empty();}


});




$("button.saveoption").unbind('click').click(function(){

var incn = $(this).attr('data');
var value = $("input[name='f"+incn+"']").val();
var color = $("input[name='c"+incn+"']").val();

$.post('{{ url('/customers/addattroption')}}', {_token:csrf,attrid:attrid,value:value,color:color}, function(){

//swal("Good job!", "You clicked the button!", "success");
ReloadOptions(attrid);
});


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



$("#product-title").keyup(function(){
var titile = $(this).val().toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-');
$("#url").val(titile);

});



$("#short-desc").keyup(function(){
var desc = $(this).val().length;
if(desc >= 271 )
{
	$("#remainingwords").text('You Reached Maximum Words Limit');
}
else {$("#remainingwords").text(271-desc);}


});


$("#stdprod").unbind('click').click(function(){
$("#combprod1, .combprod1").hide();
});

$("#combprod").unbind('click').click(function(){

$("#combprod1, .combprod1").show();

});

$("#parentcat-addprod").unbind("change").change(function(){
var catid = $(this).val();
var level = 1;
$.post('{{ url('/customers/getlevels1')}}', {_token:csrf,catid:catid, level:level}, function(data){
$("div#level1").html(data);
});
});

var at = 0;
$("button#appendattr").unbind('click').click(function(){
at++;
$.post('{{ url('/customers/appendattr')}}', {_token:csrf, at:at}, function(data){
$("div#appendattribute").append(data);
$("input[name='totalattr']").value = at;
});
});

$("button#appendoptions").unbind('click').click(function(){
$(this).remove();
$.post('{{ url('/customers/appendbrand')}}', {_token:csrf}, function(data){
$("p#addbrandfeature").append(data);
});
});

$("select#getattroptions").unbind("change").change(function(){

    var attrid = $(this).val();
    var at = $(this).attr('data');
    $.post('{{ url('/customers/getopts')}}', {_token:csrf,attrid:attrid, at:at}, function(data){
    $("div#attropts"+at).html(data);
    });

});

$("i#delrow").unbind('click').click(function(){
var i = $(this).attr('data');
var prodid = $(this).attr('prodid');
 $.post('{{ url('/customers/deleteattr')}}', {_token:csrf,prodid:prodid, at:i}, function(data){
    $("div#"+i).remove();
    });


});

$("input[name='frontimg']").unbind('click').click(function(){

	var imgid = $(this).attr('data');
	var prodid = $(this).attr('prodid');
	$.post('{{ url('/customers/coverimg')}}', {_token:csrf,prodid:prodid,imgid:imgid}, function(){

    });
});

$("button#delimg").unbind('click').click(function(){
var conf = confirm('are you sure to delte?');
if(conf)
{
	var imgid = $(this).attr('data');
	$.post('{{ url('/customers/delimg')}}', {_token:csrf,imgid:imgid}, function(){
    $("div#"+imgid).remove();
    });
}

});

$("i#saverow").unbind('click').click(function(){

var prodid = $(this).attr('prodid');
var attrid = $("select[name='groupattr"+prodid+"']").val();
var attrname1 = $("select[name='opts"+prodid+"']").val();
var attrname2 = $("select#opts"+prodid).val();
alert(attrname2);
var attrvalue = $("input#attrprice"+prodid).val();
 $.post('{{ url('/customers/saveattr')}}', {_token:csrf,prodid:prodid,attrid:attrid,attrname1:attrname1,attrname2:attrname2,attrvalue:attrvalue},
  function(data){

  	if(data == 'success'){
  		swal('Success!','Your changes successfully updated ','success');
  	} else {
  		swal('opps!','There is some error please try later','error');
  	}
   
    });
});


$("#level1cats").unbind("change").change(function(){
var catid = $(this).val();
var level = $("input[name='level']").val();
level = parseInt(level)+1;
$.post('{{ url('/customers/getlevels1')}}', {_token:csrf,catid:catid,level:level}, function(data){
$("div#level"+level).html(data);
});
});


$("button#searchprod").unbind('click').click(function(){
	var keyword = $("#keywords").val();
	if(keyword.length == 0){}else{
	$.post('{{ url('/customers/searchproduct')}}', {_token:csrf,keyword:keyword}, function(data){
    $("tbody#filterdata").html(data);
     });
}

});

$("#test").validate({
  invalidHandler: function(event, validator) {
    // 'this' refers to the form
    
    var errors = validator.numberOfInvalids();
    if (errors) {
      var message = errors == 1
        ? 'You missed 1 field. It has been highlighted'
        : 'You missed ' + errors + ' fields. They have been highlighted';
      $("div.error span").html(message);
      $("div.error").show();
    } else {
      $("div.error").hide();
    }
  }
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






/* ====== */
});
</script>