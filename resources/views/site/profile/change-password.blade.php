<div class="row">
    <div class="col-sm-12">

        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                <form action="{{route('site.changePassword')}}" method="post">
                    @csrf
                <input type="hidden" name="a" value="change-password">

                    <div class="form-group">
                        <label for="old_password" class="form-label"><h4>Old Password</h4></label>
                        <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label"><h4>Password</h4></label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label"><h4>Confirm Password</h4></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <div class="d-flex justify-content-around">
                        <button class="btn btn-lg btn-success" type="submit"><i
                                class="glyphicon glyphicon-ok-sign"></i> Save</button>
                        <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i>
                            Reset</button>
                        </div>
                    </div>        
    
                </div>
                </form>
                </div>

                <div class="tab-pane fade" id="profile">
                <form id="tab2">
                    <label>New Password</label>
                    <input type="password" class="input-xlarge">
                    <div>
                        <button class="btn btn-primary">Update</button>
                    </div>
                    
                </form>
                </div>

            </div>
    
        </div>
    </div>
    <!--/col-9-->
</div>
<!--/row-->