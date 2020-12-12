<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('web.home') }}">
            Navbar
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="web-navbar-nav">
            @include('web.components.navbar.nav')
            @include('web.components.navbar.search')
        </div>
    </div>
</nav>
