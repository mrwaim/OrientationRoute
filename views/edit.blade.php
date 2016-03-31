@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Orientation Video', 'page_title' => 'Edit Video'])
@endsection

@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Edit Video</h2>
        </header>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <!-- Include error message div -->
                    @include('elements.event')

                    <form action="{{ url('videos/' . $video->order_number . '-' . $video->slug . '/update') }}"
                          class="form-horizontal" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="title" class="col-md-3 control-label">Title</label>

                            <div class="col-md-9">
                                <input type="text" name="title" id="title" class="form-control"
                                       value="{{ $video->title }}" placeholder="Title">
                            </div>
                            <!-- div.col-md-9 -->
                        </div>
                        <!-- div.form-group -->

                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">Description</label>

                            <div class="col-md-9">
                                <textarea name="description" id="description" class="form-control"
                                          placeholder="Description">{{ $video->description }}</textarea>
                            </div>
                            <!-- div.col-md-9 -->
                        </div>
                        <!-- div.form-group -->

                        <div class="form-group">
                            <label for="order_number" class="col-md-3 control-label">Order Number</label>

                            <div class="col-md-9">
                                <input type="text" name="order_number" id="order_number" class="form-control"
                                       value="{{ $video->order_number }}" placeholder="Order Number">
                            </div>
                            <!-- div.col-md-9 -->
                        </div>
                        <!-- div.form-group -->

                        <div class="form-group">
                            <label for="embed_code" class="col-md-3 control-label">Embed Code</label>

                            <div class="col-md-9">
                                <input type="text" name="embed_code" id="embed_code" class="form-control"
                                       value="{{ $video->embed_code }}" placeholder="Embed Code">
                            </div>
                            <!-- div.col-md-9 -->
                        </div>
                        <!-- div.form-group -->

                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                            <!-- div.col-md-offset-10.col-md-2 -->
                        </div>
                        <!-- div.form-group -->
                    </form>
                    <!-- form.form-horizontal -->
                </div>
                <!-- /.col-md-6.col-md-offset-3 -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection