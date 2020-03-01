@extends(Config::get('theme').'.layout.master')

@push('css')

@endpush


@section('content')
<div id="content" class="container"> 
     <div class="row">
    <div class="col-md-3 ">
         <div class="list-group ">
              @include(Config::get('theme').'/pages/userarea/sidebarnav')
              
            </div> 
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Change Password</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      @if(!empty(session('successmsg')))
                      <div class="alert alert-success" >{{ session('successmsg') }}</div>
                      @endif
                        <form method="post" action="{{  url('/updatepass')}}">
                          {{ csrf_field()}}
                          <input type="hidden" name="id" value="{{Auth::user()->id}}">
                              <div class="form-group row">
                                <label for="pass" class="col-4 col-form-label">New Password*</label> 
                                <div class="col-8">
                                  <input id="pass" name="pass"  class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="rpass" class="col-4 col-form-label">Repeat Password*</label> 
                                <div class="col-8">
                                  <input id="rpass" name="rpass" required="required" class="form-control here" type="text" readonly>
                                </div>
                              </div>
                               
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="submit" type="submit" class="btn btn-small">Update Password</button>
                                </div>
                              </div>
                            </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  </div>
    
   
  </div>

@endsection


@push('js')

@include(Config::get('theme').'.ajax.script');
@endpush