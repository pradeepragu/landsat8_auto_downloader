<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LandSat Imagery 2015</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="datepicker/css/datepicker.css" rel="stylesheet">

</head>

<body style="background-color:#CEE3F6;">

	<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar" aria-expanded="false"
				aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">LandSat Imagery 2015</a>
		</div>
		<!--/.nav-collapse -->
	</div>
	</nav>

	<div class="container" style="padding: 4%">

		<div class="row">

			<div class="blog-header">
				<div class="col-sm-8 blog-main">

					<h4>L8 OLI/TIRS</h4>
					<div style="background-color:#CEE3F6;">
						<input type="text" class="span2" value="01/10/15"
							data-date-format="mm/dd/yy" id="dp2"> <span class="add-on"><i
							class="glyphicon glyphicon-calendar"></i> </span>
							<p class="text-muted" style="font-size:11;">Please click on the text box to select the date</p>
							<h4><p class="text-danger" id="invalidDateMessage" style="display:none;"> Please select the appropriate date.</p></h4>
					</div>
					
					<div id="eexplorerZip">
						<a class="btn btn-success" href="#" role="button" id="eexplorerZipLink"> Click here to download TAR</a>
						
					</div>
				</div>
			</div>
		</div>
		<br />
		<div class="row">

			<div class="col-sm-10 blog-main">

				<div class="blog-post">
					<h4 class="blog-post-title" id="imageTitle"></h4>
				</div>
				<!-- /.blog-post -->

				<div class="blog-post">
					<img src="" id="eexplorerImage"/>
				</div>
				<!-- /.blog-post -->
			</div>
			<!-- /.blog-sidebar -->

		</div>
		<!-- /.row -->

	</div>

	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
        
		$('#dp2').datepicker();
		$('#invalidDateMessage').hide();
		determineDate();
		
		var checkout = $('#dp2').datepicker({
			  onRender: function(date) {
			  }
			}).on('changeDate', function(date) {
			  determineDate();
			  checkout.hide();
			  
			}).data('datepicker');

		function getSelectedDate(){
			return $('#dp2').val();
		}	

		
		function determineDate(){
			var startDate = new Date('01-10-2015');
			var startDateDay=10;
			var fixedDate=new Date('01-10-2015');
			var fixedDiff=16;
			var selectedDate = new Date(getSelectedDate());
			var intermediateDays=null;

			var timeDiff = Math.abs(selectedDate.getTime() - startDate.getTime());
		    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		    
		    if(diffDays>=fixedDiff){
				var x=parseInt(diffDays/fixedDiff);
				var y=fixedDiff*x;
				startDate.setDate(startDate.getDate() + y);
				intermediateDays=startDateDay+(fixedDiff*x);
				
			}
			
			determineImage(startDate,intermediateDays);
			if((new Date(startDate) - new Date(selectedDate))!=0){
				$('#invalidDateMessage').show();
			}else{
				$('#invalidDateMessage').hide();
			}
			
		}

		function determineImage(computedDate, daysDiff){

			var months = [ "January", "February", "March", "April", "May", "June", 
			               "July", "August", "September", "October", "November", "December" ];
			var formattedDate = new Date(computedDate);
			var month =  formattedDate.getMonth();
			var year = formattedDate.getFullYear();
			var day = formattedDate.getDate();
			var lgString="LGN00";
			var imageBaseUrl="http://earthexplorer.usgs.gov/browse/landsat_8/2015/018/037/LC8018037";
			var tarBaseUrl="http://earthexplorer.usgs.gov/download/4923/LC8018037";
			var hrefText = 	months[ formattedDate.getMonth() ] +" "+ day + " " + year + " Level 1 GeoTiff Data: ";

						
			if(month==1 && day==11){
				lgString="LGN01";
			}
			
			if(daysDiff!=null){
				day = daysDiff;
				
			}

			
			
			var imageParams=year+"0"+day+""+lgString+".jpg";
			var imageUrl=imageBaseUrl+imageParams;

			var tarImageParams = year+"0"+day+""+lgString+"/STANDARD/EE";
			var tarUrl=tarBaseUrl+tarImageParams;

			$("#eexplorerImage").attr("src",imageUrl);
			$('#eexplorerZipLink').attr("href",tarUrl);
			$('#imageTitle').text(hrefText);
			
		}
				
    });	
</script>
</body>
</html>




