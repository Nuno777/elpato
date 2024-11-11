document.addEventListener("DOMContentLoaded", function() {
    // Total Revenue
    const totalRevenue = document.getElementById('totalRevenueChart').dataset.totalRevenue;
    new Chart(document.getElementById('totalRevenueChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Total'],
            datasets: [{
                label: 'Total Revenue',
                data: [totalRevenue],
                backgroundColor: 'rgba(18,135,26, 0.2)',
                borderColor: 'rgba(18,135,26, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Daily Revenue (Last 7 Days)
    const dailyRevenueData = JSON.parse(document.getElementById('dailyRevenueChart').dataset.dailyRevenue);
    const dailyLabels = Object.keys(dailyRevenueData);
    const dailyValues = Object.values(dailyRevenueData);

    new Chart(document.getElementById('dailyRevenueChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Daily Revenue',
                data: dailyValues,
                fill: false,
                backgroundColor: 'rgba(18,135,26, 0.2)',
                borderColor: 'rgba(18,135,26, 1)',
                borderWidth: 2,
                tension: 0.2
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Last 7 Days'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    }
                }
            }
        }
    });

    // Monthly Revenue (Current Year)
    const monthlyRevenueData = JSON.parse(document.getElementById('monthlyRevenueChart').dataset
        .monthlyRevenue);
    const monthlyLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
    ];

    new Chart(document.getElementById('monthlyRevenueChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Revenue',
                data: monthlyRevenueData,
                backgroundColor: 'rgba(18,135,26, 0.2)',
                borderColor: 'rgba(18,135,26, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
