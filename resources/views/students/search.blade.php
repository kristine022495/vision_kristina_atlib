
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
  
  <meta name="csrf-token" content="qpKiKymbIFWJUFElKPbJIw7MIoXAXKnW08a1XZBI">

  <style>

    textarea, input { outline: none; }

    .card {
      box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
      transition: all 0.3s cubic-bezier(.25,.8,.25,1);
      background-color: white;
    }

    .content-fluid {
      padding: 20px;
    }

    .search {
      width: 400px;
    }

    .search-text {
      height: 50px;
      width: 100%;
      padding: 20px 20px;
      font-size: 20px;
    }

    .search-field {
      padding: 20px;
    }

    .result {
      padding: 20px;
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
        margin-top: 100px;
    }
  </style>

  <body>

      <!-- Navigation -->
<!-- <div class="filler" style="height:60px"></div> -->

  <div class="row header-bar z-depth-1 secondary-text-color align-items-center">
    <div class="col">Library Management System</div>
    <div class="col-5"></div>
    <!-- <div class="col-2 text-right">Isaiah</div>
    <a href="/logout" class="btn btn-primary" style="margin-top:6px;color:#ffcdd2">Logout</a> -->
  </div>
      
  <!-- Side navigation -->
  <!-- <div class="sidenav">
    <div style="padding:20px;padding-bottom:0">
      <div class="circle"><i class="material-icons">account_circle</i></div>
      <div style="margin-left:10px">
        <h5 class="card-title">@administrator</h5>
        <h6 class="card-subtitle mb-2 text-muted">Administrator</h6><hr>
      </div>
    </div>
    <ul class="list-group bmd-list-group-sm" style="margin-top:10px;">
      <li class="list-group-item"><h5>File Manager</h5></li>
      <div style="padding-left:15px">
        <a href="/dashboard" class="list-group-item"><i class="material-icons">home</i>Dashboard</a>
        <a href="/files/folders" class="list-group-item"><i class="material-icons">folder_open</i>Browse</a>
        <a href="/files/search" class="list-group-item"><i class="material-icons">search</i>Search</a>
        <a href="/files/upload" class="list-group-item"><i class="material-icons">cloud_upload</i>Upload</a>
        <a href="/files/generate/token" class="list-group-item"><i class="material-icons">vpn_key</i>Generate Token</a>
        <a href="/files/view/tokens/all" class="list-group-item"><i class="material-icons">storage</i>All Tokens</a>
      </div>
    </ul> -->
    <!-- Show Accounts Manager if user is an admin -->
          <!-- <ul class="list-group bmd-list-group-sm" style="margin-top:10px;">
        <li class="list-group-item"><h5>Admin Access</h5></li>
        <div style="padding-left:15px">
          <a href="/accounts/add" class="list-group-item"><i class="material-icons">group_add</i>Add user</a>
          <a href="/accounts/list" class="list-group-item"><i class="material-icons">group</i>Accounts</a>
          <a href="/files/folders/manage" class="list-group-item"><i class="material-icons">folder_shared</i>Manage Folders</a>
        </div>
      </ul>
      </div> -->

  <!-- Page content -->
  <div class="main">
    
  <div class="content-fluid field">
    <div class="row">
      <div class="col">
        <div class="search">
          <h3 style="text-align:center">Search</h3>
                      <input id="searchString" class="card search-text" value="">
                    
        </input><br>
        <button type="submit" id="search" class="btn btn-primary active">Search</button>
          <!-- <div class="card search-field">
            <form>
              <div class="form-group">
                <label for="inputType">Type</label>
                <input type="text" class="form-control" id="inputType">
              </div>
              <div class="form-group">
                <label for="inputSchoolYear">School Year</label>
                <input type="text" class="form-control" id="inputSchoolYear">
              </div>
              <div class="form-group">
                <label for="inputAssociatedID">Associated ID</label>
                <input type="text" class="form-control" id="inputAssociatedID">
              </div>
              <div class="form-group">
                <label for="inputUploader">Uploader</label>
                <input type="text" class="form-control" id="inputUploader">
                <small class="form-text text-muted">Indicate the username for the uploader</small>
              </div>
              <div class="form-group">
                <label for="inputDepartment">Department</label>
                <input type="text" class="form-control" id="inputDepartment">
              </div>
              <button type="submit" id="search" class="btn btn-primary active">Search</button>
            </form>
          </div> -->
        </div>
      </div>
      <div class="col results">
        <h3>Results</h3>
        <!-- <div class="result">
          <h5>Lorem Ipsum Dolor Sit Amet</h5>
          <small>Type: <b>Calendar</b></small>
          <small>School Year: <b>2018-2019</b></small><br>
          <small>Associated ID: <b>391482</b></small>
          <small>Department: <b>CCE</b></small><br>
          <small>Uploader: <b>@administrator</b></small>
          <br><br><button class="btn btn-primary active">View</button>
        </div>
        <div class="result">
          <h5>Lorem Ipsum Dolor Sit Amet</h5>
          <small>Type: <b>Calendar</b></small>
          <small>School Year: <b>2018-2019</b></small><br>
          <small>Associated ID: <b>391482</b></small>
          <small>Department: <b>CCE</b></small><br>
          <small>Uploader: <b>@administrator</b></small>
          <br><br><button class="btn btn-primary active">View</button>
        </div>
        <div class="result">
          <h5>Lorem Ipsum Dolor Sit Amet</h5>
          <small>Type: <b>Calendar</b></small>
          <small>School Year: <b>2018-2019</b></small><br>
          <small>Associated ID: <b>391482</b></small>
          <small>Department: <b>CCE</b></small><br>
          <small>Uploader: <b>@administrator</b></small>
          <br><br><button class="btn btn-primary active">View</button>
        </div> -->
      </div>
    </div>
  </div>

  </div>


  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  <script type="text/javascript">

  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  let wild_search_string = '';
  var search = {};

  function runSearch() {
    getSearchValues();
    $.ajax({
      type: 'POST',
      url: '/files/search',
      data: search,
      success: function(results) {
        displayResults(results.results);
      },
      error: function(jqXHR, status, error) {
        console.log(status + '\n' + error);
      }
    });
  }

  $(this).ready(function() {
    // console.log($('#searchString')[0].value);
    // wild_search_string = $('#searchString')[0].value;

    // if (wild_search_string != '') {
    //   console.log('there is a search');

    // } else {
    //   console.log('there is no search');
    // }
    runSearch();
  });

  $('#search').click(function(e){
    e.preventDefault();
    runSearch();
  });

  function displayResults(results) {
    for (var i = 0; i < results.priority.length; i++) {
      $('.results').append(getResultHMTL(results.priority[i]));
    }
    for (var i = 0; i < results.additional.length; i++) {
      $('.results').append(getResultHMTL(results.additional[i]));
    }
  }

  function getResultHMTL(result) {
    var output = document.createElement('div');
    $(output).addClass('result');
    $(output).append("<h5>" + result.name + "</h5>");
    if (result.type != null) {
      $(output).append("<small>Type: <b>" + result.type + "</b> </small>")
    }
    if (result.school_year != null) {
      $(output).append("<small>School Year: <b>" + result.school_year + "</b> </small><br>")
    }
    if (result.id != null) {
      $(output).append("<small>Call ID: <b>" + result.id + "</b> </small>")
    }
    if (result.department != null) {
      $(output).append("<small>Department: <b>" + result.department + "</b> </small><br>")
    }
    if (result.uploader != null) {
      $(output).append("<small>Uploader: <b>" + result.uploader + "</b> </small><br><br>")
    }
    $(output).append("<a class=\"btn btn-primary active\" href=\"/thesis/retrieve-restricted/" + result.id + "\">View<a/>");
    return output;
  }

  function getSearchValues() {
    var main =          $('#searchString').val();
    var type =          $('#inputType').val();
    var school_year =   $('#inputSchoolYear').val();
    var uploader =      $('#inputUploader').val();
    var department =    $('#inputDepartment').val();
    search = {
      'main': main,
      'type': type,
      'school_year': school_year,
      'uploader': uploader,
      'department': department
    };
  }

</script>
</html>
