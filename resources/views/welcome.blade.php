@extends('layouts.app')
@section('page-title') Welcome @endsection
@section('content')

<h1 class="my-4">How OSW supports your research?</h1>

<!-- Marketing Icons Section -->
<div class="row">
    <div class="col-lg-4 mb-4">
    <div class="card h-100">
        <h4 class="card-header">Search and Discover</h4>
        <div class="card-body">
        <p class="card-text">Find papers, data, and materials to inspire your next research project. Search public
            projects to build on the work of others and find new collaborators.</p>
        </div>
    </div>
    </div>
    <div class="col-lg-4 mb-4">
    <div class="card h-100">
        <h4 class="card-header">Collect and Analyze Data</h4>
        <div class="card-body">
        <p class="card-text">Store data, code, and other materials in OSF Storage, or connect your Dropbox or other
            third-party account. Every file gets a unique, persistent URL for citing and sharing.</p>
        </div>
    </div>
    </div>
    <div class="col-lg-4 mb-4">
    <div class="card h-100">
        <h4 class="card-header">Publish Your Reports</h4>
        <div class="card-body">
        <p class="card-text">Share papers in OSF Preprints or a community-based preprint provider, so others can
            find and cite your work. Track impact with metrics like downloads and view counts.</p>
        </div>
    </div>
    </div>
    <!-- /.row -->


    <!-- Features Section -->
    <div class="row">
    <div class="col-lg-6">
        <h2>OSW Features</h2>
        <p>The OSW includes:</p>
        <ul>
        <li>
            <strong> Having a profile page</strong>
        </li>
        <li> The ability to create a workspace</li>
        <li> Adding your partners to the workspace</li>
        <li> Editing Files</li>
        <li> Download, upload and delete files</li>
        </ul>

    </div>
    <div class="col-lg-6">
        <img class="img-fluid rounded" src="{{ url('site_design') }}/images/features.jpg" alt="">
    </div>
    </div>
    <!-- /.row -->

    <hr>


</div>

@endsection
