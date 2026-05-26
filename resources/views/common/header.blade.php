<nav class="navbar navbar-expand-lg navbar-custom" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="bi bi-code-square me-1"></i> WebDev
        </a>
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain"
                aria-controls="navbarMain"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="/"
                       @if(request()->is('/')) aria-current="page" @endif>
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('post*') ? 'active' : '' }}"
                       href="/post"
                       @if(request()->is('post*')) aria-current="page" @endif>
                        <i class="bi bi-file-earmark-text me-1"></i> Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}"
                       href="/user"
                       @if(request()->is('user*')) aria-current="page" @endif>
                        <i class="bi bi-people me-1"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('form*') ? 'active' : '' }}"
                       href="/form"
                       @if(request()->is('form*')) aria-current="page" @endif>
                        <i class="bi bi-ui-checks me-1"></i> Form
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
