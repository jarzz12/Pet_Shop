{{-- resources/views/layouts/navigation.blade.php --}}
<style>
    .collapse:not(.show){
        display: block;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light fixed-top  shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-paw me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="fw-bold text-dark">PetShop</span>
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a> --}} {{-- Gunakan route yang benar jika sudah dibuat --}}
                {{-- </li> --}}
            </ul>

            <!-- Right Side: Cart & Account -->
            <ul class="navbar-nav">
                @auth
                    <!-- Cart Icon -->
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart fs-5"></i>
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <!-- Dropdown Toggle (Nama User) -->
                        <div class="flex items-center justify-center">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>
                                <span>{{ Auth::user()->name }}</span> {{-- Tampilkan nama --}}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    Logout
                                </button>
                            </form>
                        </div>
                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-box-seam me-2"></i>My Orders</a></li>

                            @if(auth()->user()->role === 'admin')
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i>Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>