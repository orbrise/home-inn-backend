@extends('layout.master')

@push('css')
<style>
table, tr, td{border:0px !important;}
.stepwizard-step p {
    margin-top: 10px;    
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;     
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
    
}

.stepwizard-step {    
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}

.active{ background-color:#2980b9; color:white; }
.active:hover{ background-color:#2980b9; color:white;}
.disable {background-color:#7f8c8d;color:white;}
.disable:hover {background-color:#7f8c8d;color:white;}
</style>
@endpush

@section('content')
            <div class="panel" style="padding: 30px">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Order #{{ $orderf->order_no}}</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                      <div class="col-sm-6 col-xs-12">
                        <h5>Billing Details</h5>
                        <table class="table ">
                          <tr>
                            <td>Full Name</td>
                             <td><b>{{ucfirst($orderf->custinfo->name)}}</b></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                             <td><b>{{ucfirst($orderf->customer)}}</b></td>
                          </tr>
                          <tr>
                            <td>Date</td>
                             <td><b>{{date('d M Y',strtotime($orderf->created_at))}}</b></td>
                          </tr>

                          <tr>
                            <td>Address</td>
                             <td><b>{{ $orderf->address }}</b></td>
                          </tr>
                          <tr>
                            <td>City</td>
                             <td><b>{{ $orderf->city }}</b></td>
                          </tr>

                          <tr>
                            <td>Country</td>
                             <td><b>{{ $orderf->country }}</b></td>
                          </tr>

                          <tr>
                            <td>Phone</td>
                             <td><b>{{ $orderf->phone }}</b></td>
                          </tr>



                        </table>
                      </div>

                      <div class="col-sm-6 col-xs-12">
                        <h5>Products</h5>
                        @if(!empty($orders))
                        <table class="table">
                        @foreach($orders as $order)
                        <tr>
                          <td><img width="50" class="img" src="{{url('/')}}/{{$order->prodimg->location}}/{{$order->prodimg->file_name}}"></td>
                          <td>{{$order->product_name}} <br> x {{$order->qty}}</td>
                          <td>{{$order->price}}</td>
                          <td>{{$order->total}}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td></td>
                          <td></td>
                          <td class="text-right" style="border-top:2px solid black !important;border-bottom:2px solid black !important"><b>Total</b> </td>
                          <td style="border-top:2px solid black !important; border-bottom:2px solid black !important"><b>{{ $orders->sum('total')}}</b></td>
                        </tr>
                      </table>
                        @endif
                      </div>

                      <div class="clearfix"><br></div>
<br><br>


                      <h4>Order Status</h4>
<br><br>
                      <div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <button type="button" class="btn @if($orderf->process_level >= 1) active @else disable @endif btn-circle">1</button>
            <p>Order Placed</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn @if($orderf->process_level >= 2) active @else disable @endif btn-circle">2</button>
            <p>Processed</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn @if($orderf->process_level >= 3) active @else disable @endif btn-circle">3</button>
            <p>Ready for Shipment</p>
        </div> 
        <div class="stepwizard-step">
            <button type="button" class="btn @if($orderf->process_level >= 4) active @else disable @endif btn-circle">4</button>
            <p>Delivered to Shipper</p>
        </div> 
        <div class="stepwizard-step">
            <button type="button" class="btn @if($orderf->process_level >= 5) active @else disable @endif btn-circle">3</button>
            <p>Delivered to Customer</p>
        </div> 
    </div>
</div>





                    </div>

<div class="container panel">
<br>
@if(!empty(session('successmsg'))) <div class="alert alert-success">{{session('successmsg')}}</div>@endif
                <form action="{{ url('customers/updateorderstatus')}}" method="post">
                  {{ csrf_field()}}
<input type="hidden" name="orderno" value="{{$orderf->order_no}}">
<select name="status" class="form-control">
  <option>Select</option>
  <option value="1">Pending</option>
  <option value="2">Process</option>
  <option value="3">Ready for Shipments</option>
  <option value="4">Delivered to Shipper</option>
  <option value="5">Delivered to Customer</option>

</select>
<input type="submit" class="btn" value="Update Status">
  </form>
      
 </div>
                </div>
                

    @endsection

    @push('js')

    @endpush