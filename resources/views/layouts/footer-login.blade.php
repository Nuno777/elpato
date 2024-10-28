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
    
    //eye
    document.querySelector('.toggle-password').addEventListener('click', function () {
        const passwordField = document.querySelector('#password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        // Alternar entre ícone de olho aberto e fechado
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>