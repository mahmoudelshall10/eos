<div class="row">
    <div class="col-sm-3 text-center">
        <br>
        <ul class="list-group">
            <li class="list-group-item text-muted">Reseachers <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Solar power</strong></span> 10 </li>

        </ul>

        <br>

    </div>
    <!--/col-3-->
    <div class="col-sm-9">
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                <form action="{{route('site.generalInfo')}}" method="post">
                    @csrf
                <input type="hidden" name="a" value="general-info">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <label for="name">
                                <h4>Name</h4>
                            </label>
                            <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter name" value="{{ Auth::user()->name }}">
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="phone">
                                <h4>Phone</h4>
                            </label>
                            <input type="number" class="form-control" name="phone" 
                            id="phone" placeholder="Enter phone"
                            value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                </div>
    
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <label for="email">
                                <h4>Email</h4>
                            </label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter your email" value="{{ Auth::user()->email }}">
                        </div>

                        <div class="col-lg-6">
                            <label for="date_of_birth">
                                <h4>Date Of Birth</h4>
                            </label>
                            <input type="text" class="form-control" name="date_of_birth" 
                            id="date_of_birth" placeholder="Enter date of birth"
                            value="{{ Auth::user()->date_of_birth }}" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <label for="gender">
                                <h4>Gender</h4>
                            </label>
                            <select id="gender" class="form-control" name="gender">
                                <option value="">Choose Gender</option>
                                @foreach(["male" => "Male", "female" => "Female"] AS $gender => $Type)    
                                    <option value="{{ $gender }}" {{ Auth::user()->gender == $gender ? "selected" : "" }}>{{ $Type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="facebook_url">
                                <h4>Facebook URL</h4>
                            </label>
                            <input type="text" class="form-control" name="facebook_url" 
                            id="facebook_url" placeholder="Enter facebook url"
                            value="{{ Auth::user()->facebook_url }}" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-4">
                            <label for="twitter_url">
                                <h4>Twitter URL</h4>
                            </label>
                            <input type="text" class="form-control" name="twitter_url" 
                            id="twitter_url" placeholder="Enter twitter url"
                            value="{{ Auth::user()->twitter_url }}" autocomplete="off">
                        </div>

                        <div class="col-lg-4">
                            <label for="linkedIn_url">
                                <h4>LinkedIn URL</h4>
                            </label>
                            <input type="text" class="form-control" name="linkedIn_url" 
                            id="linkedIn_url" placeholder="Enter linkedIn url"
                            value="{{ Auth::user()->linkedIn_url }}" autocomplete="off">
                        </div>

                        <div class="col-lg-4">
                            <label for="insta_url">
                                <h4>Instagram URL</h4>
                            </label>
                            <input type="text" class="form-control" name="insta_url" 
                            id="insta_url" placeholder="Enter instagram url"
                            value="{{ Auth::user()->insta_url }}" autocomplete="off">
                        </div>
                    </div>
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

@push('sitejs')
<script>
$( function() {
    $( "#date_of_birth" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
});
} );
</script>
@endpush