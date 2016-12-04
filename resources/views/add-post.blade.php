@extends('layouts.default', ['showErrorsAsDismissible' => false])

@section('title', trans('post.add_post'))

@section('content')
    <form class="form" method="post">
        <div class="form-group @if($errors->has('title')) has-error @endif">
            <label for="new-post-title">{{ trans('default.title') }}</label>
            <input type="text" class="form-control" id="new-post-title"
                   placeholder="{{ trans('default.title') }}"
                   name="title" maxlength="30" required>
        </div>
        <div class="form-group @if($errors->has('content')) has-error @endif">
            <label for="new-post-content">{{ trans('default.content') }}</label>
            <textarea id="new-post-content" class="form-control textarea-auto-size"
                      name="content" placeholder="{{ trans('default.content') }}"
                      rows="10" maxlength="10000" required></textarea>
        </div>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('error'))
            @include('includes.alert', ['type' => 'danger', 'message' => session('error')])
        @endif
        <button class="btn btn-primary btn-block margin-bottom-1em">
            {{ trans('post.add_post') }}
        </button>
    </form>
@stop
