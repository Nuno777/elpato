function validateInput(userId, userName) {
    const input = document.getElementById(`deleteInput${userId}`).value;
    const button = document.getElementById(`deleteButton${userId}`);
    const hiddenInput = document.getElementById(`confirmationText${userId}`);
    const requiredText = `delete-${userName}`;

    if (input === requiredText) {
        button.disabled = false;
        hiddenInput.value = input;
    } else {
        button.disabled = true;
        hiddenInput.value = '';
    }
}
