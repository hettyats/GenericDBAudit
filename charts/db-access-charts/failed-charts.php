<script type="text/javascript">
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    var name = <?php echo json_encode($name); ?>;
    var data = <?php echo json_encode($total); ?>;

    // Get context with jQuery - using jQuery's .get() method.
    var failedChartCanvas = $('#failedChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var failedChart = new Chart(failedChartCanvas)

    var failedChartData = {
        labels: name,
        datasets: [{
            label: 'Succeed Access',
            fillColor: 'rgba(60,141,188,0.3)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: data,
            spanGaps: true
        }]
    }

    var failedChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        // scaleShowLabels: true,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: true,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        scaleShowValues: true,
    }

    //Create the line chart
    failedChart.Line(failedChartData, failedChartOptions)
})
</script>