@extends('layouts.default', ['showErrorsAsDismissible' => false])

@section('title', trans('login.login'))

@section('content')
    <form class="form-type-1 margin-side-auto" action="/login" method="post">
        <div class="form-group @if($errors->has('email')) has-error @endif">
            <label class="sr-only" for="email">{{trans("login.email")}}</label>
            <input type="text" class="form-control"
                   name="email" id="email"
                   placeholder="{{trans("login.email")}}">
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="sr-only" for="password">{{trans("login.password")}}</label>
            <input type="password"
                   class="form-control"
                   name="password"
                   id="password"
                   placeholder="{{trans('login.password')}}">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember">
                {{trans('login.remember_me')}}
            </label>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
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
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default btn-block btn-continue margin-bottom-1em">
            {{trans('login.login')}}
        </button>
        <p class="text-center">
            {{trans('login.not_registered')}}?
            <strong>
                <a href="/register">{{trans('login.create_an_account')}}</a>
            </strong>
        </p>
    </form>
@stop
