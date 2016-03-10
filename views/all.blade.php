@extends('app')

@section('page-header')
    <h2>Orientation Video</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="{{ url('home') }}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Orientation Video</span></li>
            <li class="active"><span>All Videos</span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
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
@stop