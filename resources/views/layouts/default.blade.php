<!DOCTYPE html>
<html lang="@yield('language_code', 'en')">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | D-SEC</title>

    @include('includes.head')
</head>
<body>
    <header class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">D-SEC</a>
            </div>
            <nav class="navbar-collapse collapse">
                @if(Auth::check())
                    <ul class="nav navbar-nav">

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="form-link" method="post" action="/logout">
                                {{csrf_field()}}
                                <button type="submit">{{ trans('login.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/register">{{ trans('register.register') }}</a></li>
                        <li><a href="/login">{{ trans('login.login') }}</a></li>
                    </ul>
                @endif
            </nav>
        </div>
    </header>

    @if(!isset($showErrorsAsDismissible) || $showErrorsAsDismissible !== false)
        @if(session()->has('error'))
            <div class="container">
                @include('includes.alert-dismissible', ['type' => 'danger', 'message' => session('error')])
            </div>
        @endif

        @if($errors->any())
            <div class="container">
                @include('includes.alert-dismissible', ['type' => 'danger', 'message' => $errors->all()])
            </div>
        @endif
    @endif

    @if(session()->has('success'))
        <div class="container">
            @include('includes.alert-dismissible', ['type' => 'success', 'message' => session('success')])
        </div>
    @endif

    @if(session()->has('warning'))
        <div class="container">
            @include('includes.alert-dismissible', ['type' => 'warning', 'message' => session('warning')])
        </div>
    @endif

    <div class="container body-content body-content-background">
        @yield('content')
    </div>

    @include('includes.scripts')
</body>
</html>
