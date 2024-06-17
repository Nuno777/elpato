// Função para criptografar a senha
function encryptPassword(password) {
    // Esta é uma implementação simplificada para fins de demonstração
    // Você deve usar uma biblioteca de criptografia adequada em uma aplicação real
    var encryptedPassword = btoa(password); // Codifica a senha em base64
    return encryptedPassword;
}

// Criptografa a senha
var encryptedPassword = encryptPassword('!@dmin');

var attempts = 0;
var maxAttempts = 2;

document.getElementById('type').addEventListener('change', function () {
    if (this.value === 'admin') {
        if (attempts >= maxAttempts) {
            alert('Maximum number of effort exceeded!');
            this.value = previousType;
            return;
        }

        var password = prompt('Enter a password to give this permission!');
        var hashedPassword = encryptPassword(password); // Criptografa a senha inserida

        if (hashedPassword !== encryptedPassword) {
            alert('Incorrect password, permission denied.');
            attempts++;
            this.value = previousType;
            return;
        }

        // Se a senha estiver correta, redefina as tentativas
        attempts = 0;
    }
});


var encryptedblock = encryptPassword('!block');

var attempts = 0;
var maxAttempts = 2;
var previousBlocked = '{{ old("blocked") ?? $user->blocked }}'; // Valor inicial do campo blocked

document.getElementById('blocked').addEventListener('change', function () {
    if (this.value === '0' || this.value === '1') { // Verifica se o valor é '0' (Blocked) ou '1' (Unblocked)
        if (attempts >= maxAttempts) {
            alert('Maximum number of effort exceeded!');
            this.value = previousBlocked;
            return;
        }

        var password = prompt('Enter a password to give this permission!');
        var hashedblock = encryptblock(password); // Criptografa a senha inserida

        if (hashedblock !== encryptedblock) {
            alert('Incorrect password, permission denied.');
            attempts++;
            this.value = previousBlocked;
            return;
        }

        // Redefine as tentativas se a senha estiver correta
        attempts = 0;
        previousBlocked = this.value; // Atualiza o valor anterior do campo blocked
    }
});

// Função para criptografar a senha
function encryptblock(password) {
    // Esta é uma implementação simplificada para fins de demonstração
    // Você deve usar uma biblioteca de criptografia adequada em uma aplicação real
    var encryptedblock = btoa(password); // Codifica a senha em base64
    return encryptedblock;
}
