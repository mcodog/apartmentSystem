<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0; /* Reset default margin */
        }

        body {
            position: relative; /* Ensure proper stacking order */
            background-image: url('{{ asset('images/background1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3); /* Adjust opacity here */
    z-index: -1; /* Place behind the content */
}

        #app {
            flex: 1;
        }
        footer {
            flex-shrink: 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.programs {
    /* border:1px solid red; */
    width:100%;
    height:fit-content;

    display:flex;
    gap:10px;
    padding: 10px;

    flex-direction: column;

}

.programs a{
    text-decoration: none;
}

.program-item {
    height: 200px;
    width: 100%;
    /* border:1px solid red; */

    border-radius: 10px;
    display:flex;
    flex-direction: column-reverse;

    padding:10px;
    padding-left:20px;
    color:white;

    /* border: 1px solid black; */

    background-color:rgb(13, 13, 13);
}

.program-item div{
    width:100%;
    height:30px;
    text-decoration:none;
    /* border:1px solid blue; */
}

.program-item .program-description{
    color:gray;
}

.navbar-dark .nav-item > .nav-link.active  {
    color:white;
}




</style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div id="app">
        <div class="nav" style="position:fixed;">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px;height:100vh;z-index:100;">
            <a href="/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Dacumos</span>
            </a>
            <hr>
            <ul id="navLinks" class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/home" class="nav-link text-white" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    <i class="bi bi-house-door"></i>
                    Home
                    </a>
                </li>
                <li>
                    <a href="/tenants/" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    <i class="bi bi-person-rolodex"></i>
                    Tenant
                    </a>
                </li>
                <li>
                    <a href="/electricity" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    <i class="bi bi-lightning-charge"></i>
                    Electricity
                    </a>
                </li>
                <li>
                    <a href="/water" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    <i class="bi bi-droplet-half"></i>
                    Water
                    </a>
                </li>
                <li>
                    <a href="/analytics" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    <i class="bi bi-clipboard-data"></i>
                    Analytics
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://i.imgur.com/eaRTAQK.jpeg" alt="profile" width="32" height="32" class="rounded-circle me-2">
                    <strong>
                    {{ Auth::user()->name }}

                    </strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </ul>
            </div>
        </div>
    </div>

    <script>
    // JavaScript to handle click event on navigation links
    document.addEventListener("DOMContentLoaded", function() {
        var navLinks = document.querySelectorAll("#navLinks .nav-link");
        navLinks.forEach(function(link) {
            link.addEventListener("click", function() {
                navLinks.forEach(function(navLink) {
                    navLink.classList.remove("active");
                });
                this.classList.add("active");
            });
        });
    });
</script>

    <main class="py-4 p-10" style="margin-left:250px; padding:50px;">
        @yield('content')
    </main>
    @stack('scripts')

</body>
</html>
