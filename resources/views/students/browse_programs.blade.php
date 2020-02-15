<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>Library Management System</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/layout.css">
  <link rel="stylesheet" href="/css/dashboard.css">
  <link rel="stylesheet" href="/css/components.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
  	<style type="text/css">
		.title {
			text-align: center;
			margin-top: 20px;
		}

		.container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			margin: 20px auto;
			width: 700px;
		}

		.folder {
			background-color: white;
			min-height: 50px;
			min-width: 200px;
			border-radius: 5px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
			margin: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 5px 20px 0px 20px;
		}

		a {
			color: #f05545;
			text-decoration: none;
		}

		a:hover {
			color: #f05545;
			text-decoration: none;
		}

		.circle {
		    height: 50px;
		    width: 50px;
		    background-color: #b61827;
		    border-radius: 100%;
		    float: left;
		    margin-right: 10px;
		    display: flex;
		    align-items: center;
		    justify-content: center;
	    }

	    .circle i {
	    	font-size: 63px;
	    }

		.main {
			margin-left: 0;
		}
	</style>
  <body>

      <!-- Navigation -->
<div class="filler" style="height:60px"></div>

  <div class="row header-bar z-depth-1 secondary-text-color align-items-center">
    <div class="col">Library Management System</div>
    <div class="col-5"></div>
    <!-- <div class="col-2 text-right">Isaiah</div> -->
    <!-- <a href="/logout" class="btn btn-primary" style="margin-top:6px;color:#ffcdd2">Logout</a> -->
  </div>
      
  <!-- Side navigation -->

  <!-- Page content -->
  <div class="main">
    
  	<h2 class="title">COLLEGE: {{ strtoupper($folder_id) }}</h2>

	<div class="container">
	@foreach($programs as $program)
		<div class="folder">
			<h4><a href="/thesis/files/program/list/{{ strtolower($folder_id) }}/{{ strtolower($program->program) }}">{{ ucwords($program->program) }}</a></h4>
		</div>
	@endforeach
	</div>

  </div>


  </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</html>
