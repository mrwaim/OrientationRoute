@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Orientation Video', 'page_title' => 'Video Details for ' . $user->name])
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
@endsection