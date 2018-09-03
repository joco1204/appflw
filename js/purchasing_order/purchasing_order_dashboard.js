

//$(function(){
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
		var PieData = [];
		var obj = {};
		var ff=1;
		$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'grafico1',
		},
		dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				$.each(data, function(i, row){
					
					PieData.push({
						value: row.cnt, 
						color:  '#CDC',
						highlight: '#CCC' ,
						label: row.po_number
					});
					ff=0;
				});
				dol();
			} else {
				console.log('Error: '+result.msg);
			}
		});
		
		function dol(){
		
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        /*var PieData        = [
          {
            value    :10,
            color    : '#f56954',
            highlight: '#f56954',
            label    : '33126'
          },
          {
            value    : 10,
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Complete'
          },
		  {
            value    : 20,
            color    : '#cccca',
            highlight: '#cccca',
            label    : 'Complete'
          },
		  {
            value    : 3,
            color    : '#cca65a',
            highlight: '#cca65a',
            label    : 'Complete'
          }
        ]*/
        var pieOptions     = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke    : true,
          //String - The colour of each segment stroke
          segmentStrokeColor   : '#fff',
          //Number - The width of each segment stroke
          segmentStrokeWidth   : 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps       : 100,
          //String - Animation easing effect
          animationEasing      : 'easeOutBounce',
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate        : true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale         : false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive           : true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio  : true,
          //String - A legend template
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)
		}
   // });
    $(function(){
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
          {
            value    : 1,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Incomplete'
          },
          {
            value    : 3,
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Complete'
          }
        ]
        var pieOptions     = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke    : true,
          //String - The colour of each segment stroke
          segmentStrokeColor   : '#fff',
          //Number - The width of each segment stroke
          segmentStrokeWidth   : 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps       : 100,
          //String - Animation easing effect
          animationEasing      : 'easeOutBounce',
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate        : true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale         : false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive           : true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio  : true,
          //String - A legend template
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)
    });
     $(function(){
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart3').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
          {
            value    : 4,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Incomplete'
          },
          {
            value    : 1,
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Complete'
          }
        ]
        var pieOptions     = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke    : true,
          //String - The colour of each segment stroke
          segmentStrokeColor   : '#fff',
          //Number - The width of each segment stroke
          segmentStrokeWidth   : 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps       : 100,
          //String - Animation easing effect
          animationEasing      : 'easeOutBounce',
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate        : true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale         : false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive           : true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio  : true,
          //String - A legend template
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)
    });