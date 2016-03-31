@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Orientation Video', 'page_title' => 'All Videos'])
@endsection

@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">All Videos</h2>
        </header>

        <div class="panel-body">
            @include('elements.event')

            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-3">
                        <!-- 4:3 aspect ratio -->
                        <div class="embed-responsive embed-responsive-4by3">
                            {!! $video->embed_code !!}
                        </div>

                        <br>

                        <p>
                            <a href="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/view') }}">{{ $video->title }}</a>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection