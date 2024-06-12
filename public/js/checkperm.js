/* document.getElementById('type').addEventListener('change', function () {
    if (this.value === 'admin') {
        var password = prompt('Enter a password to give this permission!');
        if (password !== 'naosei') { // Substitua 'sua_senha_correta' pela senha real
            alert('Incorrect password, permission denied.');
            this.value = previousType; // Revertendo para a opção anterior
        }
    }
}); */

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
