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
            <li class="active"><span>Edit Video</span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
@stop

@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Create Video</h2>
        </header>

        <div class="panel-body">
            <!-- Include error message div -->
            @include('elements.event')

            <form action="{{ url('videos/store') }}" class="form-horizontal" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title" class="col-md-3 control-label">Title</label>

                    <div class="col-md-5">
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ old('title') }}" placeholder="Title">
                    </div>
                    <!-- div.col-md-5 -->
                </div>
                <!-- div.form-group -->

                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">Description</label>

                    <div class="col-md-5">
                        <textarea name="description" id="description" class="form-control"
                                  placeholder="Description"></textarea>
                    </div>
                    <!-- div.col-md-5 -->
                </div>
                <!-- div.form-group -->

                <div class="form-group">
                    <label for="order_number" class="col-md-3 control-label">Order Number</label>

                    <div class="col-md-5">
                        <input type="text" name="order_number" id="order_number" class="form-control"
                               value="{{ old('order_number') }}" placeholder="Order Number">
                    </div>
                    <!-- div.col-md-5 -->
                </div>
                <!-- div.form-group -->

                <div class="form-group">
                    <label for="embed_code" class="col-md-3 control-label">Embed Code</label>

                    <div class="col-md-5">
                        <input type="text" name="embed_code" id="embed_code" class="form-control"
                               value="{{ old('embed_code') }}" placeholder="Embed Code">
                    </div>
                    <!-- div.col-md-5 -->
                </div>
                <!-- div.form-group -->

                <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                    <!-- div.col-md-offset-10.col-md-2 -->
                </div>
                <!-- div.form-group -->
            </form>
            <!-- form.form-horizontal -->
        </div>
    </section>
@stop