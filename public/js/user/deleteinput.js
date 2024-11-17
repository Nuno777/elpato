function validateInput(slug, name) {
    var inputText = document.getElementById('deleteInput' + slug).value;
    var confirmationText = 'delete-' + name;

    if (inputText === confirmationText) {
        document.getElementById('confirmationText' + slug).value = confirmationText;
        document.getElementById('deleteButton' + slug).disabled = false;
    } else {
        document.getElementById('confirmationText' + slug).value = '';
        document.getElementById('deleteButton' + slug).disabled = true;
    }
}

function validateRestoreInput(slug, name) {
    const input = document.getElementById('restoreInput' + slug);
    const button = document.getElementById('restoreButton' + slug);
    const confirmationText = document.getElementById('confirmationText' + slug);

    const expectedText = 'restore-' + name;

    if (input.value === expectedText) {
        button.disabled = false;
        confirmationText.value = input.value;
    } else {
        button.disabled = true;
        confirmationText.value = '';
    }
}
