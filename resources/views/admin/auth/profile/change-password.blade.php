@section('page-title')Change Password @endsection

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Change Password</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
                                    <div class="basic-login-inner">
                                        	<form action="{{route('admin.changePassword')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="a" value="change-password" /> 

                                                <div class="form-group">
                                                    <label for="old_password" class="form-label">Old Password</label>
                                                    <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
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
