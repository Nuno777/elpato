$(document).ready(function () {
    $('#status').change(function () {
        var selectedValue = $(this).val();
        var backgroundColor;
        var textColor;

        switch (selectedValue) {
            case 'Ready':
                backgroundColor = '#82FB6A';
                textColor = 'black';
                break;
            case 'Suspense':
                backgroundColor = '#424945';
                textColor = 'white';
                break;
            case 'Dont send':
                backgroundColor = '#F1DD50';
                textColor = 'black';
                break;
            case 'Problem':
                backgroundColor = '#FF7059';
                textColor = 'white';
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
                backgroundColor = '#82FB6A';
                textColor = 'black';
                break;
            case 'Suspense':
                backgroundColor = '#424945';
                textColor = 'white';
                break;
            case 'Dont send':
                backgroundColor = '#F1DD50';
                textColor = 'black';
                break;
            case 'Problem':
                backgroundColor = '#FF7059';
                textColor = 'white';
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
