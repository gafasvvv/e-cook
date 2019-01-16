<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>e-cook</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon-180x180.png">
    </head>
    
    <body>
        
        @include('commons.navbar')
        
        <div class="container">
            
            @include('commons.error_messages')
            
            @yield('content')
            
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
        
        <script src="{{ secure_asset('/js/app.js') }}"></script>
    </body>
    
    <footer>
        <div class="text-center text-muted">&copy; 2019 e-cook</a>
    </footer>
</html>