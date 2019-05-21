<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ trans('installer_messages.title') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>
    <link href="{{ asset('installer/css/app.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.4.8/css/ionicons.min.css">
    @yield('style')
    <script>
        window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="app">
    <div class="container">

        <header class="header">
            <img src="{{ asset('installer/img/brand.svg') }}" alt="Laravel Installer"/>
        </header>
        
        <aside class="aside">
            @include('vendor.installer.partials.steps')
        </aside>
        
        <main class="main">
            @if (session('message'))
            <p class="alert text-center">
                <strong>
                    @if(is_array(session('message')))
                    {{ session('message')['message'] }}
                    @else
                    {{ session('message') }}
                    @endif
                </strong>
            </p>
            @endif
            @if(session()->has('errors'))
            <div class="alert alert-danger" id="error_alert">
                <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4>
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ trans('installer_messages.forms.errorTitle') }}
                </h4>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <main class="step-main">
                <header class="step-header">
                    <div class="step-header-icon">
                        <img src="@yield('icon')" alt="">
                    </div>
                    <h2 class="step-header-heading">
                        @yield('title')
                    </h2>
                </header>
                
                @yield('main')
            </main>
            
            <footer class="step-actions">@yield('actions')</footer>
            
        </main>
        
    </div>
    
    @yield('progress')
    
    @yield('scripts')
    
    <script type="text/javascript">
        window.onload = function() {
            document.body.classList.add('is-loaded');
        };
        
        var x = document.getElementById('error_alert');
        var y = document.getElementById('close_alert');
        y.onclick = function() {
            x.style.display = "none";
        };
    </script>
    
</body>
</html>
