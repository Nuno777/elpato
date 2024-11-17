function validateInput(orderId, idDrop) {
    const input = document.getElementById(`deleteInput${orderId}`).value.trim(); // Remove espaços extras
    const button = document.getElementById(`deleteButton${orderId}`);
    const hiddenInput = document.getElementById(`confirmationText${orderId}`);
    const requiredText = `delete-${idDrop}`;

    if (input === requiredText) {
        button.disabled = false;
        hiddenInput.value = input;
    } else {
        button.disabled = true;
        hiddenInput.value = '';
    }
}

function validateRestoreOrderInput(slug, id_drop) {
    const input = document.getElementById('restoreOrderInput' + slug);
    const button = document.getElementById('restoreOrderButton' + slug);
    const confirmationText = document.getElementById('confirmationOrderText' + slug);

    const expectedText = 'restore-' + id_drop;

    if (input.value === expectedText) {
        button.disabled = false;
        confirmationText.value = input.value;
    } else {
        button.disabled = true;
        confirmationText.value = '';
    }
}
