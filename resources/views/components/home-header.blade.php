<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-8">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{__('general.Home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('general.Features')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('general.Pricing')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">{{__('general.About')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
