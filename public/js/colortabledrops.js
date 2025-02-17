$(document).ready(function () {
    $('#status').change(function () {
        var selectedValue = $(this).val();
        var backgroundColor;
        var textColor;

        switch (selectedValue) {
            case 'Ready':
                backgroundColor = '#00CB38';
                textColor = 'black';
                break;
            case 'Suspense':
                backgroundColor = '#515151';
                textColor = 'white';
                break;
            case 'Dont send':
                backgroundColor = '#FFEA51';
                textColor = 'black';
                break;
            case 'Problem':
                backgroundColor = '#FF7760';
                textColor = 'white';
                break;
            case 'Going to die':
                backgroundColor = '#F8ABEE';
                textColor = 'black';
                break;
            default:
                backgroundColor = '#fff'; // Cor padrão
                textColor = 'black'; // Cor padrão
        }

        $(this).css('background-color', backgroundColor);
        $(this).css('color', textColor);
    })
        .change(); // Este gatilho faz com que a função de mudança seja chamada imediatamente após a página ser carregada.
});

$(document).ready(function () {
    $('#updatestatus').change(function () {
        var selectedValue = $(this).val();
        var backgroundColor;
        var textColor;

        switch (selectedValue) {
            case 'Received':
                backgroundColor = '#b491c8';
                textColor = 'black';
                break;
            case 'Sent to buyer':
                backgroundColor = '#ffb74d';
                textColor = 'black';
                break;
            case 'Waiting payment':
                backgroundColor = '#99d18f';
                textColor = 'black';
                break;
            case 'Ready':
                backgroundColor = '#00CB38';
                textColor = 'black';
                break;
            case 'Suspense':
                backgroundColor = '#515151';
                textColor = 'white';
                break;
            case 'Dont send':
                backgroundColor = '#FFEA51';
                textColor = 'black';
                break;
            case 'Problem':
                backgroundColor = '#FF7760';
                textColor = 'white';
                break;
            case 'Going to die':
                backgroundColor = '#F8ABEE';
                textColor = 'black';
                break;
            default:
                backgroundColor = '#fff'; // Cor padrão
                textColor = 'black'; // Cor padrão
        }

        $(this).css('background-color', backgroundColor);
        $(this).css('color', textColor);
    })
        .change(); // Este gatilho faz com que a função de mudança seja chamada imediatamente após a página ser carregada.
});

function validateInput(slug, id_drop) {
    const input = document.getElementById(`deleteInput${slug}`);
    const confirmationText = document.getElementById(`confirmationText${slug}`);
    const deleteButton = document.getElementById(`deleteButton${slug}`);

    if (input.value === `delete-${id_drop}`) {
        confirmationText.value = input.value;
        deleteButton.disabled = false;
    } else {
        deleteButton.disabled = true;
    }
}
