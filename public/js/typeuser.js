// Função para obter a data e hora atual
function getCurrentDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = ('0' + (now.getMonth() + 1)).slice(-2);
    var day = ('0' + now.getDate()).slice(-2);
    var hours = ('0' + now.getHours()).slice(-2);
    var minutes = ('0' + now.getMinutes()).slice(-2);
    var seconds = ('0' + now.getSeconds()).slice(-2);
    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
}

// Atualizar o valor do input com a data e hora atualizada a cada segundo
setInterval(function () {
    document.getElementById('email_verified_at').value = getCurrentDateTime();
}, 1000); // 1000 milissegundos = 1 segundo

/*script do eye */
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    const icon = this.querySelector('i');
    if (type === 'password') {
        icon.classList.remove('mdi-eye');
        icon.classList.add('mdi-eye-off');
    } else {
        icon.classList.remove('mdi-eye-off');
        icon.classList.add('mdi-eye');
    }
});

