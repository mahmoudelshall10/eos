@extends('layouts.app')
@section('page-title') Team Members @endsection
@section('content')

@push('sitecss')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('site_design') }}/css/team.css" rel="stylesheet">
@endpush




<div id="rs-team" class="rs-team fullwidth-team pt-100 pb-70">
    <div class="container">
        <div class="row">
            @foreach ($teams as $team)
                <div class="col-lg-4 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            @if ($team->photo)
                            <img src="{{ url('/') . '/' .$team->photo }}" alt="{{ $team->name }}">
                            @else
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="{{ $team->name }}">
                            @endif
                            <div class="normal-text">
                                <h4 class="team-name">{{ $team->name }}</h4>
                                <span class="subtitle">{{ $team->job_title }}</span>
                            </div>
                        </div>
                        <div class="team-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <div class="share-icons">
                                        <div class="border"></div>
                                        <ul class="team-social icons-1">
                                            <li>
                                                <a href="{{ $team->facebook_url }}" target="_blank" class="social-icon"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{ $team->twitter_url }}" target="_blank" class="social-icon"><i class="fa fa-twitter"></i></a>
                                            </li>
                                        </ul>

                                        <ul class="team-social icons-2">
                                            <li>
                                                <a href="{{ $team->insta_url }}" target="_blank" class="social-icon"><i class="fa fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{ $team->linkedin_url }}" target="_blank" class="social-icon"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- .container-fullwidth -->
</div>



@endsection