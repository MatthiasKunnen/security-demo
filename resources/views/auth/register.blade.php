@extends('layouts.default', ['showErrorsAsDismissible' => false])

@section('title', trans('register.register'))

@section('content')
    <form class="form-type-1 margin-side-auto" action="/register" method="post">
        <h1>{{trans('register.register')}}</h1>
        <div class="form-group @if($errors->has('username')) has-error @endif">
            <label class="sr-only" for="first-name">{{trans('register.username')}}</label>
            <input type="text" class="form-control" name="username" id="username"
                   placeholder="{{trans('register.username')}}">
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif">
            <label class="sr-only" for="email">{{trans('login.email')}}</label>
            <input type="text" class="form-control" name="email" id="email"
                   placeholder="{{trans('login.email')}}">
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="sr-only" for="password">{{trans('register.password')}}</label>
            <input type="password" class="form-control" name="password" id="password"
                   placeholder="{{trans('register.password')}}">
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="sr-only" for="password-repeat">{{trans('register.password_confirm')}}</label>
            <input type="password" class="form-control" name="password_confirmation" id="password-repeat"
                   placeholder="{{trans('register.password_confirm')}}">
        </div>
        {{ csrf_field() }}
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
        <button type="submit" class="btn btn-default btn-block btn-continue">{{trans('register.register')}}</button>
    </form>
@stop
