document.getElementById('type').addEventListener('change', function () {
    const selectedType = this.value;
    const previousType = '{{ old("type") ?? $user->type }}'; // Mantém o valor anterior

    if (selectedType === 'admin') {
        const password = prompt('Enter a password to give this permission!');

        // Envia a senha ao servidor para validação
        fetch('/validate-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ password: password, action: 'type' }),
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Incorrect password, permission denied.');
                    this.value = previousType; // Reverte o valor
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.value = previousType; // Reverte o valor em caso de erro
            });
    }
});

document.getElementById('blocked').addEventListener('change', function () {
    const selectedValue = this.value;
    const previousBlocked = '{{ old("blocked") ?? $user->blocked }}'; // Mantém o valor anterior

    if (selectedValue === '0' || selectedValue === '1') {
        const password = prompt('Enter a password to give this permission!');

        // Envia a senha ao servidor para validação
        fetch('/validate-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ password: password, action: 'blocked' }),
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Incorrect password, permission denied.');
                    this.value = previousBlocked; // Reverte o valor
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.value = previousBlocked; // Reverte o valor em caso de erro
            });
    }
});
