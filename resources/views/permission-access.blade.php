@extends('layouts.app')
@section('page-title') Welcome @endsection
@section('content')

@if(session()->has('permission'))
  <form action="{{route('accessPermission')}}" method="post">
    @csrf
    @if(session()->has('uuid'))
      <input type="hidden" name="uuid" value="{{session()->get('uuid')}}">
    @endif
    <button type="submit" class="btn btn-success">{{ session()->get('permission') }}</button>
  </form>
@endif


@endsection