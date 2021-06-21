@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
		<div class="alert-message">
			{{ session()->get('success') }}
		</div>
    </div>
@endif

@if(session()->has('error'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="alert-message">
			<strong>{{ session('error') }}</strong>
		</div>
	</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<ul class="alert-message" style="padding-left: 24px">
	@foreach ($errors->all() as $error)
		<li><strong>{{ $error }}</strong></li>
	@endforeach
	</ul>
</div>
@endif


