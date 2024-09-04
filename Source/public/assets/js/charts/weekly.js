const ctx = document.getElementById('weeklyReportChart');
const date = new Date()
const currentMonth = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(date);
const getWeeklyCount = async () => {
    try {
        const { payload } = await useFetch('transactions/weekly_count');
        // Process the data to extract labels and values
        const labels = []
        const counts = []
        payload.forEach(item => {
            labels.push(item.week_label)
            counts.push(item.transaction_count)
        });
        // Create the chart with fetched data
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '# of Transactions for the month of ' + currentMonth,
                    data: counts,
                    borderWidth: 1,
                    backgroundColor: 'rgb(39, 145, 212)',
                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            // Set the step size to ensure whole numbers
                            stepSize: 1
                        }
                    }
                }
            }

        });

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

// Call the function to fetch data and render the chart
getWeeklyCount();
