{{--
<!DOCTYPE html>
<html lan="eng">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
            integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous">
    </script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body style="background: linear-gradient(to left bottom, #ddabdc, #d0aae0, #c2a9e4, #b2a8e7, #a0a8e8, #8fadea, #7db1ea, #6db5e8, #62bde4, #60c4dc, #69c9d3, #78cec9);">

<div class="bg-transparent relative flex flex-wrap items-center justify-between  navbar-expand-lg shadow-xl">
    <div class="container mx-auto flex flex-wrap items-center justify-between">
            <div class=" w-full flex justify-between h-20">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <p class="text-white text-5xl px-3  font-bold">Mayalu</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <a href="{{ route('homefeed.show') }}" class="text-white hover:opacity-70 px-3 py-2 rounded-md text-2xl font-bold">Home</a>
                        <a href="/profile/{{auth()->user()->id}}" class="text-white hover:opacity-70 px-3 py-2 rounded-md text-2xl font-bold">Profile</a>
                        <form class="inline pt-3" method="POST" action="/logout">
                            @csrf
                            <button class=" text-white hover:opacity-75 px-3 py-2 rounded-md text-2xl font-bold" type="submit">Logout</button>
                        </form>
                    </div>
                    <div class="flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-laravel focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-laravel focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('homefeed.show') }}" class="text-white hover:opacity-70 px-3 py-2 rounded-md text-2xl font-bold">Home</a>
                <a href="/profile/{{auth()->user()->id}}" class="text-white hover:opacity-70 px-3 py-2 rounded-md text-2xl font-bold">Profile</a>
                <form class="inline pt-3" method="POST" action="/logout">
                    @csrf
                    <button class="text-white hover:opacity-70 px-3 py-2 rounded-md text-2xl font-bold" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
</div>


    {{ $slot }}


<footer class="bg-light py-3 "style="border-radius: 5px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5>About Mayalu</h5>
                <p class="text-muted">Mayalu is a dating website that helps people find their perfect match.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li>Email: info@mayalu.com</li>
                    <li>Phone: +1 555-123-4567</li>
                    <li>Address: 123 Main Street, Sydeny, USA</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
            <p class="mb-0">© 2023 Mayalu. All rights reserved.</p>
        </div>
    </div>
</footer>
</div>

<script>
    $(document).ready(function() {
        $('#animate-me').animate({ fontSize: '3em' }, 1000);
    });
</script>

<script>
    function toggleMobileMenu() {
        var menu = document.getElementById("mobile-menu");
        if (menu.classList.contains("hidden")) {
            menu.classList.remove("hidden");
        } else {
            menu.classList.add("hidden");
        }
    }
</script>
</body>
</html>
--}}
