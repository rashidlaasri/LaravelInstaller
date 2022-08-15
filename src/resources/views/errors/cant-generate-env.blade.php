<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/installer/img/favicon/favicon-16x16.png') }}"
          sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/installer/img/favicon/favicon-32x32.png') }}"
          sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/installer/img/favicon/favicon-96x96.png') }}"
          sizes="96x96"/>
    <link href="{{ asset('assets/installer/css/style.min.css') }}" rel="stylesheet"/>
</head>
<body>
<div class="master">
    <div class="box">
        <div class="header">
            <h1 class="header__title">Error</h1>
        </div>
        <div class="main">
            <div class="alert alert-danger" id="error_alert">
                <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <strong>
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    Can't generate .env file please, copy manually .env.example to .env file.
                </strong>
            </div>
        </div>
    </div>
</div>
</body>
</html>
