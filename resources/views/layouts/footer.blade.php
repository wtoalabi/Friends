      </div>{{--  Closes the #app id  --}}
    </div>  {{--  Closes the Container class  --}}
  </section>{{--  Closes the Section  --}}
</body> {{--  Closes the Body Tag  --}}
<!-- Main JS Entry Point -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Hamburger Script for Bulma -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
</script>

    <!-- Bootstrap -->
{{--  <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>  --}}
@include('sweet::alert')