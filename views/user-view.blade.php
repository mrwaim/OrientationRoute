@extends('app')

@section('page-header')
    <h2>Video Details for {{$user->name}}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Video Management</span></li>
            <li><span>
                    Video Details for {{$user->name}}
        </span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
@endsection

@section('content')

    @if(count($user->watchedVideo) > 0)
        <div class="row">
            @foreach($user->watchedVideo as $watchedVideo)
                <div class="col-md-3">
                    <!-- 4:3 aspect ratio -->
                    <div class="embed-responsive embed-responsive-4by3">
                        {!! $watchedVideo->video->embed_code !!}
                    </div>

                    <br>

                    <p>
                        <a href="{{ url('videos/' . $watchedVideo->video_id . '-' . $watchedVideo->video->slug . '/view') }}">{{ $watchedVideo->video->title }}</a>
                    </p>
                </div>
            @endforeach
        </div>
    @else
        This user has not seen any video yet.
    @endif
@stop