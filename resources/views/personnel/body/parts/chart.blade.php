<div class="relative overflow-x-auto sm:rounded-lg mt-5 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between items-start w-full">
        <div class="flex justify-between items-center">
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Earnings Today</p>
            <button onclick="downloadChart()"></button>
        </div>
    </div>
    <div id="main-chart"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let dailyEarnings = <?php echo json_encode($dailyEarnings); ?>;

        let categories = [];
        let earningsData = [];

        dailyEarnings.forEach(function(day) {
            categories.push(day.formatted_date); // Use formatted dates as categories
            earningsData.push(parseFloat(day.daily_earnings)); // Convert to a floating-point number
        });

        let options = {
            chart: {
                height: 400,
                type: "bar",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                    show: true, // Display the chart toolbar
                },
            },
            series: [{
                name: "Daily Earnings",
                data: earningsData,
                color: "#1A56DB",
            }],
            xaxis: {
                categories: categories,
                labels: {
                    rotate: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Helvetica, Arial, sans-serif'
                    }
                }
            },
        };

        // Render the chart
        if (document.getElementById("main-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("main-chart"), options);
            chart.render();
        }

        // Function to download the chart as PNG
        function downloadChart() {
            chart.dataURI().then(function(uri) {
                var link = document.createElement('a');
                link.href = uri;
                link.download = 'chart.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
    });
</script>