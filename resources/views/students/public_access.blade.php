<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>UM Library - Thesis Bank</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/layout.css">
  <link rel="stylesheet" href="/css/dashboard.css">
  <link rel="stylesheet" href="/css/components.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
  body, html {
      text-align: center;
      height: 100%;
      width: 100%;
      backdrop-filter: grayscale(.5);
  }

  body {
      background: url(/img/um-bg.jpg);
      backdrop-filter: grayscale(.5);
  }

  .content-container {
      width: 500px;
      /* background-color: #ffffff00;
      backdrop-filter: blur(50px); */
      background: white;
      padding: 20px;
      border-radius: 20px;
      margin: 12% auto;
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  }

  .content-container .form-group {
      width: 300px;
      margin: 20px auto;
  }

  .error {
    color: red;
  }

  h1, h2 {
    color: maroon;
  }
</style>
<body>
  
  <div class="content-container">
    <h1>University of Mindanao</h1>
    <h2>Thesis Bank</h2>
    <a href="/thesis/browse" class="btn active">Browse</a>
    <a href="/thesis/search" class="btn active">Search</a>

    <div class="form">
      <form method="POST" action="/thesis">
        @csrf

        <div class="form-group">
          <label for="username">Token</label>
          <input type="text" class="form-control" name="token" required>
        </div>

        <div class="form-group">
          <label for="username">Requesting ID / Student ID</label>
          <input type="text" class="form-control" name="requesting_id" required>
        </div>

        <div class="form-group">
          <label for="username">Document / Thesis ID</label>
          <input type="text" class="form-control" name="thesis_id" required>
        </div>

        <input type="submit" class="btn btn-primary active" value="retrieve">
      </div>
    </form>
    <?php if (isset($error_response)) : ?>
      <div class="error">{{ $error_response->message }}</div>
    <?php endif; ?>
  </div>

  <script type="text/javascript">
    <?php if (isset($success_redirect)) : ?>
      window.location.href = 'thesis/retrieve/' + {!! $success_redirect->id !!}
    <?php endif; ?>
  </script>
</body>
</html>