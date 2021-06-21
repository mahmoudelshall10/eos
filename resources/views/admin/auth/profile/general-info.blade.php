@section('page-title') General Info @endsection
<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>General Info</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
                                    <div class="basic-login-inner">
										<form action="{{route('admin.generalInfo')}}" method="post">
											@csrf
											<input type="hidden" name="a" value="general-info" /> 
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" placeholder="Name" name="name" value="{{Auth::user()->name}}">
											</div>

											<button type="submit" class="btn btn-primary">Submit</button>

										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Basic Form End-->
