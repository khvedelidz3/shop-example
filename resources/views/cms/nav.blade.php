<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/admin">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/products">Products <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/categories">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/orders">Orders</a>
            </li>
        </ul>
        @if(Auth::user())
            <div>
                {{ucfirst(Auth::user()->name)}}
                <form  action="/admin/logout" method="POST">
                    @csrf
                    <input type="submit" value="LogOut">
                </form>
            </div>
        @endif
    </div>
</nav>