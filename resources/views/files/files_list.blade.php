@extends('authentication.dashboard')

@section('header')
<style>

  .card {
    margin: auto;
    width: fit-content;
    margin-top: 40px;
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
</style>
@endsection

@section('main-content')

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
          <th scope="col" onclick="sortTable(3)">Number of Pages</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($file_sets as $file_set) : ?>
          <tr>
            <td>{{ $file_set->title }}</td>
            <td>{{ $file_set->school_year }}</td>
            <td>{{ $file_set->authors }}</td>
            <td>{{ $file_set->number_of_pages }}</td>
            <td>
              <a href="/files/view/{{ $file_set->id }}">View</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

@endsection

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