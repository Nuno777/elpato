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

document.addEventListener('DOMContentLoaded', function () {
    const filterType = document.getElementById('filter-drop-type');
    const dropList = document.getElementById('drop-list');

    filterType.addEventListener('change', function () {
        const selectedType = this.value;

        // Faz uma requisição AJAX para buscar drops filtrados
        fetch(`/panel/dashboard/drops/filter?type=${selectedType}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to fetch drops');
                }
                return response.json();
            })
            .then((data) => {
                // Atualiza a lista de drops com as opções filtradas
                updateDropList(data.drops);
            })
            .catch((error) => {
                console.error('Error fetching drops:', error);
            });
    });

    function updateDropList(drops) {
        // Salva o valor atualmente selecionado
        const selectedValue = dropList.value;

        // Cria um fragmento para construir os elementos fora do DOM principal
        const fragment = document.createDocumentFragment();

        // Adiciona as novas opções ao fragmento
        drops.forEach((drop) => {
            const option = document.createElement('option');
            option.value = drop.slug;
            option.textContent = `${drop.id_drop} (${drop.type})`;
            const style = getDropStatusColor(drop.status);
            option.style.backgroundColor = style.backgroundColor;
            option.style.color = style.color;
            fragment.appendChild(option);
        });

        // Limpa a lista de opções atual e adiciona as novas opções
        dropList.innerHTML = ''; // Remove todas as opções antigas
        dropList.appendChild(fragment); // Insere o fragmento com as novas opções

        // Restaura o valor selecionado, se ele ainda existir na nova lista
        if (selectedValue) {
            const optionToSelect = Array.from(dropList.options).find(
                (option) => option.value === selectedValue
            );
            if (optionToSelect) {
                optionToSelect.selected = true;
            }
        }
    }

    function getDropStatusColor(status) {
        switch (status) {
            case 'Ready':
                return { backgroundColor: '#00cb38', color: 'black' };
            case 'Suspense':
                return { backgroundColor: '#515151', color: 'white' };
            case 'Dont send':
                return { backgroundColor: '#ffea51', color: 'black' };
            case 'Problem':
                return { backgroundColor: '#ff7760', color: 'black' };
            case 'Going to die':
                return { backgroundColor: '#F8ABEE', color: 'black' };
            default:
                return { backgroundColor: 'white', color: 'black' };
        }
    }
});


