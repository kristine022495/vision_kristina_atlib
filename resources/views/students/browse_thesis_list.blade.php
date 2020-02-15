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
		a:hover {
			text-decoration: none;
		}

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
			height: 200px;
			width: 200px;
			margin-top: 20px;
			margin-left: 20px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
			border-radius: 5px;
			text-align: center;
			display: flex;
			flex-direction: column-reverse;
			padding: 20px;
			background-color: white;
		}

		.edit-form input {
			width: 150px;
			text-align: center;
		}

		.save-button {
			text-align: center;
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

	    .folder-icon {
	    	font-size: 50px;
	    }

        .main {
            margin-left: 0;
            padding: 0px 10px;
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
    
  <div class="card">
    <div class="card-body">
        <div style="text-align:center">
            <h5 class="card-title">All Thesis/Capstone from {{ strtoupper($program) }}</h5>
            </div>
            <table id="mainTable" class="table table-hover">
            <thead>
                <tr>
                <th scope="col" onclick="sortTable(0)">Title</th>
                <th scope="col" onclick="sortTable(1)">School Year</th>
                <th scope="col" onclick="sortTable(2)">Authors</th>
                <th scope="col">Document ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($file_sets as $file_set) : ?>
                <tr>
                    <td>{{ $file_set->title }}</td>
                    <td>{{ $file_set->school_year }}</td>
                    <td>{{ $file_set->authors }}</td>
                    <td>
                    <a href="/">{{ $file_set->id }}</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
  </div>


  </body>

@section('scripts')
<script type="text/javascript">
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("mainTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</html>
