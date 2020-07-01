<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';?>
<?php include $path.'/query/database-access-query/q-failed.php';?>

<script>
$(function() {

    $error = array();
    $total = array();

    while ($row = $Failed->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($error, $row['Message']);
    }
    
    var name = <?php echo json_encode($error); ?>;
    var total = <?php echo json_encode($total); ?>;

    var FailedAccessData = {
        labels: name,
        datasets: [{
            label: 'Electronics',
            fillColor: 'rgba(210, 214, 222, 1)',
            strokeColor: 'rgba(210, 214, 222, 1)',
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: total
        }]
    }

    var failedChartCanvas = $('#failedChart').get(0).getContext('2d')
    var failedChart = new Chart(failedChartCanvas)
    var failedChartData = FailedAccessData

    failedChartData.datasets[0].fillColor = 'rgba(60,141,188,0.9)'
    failedChartData.datasets[0].strokeColor = 'rgba(60,141,188,0.8)'
    failedChartData.datasets[0].pointColor = '#3b8bba'

    var failedChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
    } 

    failedChartOptions.datasetFill = false
    failedChart.Bar(failedChartData, failedChartOptions)
})
</script>