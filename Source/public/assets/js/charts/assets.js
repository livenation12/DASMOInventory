const assetSelect = document.getElementById('assetType');
const assetsChart = document.getElementById('assetsChart');
let chartInstance; // To store the Chart.js instance

const fetchData = async (asset = '') => {
          try {
                    const formData = new FormData();
                    formData.append('filter', asset);
                    const response = await useFetch(`transactions/borrowed_count`, { body: formData, method: 'POST' });
                    if (response.success) {
                              return response.payload;
                    } else {
                              console.error("Failed to fetch data:", response.error);
                              return null;
                    }
          } catch (error) {
                    console.error("Error fetching data:", error);
                    return null;
          }
};

const renderAssetChart = async () => {
          const asset = assetSelect.value;
          const data = await fetchData(asset);

          if (data) {
                    // Extract labels and data for Chart.js
                    const labels = data.map(item => item.monthName);
                    const counts = data.map(item => item.count);

                    const chartData = {
                              labels: labels, // Month names
                              datasets: [{
                                        label: 'Borrowed Count',
                                        data: counts, // Borrowed count values
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                              }]
                    };

                    if (chartInstance) {
                              chartInstance.data = chartData; // Update the data
                              chartInstance.update(); // Re-render the chart
                    } else {
                              chartInstance = new Chart(assetsChart, {
                                        type: 'line', // or any other chart type
                                        data: chartData,
                                        options: {
                                                  scales: {
                                                            y: {
                                                                      beginAtZero: true,
                                                                      ticks: {
                                                                                stepSize: 1
                                                                      }
                                                            }
                                                  }
                                        },

                              });
                    }
          }
};

// Initial chart rendering with all data
renderAssetChart();

// Update the chart on asset type change
assetSelect.addEventListener('change', renderAssetChart);