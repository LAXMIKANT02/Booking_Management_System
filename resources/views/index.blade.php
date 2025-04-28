@extends('layout.baseview')

@section('title','Home')

@section('style')
<style>
.navbar-brand img {
    width: 60px;
}
.navbar-nav {
    align-items: center;
}
.navbar .navbar-nav .nav-link {
    font-size: 1.1em;
    padding: 0.5em 1em;
}
@media screen and (min-width: 768px) {
    .navbar-brand img {
        width: 80px;
    }
    .navbar-brand {
        margin-right: 0;
        padding: 0 1em;
    }
}
</style>
@endsection

@section('content')
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar1">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbar1">
                    <div class="navbar-nav mx-auto text-black">
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="#" class="navbar-brand d-none d-md-block">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Brand Logo">
                        </a>
                        @foreach($pages ?? [] as $page)
                            @if(is_object($page))
                                <a href="{{ url('page/'.$page->slug) }}" class="nav-item nav-link text-black">{{ $page->name }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>

        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://dummyimage.com/1200x500/007bff/ffffff&text=Welcome+to+Our+Platform" class="d-block w-100" alt="Carousel 1" style="max-height: 90vh;">
                </div>
                <div class="carousel-item">
                    <img src="https://dummyimage.com/1200x500/6c757d/ffffff&text=Explore+Our+Services" class="d-block w-100" alt="Carousel 2" style="max-height: 90vh;">
                </div>
                <div class="carousel-item">
                    <img src="https://dummyimage.com/1200x500/28a745/ffffff&text=Book+Your+Appointment" class="d-block w-100" alt="Carousel 3" style="max-height: 90vh;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </header>

    <main class="m-5">
        <!-- About Us Section -->
        <section class="container my-5" id="about-us">
            <h2 class="text-center mb-4">About Us</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="https://dummyimage.com/600x400/cccccc/000&text=About+Us" class="img-fluid" alt="About Us">
                </div>
                <div class="col-md-6">
                    <p class="text-muted">
                        Welcome to our platform where we provide a wide range of services tailored to your needs.
                        We aim to offer the best experience by connecting you with the right professionals
                        and ensuring a smooth and efficient booking process.
                    </p>
                    <p class="text-muted">
                        Our commitment is to quality service, easy access, and full support throughout your journey with us.
                    </p>
                </div>
            </div>
        </section>

        <!-- Booking Form Section -->
        <section class="container my-5" id="booking">
            <h2 class="text-center mb-4">Book a Session</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ url('book.now') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message / Requirements</label>
                                    <textarea class="form-control" name="message" id="message" rows="4" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark">Submit Booking Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="bg-white p-1 mb-3" height="40px">
                    <p>Providing trusted services to our valued customers.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#about-us" class="text-white">About Us</a></li>
                        <li><a href="#booking" class="text-white">Book Now</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-3">
                &copy; {{ date('Y') }} YourCompanyName. All rights reserved.
            </div>
        </div>
    </footer>
</body>
@endsection

@section('customjs')
<script>
// You can add form validations or custom JS here if needed
</script>
@endsection
