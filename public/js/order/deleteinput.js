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
