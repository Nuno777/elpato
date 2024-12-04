function resetPassword(url, slug) {
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualizar a senha no modal
                document.getElementById(`generatedPassword${slug}`).textContent = data.password;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function requestVerificationCode(slug) {
    fetch(`/send-verification-code/${slug}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#verificationModal' + slug).modal('show');
                document.getElementById('error-message' + slug).style.display = 'none'; // Esconde a mensagem de erro se o código foi enviado com sucesso
            } else {
                document.getElementById('error-message' + slug).innerText = data.message; // Exibe a mensagem de erro
                document.getElementById('error-message' + slug).style.display = 'block'; // Torna a mensagem visível
            }
        })
        .catch(error => console.error('Error:', error));
}

function verifyCode(slug) {
    const code = document.getElementById('verificationCode' + slug).value;

    fetch(`/verify-code/${slug}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            code
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#verificationModal' + slug).modal('hide');
                $('#resetPasswordModal' + slug).modal('show');
                document.getElementById('error-message' + slug).style.display = 'none'; // Esconde a mensagem de erro ao verificar com sucesso
            } else {
                document.getElementById('error-message' + slug).innerText = data.message; // Exibe a mensagem de erro
                document.getElementById('error-message' + slug).style.display = 'block'; // Torna a mensagem visível
            }
        })
        .catch(error => console.error('Error:', error));
}

