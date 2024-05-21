document.querySelectorAll('.toggle-password').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = this.parentElement.previousElementSibling;
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.querySelector('i').classList.toggle('mdi-eye');
        this.querySelector('i').classList.toggle('mdi-eye-off');
        // Toggle class to control eye icon color
        this.querySelector('i').classList.toggle('password-visible');
    });
});

