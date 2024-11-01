//analytics order
document.addEventListener("DOMContentLoaded", function () {
    // Pegar os valores dos atributos data do canvas
    const ordersChartElement = document.getElementById('ordersChart');
    const activeOrdersCount = parseInt(ordersChartElement.getAttribute('data-active-orders'));
    const restoreOrdersCount = parseInt(ordersChartElement.getAttribute('data-restore-orders'));

    const data = {
        labels: ['Active Orders', 'Restore Orders'],
        datasets: [{
            data: [activeOrdersCount, restoreOrdersCount],
            backgroundColor: ['#59AB5E', 'rgba(255, 99, 132, 0.5)'],
            borderColor: ['#12871A', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'doughnut', // ou 'pie' para uma pizza completa
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right' // Coloca a legenda ao lado direito do gráfico
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    };

    new Chart(ordersChartElement, config);
});


//analytics user
document.addEventListener("DOMContentLoaded", function () {
    // Gráfico de Usuários
    const usersChartElement = document.getElementById('usersChart');
    const activeUsersCount = parseInt(usersChartElement.getAttribute('data-active-users'));
    const inactiveUsersCount = parseInt(usersChartElement.getAttribute('data-inactive-users'));
    const workerCount = parseInt(usersChartElement.getAttribute('data-worker-count'));
    const generalCount = parseInt(usersChartElement.getAttribute('data-general-count'));
    const blockedUsersCount = parseInt(usersChartElement.getAttribute('data-blocked-users'));

    const usersData = {
        labels: [
            'Active Users',
            'Deactivated Users',
            'Worker',
            'General',
            'Users Blocked'
        ],
        datasets: [{
            data: [
                activeUsersCount,
                inactiveUsersCount,
                workerCount,
                generalCount,
                blockedUsersCount
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.5)',   // Azul para usuários ativos
                'rgba(153, 102, 255, 0.5)',  // Roxo para usuários desativados
                'rgba(255, 206, 86, 0.5)',   // Amarelo para "worker"
                'rgba(75, 192, 192, 0.5)',   // Verde-água para "general"
                'rgba(255, 99, 132, 0.5)'    // Vermelho para bloqueados
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    new Chart(usersChartElement, {
        type: 'pie',
        data: usersData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right' // Coloca a legenda ao lado direito do gráfico
                }
            }
        }
    });
});

