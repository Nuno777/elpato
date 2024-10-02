<script async src="https://www.google.com/recaptcha/api.js"></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/popper.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>

<!-- Loader -->
<div id="loader" style="display: none;">
    <img src="{{ asset('images/loader.gif') }}" alt="Loading...">
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function() {
        document.getElementById('loader').style.display = 'block';
        setTimeout(function() {
            document.getElementById('loader').style.display = 'none';
        }, 20000);
    });
</script>
