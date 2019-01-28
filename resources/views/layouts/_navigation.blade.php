<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="navbar-item">{{ config('app.name') }}</a>

            <a role="button" class="navbar-burger burger" data-target="navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar" class="navbar-menu">
            <div class="navbar-start">

            </div>

            <div class="navbar-end">
                @auth
                    <a role="button" class="navbar-item" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                        Sign out
                    </a>
                    <form id="logout" action="{{ route('logout') }}" method="POST" class="is-hidden">
                        @csrf
                    </form>

                    <a href="{{ route('account.index') }}" class="navbar-item">
                        Your account
                    </a>

                    @role('admin')
                        <a href="{{ route('account.index') }}" class="navbar-item">
                            Admin
                        </a>
                    @endrole
                @else
                    <a href="{{ route('login') }}" class="navbar-item">
                        Sign in
                    </a>

                    <div class="navbar-item">
                        <a href="{{ route('register') }}" class="button">
                            Start selling
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {
          // Add a click event on each of them
          $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {

              // Get the target from the "data-target" attribute
              const target = el.dataset.target;
              const $target = document.getElementById(target);

              // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
              el.classList.toggle('is-active');
              $target.classList.toggle('is-active');

            });
          });
        }
      });
    </script>
@endpush