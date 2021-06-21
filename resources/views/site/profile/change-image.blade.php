<div class="row">
        <div class="col-sm-12">
        <!--left col-->
        <div class="text-center">
                <form action="{{route('site.changePassword')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="a" value="change-image">
                @if (Auth::user()->photo)
                <img src="{{ url('/') . '/' . Auth::user()->photo}}" class="avatar img-circle img-thumbnail" alt="{{ Auth::user()->name }}">
                @else
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="{{ Auth::user()->name }}">
                @endif
                <h6>Upload a different photo...</h6>
                <input type="file" name="photo" class="text-center center-block file-upload" id="profilephoto">
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>

        </div>

    </div>
    <!--/col-3-->
</div>