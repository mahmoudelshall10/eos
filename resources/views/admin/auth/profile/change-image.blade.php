@section('page-title')Change Image @endsection

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Change Image</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
                                    <div class="basic-login-inner">
										<form action="{{route('admin.changeImage')}}" method="post" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="a" value="change-image" /> 

										<div class="form-group">
												<label class="form-label">Photo</label>
												<input type="file" name="photo" >
											</div>

											<br>
											
											<div class="row no-gutters mt-1">
												<div class="col-6 col-md-4 col-lg-4 col-xl-3">
													<img src="{{url('/').'/'.Auth::user()->photo}}" class="img-fluid pr-2" alt="{{explode(' ',Auth::user()->name)[0]}}">
												</div>
											</div>
											<br>
											<div class="form-group">    
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>

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
