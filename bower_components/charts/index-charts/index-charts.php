<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';?>
<?php include $path.'/query/q-index.php';?>



<script type="text/javascript">
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    var label = <?php echo json_encode($month); ?>;
    var data = <?php echo json_encode($total); ?>;

    // Get context with jQuery - using jQuery's .get() method.
    var accessChartCanvas = $('#accessChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var accessChart = new Chart(accessChartCanvas)

    var accessChartData = {
        labels: label,
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

    var accessChartOptions = {
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
    accessChart.Line(accessChartData, accessChartOptions)


    // -------------
    // - PIE CHART -
    // -------------
    var ddl_label = <?php echo json_encode($ddl_type); ?>;
    var ddl_data = <?php echo json_encode($ddl_total); ?>;

    var pieChartCanvas = $('#ddlTypeChart').get(0).getContext('2d');
    var pieChart = new Chart(pieChartCanvas);

    var datap = [];
    for (var i = 0; i < ddl_data.length; i++) {
        var x = {
            value: ddl_data[i],
            color: 'rgba(' + ((100 / ddl_data.length) * i) + ',' + (255 / ddl_data.length) * i + ',' + (
                255 - ((255 / ddl_data.length) * i)) + ',0.8)',
            label: ddl_label[i]
        };
        datap.push(x);
    }

    var PieData = datap;
    var pieOptions = {
        // Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        // String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        // Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        // Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 0, // This is 0 for Pie charts
        // Number - Amount of animation steps
        animationSteps: 100,
        // String - Animation easing effect
        animationEasing: 'easeOutBounce',
        // Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        // Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        // Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        // String - A legend template
        legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        // String - A tooltip template
        tooltipTemplate: '<%=label%>: <%=value %> times'
    };
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    // -----------------
    // - END PIE CHART -
    // -----------------


    var testCanvas = $('#testChart').get(0).getContext('2d');

    var testChart = new Chart(testCanvas);

    var testChartData = {
        labels: label,
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

    // ---------------
    // END OF FUNCTION
    // ---------------
})
</script>