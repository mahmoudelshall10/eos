@extends('layouts.app')
@section('page-title') Show Workspace @endsection
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
                            <h1>Show Project Form <a href="{{route('researcher.workspaces.index')}}" class="btn btn-primary">Back</a></h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Name: </strong> {{$project->name}}</p>
                                        <p><strong>Created By: </strong> {{$project->createdBy->name}}</p>
                                        <p><strong>Description: </strong> {{$project->description}}</p>


                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Researcher Name: </strong> {{$project->researcher->name}}</p>
                                        <p><strong>Categories: </strong> 
                                            @foreach ($project->categories as $category)
                                                ({{ $category->name }})
                                            @endforeach
                                        </p>

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