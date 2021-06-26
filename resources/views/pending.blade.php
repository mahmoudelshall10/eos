@extends('layouts.app')
@section('page-title') Welcome @endsection
@section('content')

@if(session()->has('pending'))
    <div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
      <div class="alert-message">
        {{ session()->get('pending') }}
      </div>
    </div>
@endif


@endsection