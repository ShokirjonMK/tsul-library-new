<div>
    <div class="row">
        <div class="col-xl-12 col-sm-12 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div id="chartUserRoles"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div id="chart"></div>
            </div>
        </div>
    </div>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        var roleTitle = "<?= __('Users by Role') ?>";
        var numberOfUsers = "<?= __('Number of Users') ?>";
        var users = "<?= __('Users') ?>";

        var options = {
            series: [{
                name: users,
                data: @json($data) // Dynamic data from PHP
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        position: 'top', // Show labels on top of bars
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: @json($categories), // Dynamic categories
                position: 'bottom',
            },
            yaxis: {
                title: {
                    text: numberOfUsers
                }
            },
            title: {
                text: roleTitle,
                align: 'center'
            }
        };

        var chartUserRoles = new ApexCharts(document.querySelector("#chartUserRoles"), options);
        chartUserRoles.render();
        console.log(@json($genderName))
        var options = {
            series: @json($genderData),
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: @json($genderName),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });


</script>
