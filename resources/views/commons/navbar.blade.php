<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-warning border-bottom">
        <a class="navbar-brand font-weight-bold" href="/">e-cook</a>
        
        <botton type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </botton>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                <li class="nav-item">{!! link_to_route('users.show', 'マイページ', ['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('recipes.create', '新規投稿', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('favoriteranking.index', 'ランキング', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('search.index', '検索ページ', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                @else
                <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>