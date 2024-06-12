$(document).ready(function () {
    $('#status').change(function () {
        var selectedValue = $(this).val();
        var backgroundColor;
        var textColor;

        switch (selectedValue) {
            case 'FTID Created':
                backgroundColor = '#85f36e';
                textColor = 'black';
                break;
            case 'FTID Paid':
                backgroundColor = '#bfddf3';
                textColor = 'black';
                break;
            case 'FTID Dropped':
                backgroundColor = '#cf9bcc';
                textColor = 'black';
                break;
            case 'FTID Error':
                backgroundColor = '#ff9e8e';
                textColor = 'black';
                break;
            default:
                backgroundColor = '#fff'; // Cor padrão
                textColor = 'black'; // Cor padrão
        }

        $(this).css('background-color', backgroundColor);
        $(this).css('color', textColor);
    }).change(); // Este gatilho faz com que a função de mudança seja chamada imediatamente após a página ser carregada.
});
