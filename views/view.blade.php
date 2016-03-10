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
            <li class="active"><span>Watch a Video</span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
@stop

@section('content')
    @include('elements.event')

    <div class="row">
        <div class="col-md-12">
            <aside class="pull-right">
                <!-- Previous button -->
                @if($previous->count() > 0)
                    <a href="{{ url('videos/' . $previous->first()->order_number . '-' . $previous->first()->slug . '/view') }}"
                       class="btn btn-info">Previous</a>
                @endif

                @if(Auth::user())
                    @if($video->watchedByUser($auth->user))
                        <a href="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/unwatch') }}"
                           class="btn btn-success">Video Completed</a>
                    @else
                        <a href="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/watch') }}"
                           class="btn btn-success">Mark Completed</a>
                    @endif
                @else
                    <a href="{{ url('login') }}" class="btn btn-success">Mark Completed</a>
                @endif

                {{-- Next button --}}
                @if($next->count() > 0)
                    <a href="{{ url('videos/' . $next->first()->order_number . '-' . $next->first()->slug . '/view') }}"
                       class="btn btn-info">Next</a>
                @endif

                @if($auth->admin)
                    <a href="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/edit') }}"
                       class="btn btn-default">Edit</a>
                    <a href="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/delete') }}"
                       class="btn btn-danger">Delete</a>
                @endif
            </aside>
        </div>
    </div>

    <br>

    <!-- 16:9 aspect ratio -->
    <div class="embed-responsive embed-responsive-16by9">
        {!! $video->embed_code !!}
    </div>

    <br>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Video Description</h2>
        </header>

        <div class="panel-body">
            {!! $video->description !!}
        </div>
    </section>

    <br>
@stop