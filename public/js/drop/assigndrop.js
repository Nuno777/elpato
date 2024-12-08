function filterDrops() {
    var input, filter, select, options, i;
    input = document.getElementById('drop-filter');
    filter = input.value.toUpperCase();
    select = document.getElementById('drop-list');
    options = select.getElementsByTagName('option');

    for (i = 0; i < options.length; i++) {
        if (options[i].text.toUpperCase().indexOf(filter) > -1) {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }
}
