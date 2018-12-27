<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">e-cook</a>
        
        <botton type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </botton>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <form class="form-inline my-2 my-lg-0 mr-5">
                  <input class="form-control mr-sm-2" type="search" placeholder="料理名・材料名検索" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
                </form>
                @if(Auth::check())
                <li class="nav-item">{!! link_to_route('recipes.create', '新規投稿', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('users.show', 'マイページ', ['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                @else
                <li class="nav-item">{!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>