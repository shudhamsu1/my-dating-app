<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mayalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
            integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet" />

    <!-- include Owl Carousel CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <!--  Load the Places library-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsDbf6HI9VCkiCZaR3udlrz8lslseyC5o&libraries=places"></script>

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>

<body>


<section id="header">
    <div class="container-fluid bar">
        <nav class="navbar navbar-expand-lg sticky-top">
            <a href="#" class="navbar-brand ms-4">Mayalu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form class="d-flex align-items-center ms-auto" action="/login" method="POST">
                    @csrf
                    <div class="form-group me-2">
                        <input name="email" class="form-control" type="email" placeholder="Email" aria-label="Email">
                    </div>
                    <div class="form-group me-2">
                        <input name="password" class="form-control" type="password" placeholder="Password" aria-label="Password">
                    </div>
                    <button class="btn btn-primary me-2" type="submit">Login</button>

                </form>
                <button type="button" class="btn btn-outline-primary mx-1" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>

            </div>
        </nav>
        <!-- Signup Modal -->
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/register">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter address"></textarea>
                            </div> --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Enter your address" autocomplete="off">
                            </div>


                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input name="date_of_birth" type="date" class="form-control" id="dob" pattern="\d{4}-\d{2}-\d{2}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="container-left">
                <p class="text-small">Because you deserve better!</p>
                <h1 class="title">
                    Get noticed for <span class="title-s">who</span> you are,
                    <span class="title-s">not what</span> you look like.
                </h1>
                <p class="text">
                    You’re more than just a photo. You have stories to tell, and
                    passions to share, and things to talk about that are more
                    interesting than the weather. Because you deserve what dating
                    deserves: better.
                </p>

                <div class="stats-container">
                    <div class="stats">
                        <h1 class="stats-title">15k+</h1>
                        <p class="stats-text">Dates and matches made everyday</p>
                    </div>

                    <div class="stats">
                        <h1 class="stats-title stats-title-brown">1,456</h1>
                        <p class="stats-text">New members signup every day</p>
                    </div>

                    <div class="stats">
                        <h1 class="stats-title">1M+</h1>
                        <p class="stats-text">Members from around the world</p>
                    </div>
                </div>
            </div>
            <div class="container-right">
                <img class="couples-img couples-img-desktop" src="{{ Vite::asset('resources/images/couples.png') }}"
                     alt="" />
                <img src="{{ Vite::asset('resources/images/details.png') }}" class="details-img" />
            </div>




        </div>

</section>


@if (session()->has('success'))
    <div class="container container--narrow">
        <div class="alert alert-success text-center">{{session('success')}}</div>
        {{-- this line is being ised to check it session has been created and <success> is being used to display a temp message --}}
    </div>
@endif
@if(session()->has('failure'))
    <div class="container container--narrow">
        <div class="alert alert-danger text-center">
            {{session('failure')}}
        </div>
    </div>

@endif
{{ $slot }}
<!-- footer begins -->

<footer class="bg-light py-3">
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


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- include Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>

{{-- address autocomplet script--}}
<script>
    function initAutocomplete() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        // Set the types of place suggestions to return
        autocomplete.setTypes(['address']);
    }
</script>
<script>
    // Call the initAutocomplete function when the page loads
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>


</body>

</html>





