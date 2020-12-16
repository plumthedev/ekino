<form class="form-inline navbar-search">
    <div class="input-group navbar-search-group">
        <div class="sr-only">
            <label for="navbar-search">
                {{ __('web.views.components.navbar.search.label') }}
            </label>
        </div>
        <input
            class="form-control navbar-search-input"
            id="navbar-search"
            type="text"
            name="search"
            placeholder="{{ __('web.views.components.navbar.search.placeholder') }}"
        >
        <div class="input-group-append">
            <button class="btn btn-outline-secondary navbar-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>
