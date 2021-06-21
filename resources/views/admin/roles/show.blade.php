@extends('admin.layouts.app')
@section('page-title') Show Role @endsection
@section('content')

<h1 class="h3 mb-3">Role @can('admin.roles.index')<a href="{{route('admin.roles.index')}}" class="btn btn-success">Back</a>@endcan</h1>
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header">
                    <h5 class="card-title">Edit - {{ucfirst($role->name)}} Role</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($rolePermissions as $permission)
                    <div class="form-row col-4">
                        <div class="form-group">
                            {{$permission->name}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
@endsection