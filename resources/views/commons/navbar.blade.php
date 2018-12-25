<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">e-cook</a>
        
        <botton type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </botton>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                <li class="nav-item"><a href="#" class="nav-link">ユーザ</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item"><a href="#">マイページ</a></li>
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                    </ul>
                </li>
                @else
                <li>{!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>