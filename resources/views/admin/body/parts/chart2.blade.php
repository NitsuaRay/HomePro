<div class="relative overflow-x-auto sm:rounded-lg mt-5 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between items-start w-full">
        <div class="flex-col items-center">
            <div class="flex items-center mb-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Booking Status</h5>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="py-2" id="bookingPersonnelChart" data-chart-url="{{ route('admin.chart.booking') }}"></div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const getChartOptions = (data) => {
            return {
                series: [{
                    data: data.series
                }],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "bar", // Change the chart type to bar
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                        distributed: true
                    }
                },
                xaxis: {
                    categories: data.labels,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ["#1C64F2", "#2ECC71", "#e17e00", "#1e1e1e"], // Customize colors as needed
                legend: {
                    show: false
                },
                yaxis: {
                    title: {
                        text: "Booking",
                    },
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '1rem', // Adjust the font size of data labels on bars
                    }
                },
            };
        };

        const bookingChartElement = document.getElementById("bookingPersonnelChart");
        const chartDataUrl = bookingChartElement.dataset.chartUrl;

        if (chartDataUrl && typeof ApexCharts !== 'undefined') {
            // Fetch chart data from the server
            fetch(chartDataUrl)
                .then(response => response.json())
                .then(chartData => {
                    // Create and render the chart
                    const chart = new ApexCharts(bookingChartElement, getChartOptions(chartData));
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        }
    });
</script>