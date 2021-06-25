@extends('layouts.app')
@section('page-title') Create Project @endsection
@section('content')


@include('flash_messages')

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Create Project Form @can('researcher.workspaces.index')<a href="{{route('researcher.workspaces.index')}}" class="btn btn-primary">Back</a>@endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('researcher.workspaces.store')}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-lg-12">
                                                <label for="name"><h4>Name</h4></label>
                                                <input type="text" name="name" id="name" class="form-control" 
                                                placeholder="Enter Name" value="{{old('name')}}"/>
                                            </div>

 
                                            <div class="form-group col-lg-12">
                                                <label><h4>Categories</h4> </label>
                                                <select name="category_id[]" id="category_id" class="form-control  @error('category_id') is-invalid @enderror"  multiple="multiple">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"  {{ old("category_id") == $category->id ? "selected" : "" }}>{{ ucfirst($category->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="description"><h4>Description</h4></label>
                                                <textarea name="description" id="description" class="form-control" 
                                                placeholder="Enter Description">{{old('description')}}</textarea>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="project_files"><h4>Project Files</h4></label>
                                                <input type="file"  name="project_files[]" id="project_files" multiple="multiple">
                                            </div>


                                            <div class="login-btn-inner">
                                                <div class="inline-remember-me">
                                                    <button class="btn btn-sm btn-primary pull-right login-submit-cs" type="submit">Submit</button>
                                                </div>
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

@endsection