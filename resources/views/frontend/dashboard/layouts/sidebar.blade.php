<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="active" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="" href="{{ url('/') }}"><i class="fas fa-home"></i>Go To Home Page</a></li>

        @if (auth()->user()->role === 'vendor')
            <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                        class="fas fa-tachometer"></i>Go to Vendor Dashboard</a></li>
        @endif
        <li><a class="{{ setActive(['user.orders.*']) }}" href="{{ route('user.orders.index') }}"><i
                    class="fas fa-list-ul"></i> Orders</a></li>
        <li><a href="{{ route('user.review.index') }}"><i class="far fa-star"></i> Reviews</a></li>
        <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
        <li><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a href="{{ route('user.address.index') }}"><i class="fal fa-gift-card"></i> Addresses</a></li>
        @if (auth()->user()->role !== 'vendor')
            <li><a class="{{ setActive(['user.vendor-request.*']) }}"
                    href="{{ route('user.vendor-request.index') }}"><i class="far fa-user"></i> Request to be
                    vendor</a></li>
        @endif
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
        <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              this.closest('form').submit();"><i
                    class="far fa-sign-out-alt"></i> Log out</a></li>

        </form>
    </ul>
</div>
