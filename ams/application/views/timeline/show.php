<html>
  <head>
    <title>SIMILE | Timeline | Examples | Test Example 2</title>

	<?php echo css("timeline.css"); ?>
    <?php echo js("timeline/timeline-api.js"); ?>
	<!-- <link rel='stylesheet' href='http://www.simile-widgets.org/timeline/examples/styles.css' type='text/css' /> -->
	
    <script type="text/javascript">
        var tl;
        function onLoad() {
            var eventSource = new Timeline.DefaultEventSource();

            var bandInfos = [
			    Timeline.createBandInfo({
					showEventText:  false,
					trackHeight:    0.8, 
			        trackGap:       0.11, 
			        eventSource:    eventSource,
			        width:          "75%",
			        intervalUnit:   Timeline.DateTime.DAY,
			        intervalPixels: 45
			    }),
			    Timeline.createBandInfo({
					showEventText:  false,
			        trackHeight:    0.1, 
			        trackGap:       0.1, 
			        eventSource:    eventSource,
			        width:          "25%",
			        intervalUnit:   Timeline.DateTime.MONTH,
			        intervalPixels: 200
			    })
			  ];
			  bandInfos[1].syncWith = 0;
			  bandInfos[1].highlight = true;
                  
            tl = Timeline.create(document.getElementById("tl"), bandInfos, Timeline.HORIZONTAL);
            // Adding the date to the url stops browser caching of data during testing or if
            // the data source is a dynamic query...
            tl.loadJSON("<?php echo site_url("timeline/get_data/".$kanal_id."/".$product_group_id."/".$position_id); ?>", function(json, url) {
                eventSource.loadJSON(json, url);
            });
        }
        
        var resizeTimerID = null;
        function onResize() {
            if (resizeTimerID == null) {
                resizeTimerID = window.setTimeout(function() {
                    resizeTimerID = null;
                    tl.layout();
                }, 500);
            }
        }
    </script>
  </head>
  <body onload="onLoad();" onresize="onResize();">
  
    <div id="tl" class="timeline-default" style="height: 150px; border: 1px solid #aaa"></div>
	
  </body>
</html>