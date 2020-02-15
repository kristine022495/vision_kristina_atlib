
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
      <h5 class="card-title">Thesis Tokens</h5>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Token ID</th>
          <th scope="col">Thesis ID</th>
          <th scope="col">Requesting ID</th>
          <th scope="col">Date Requested</th>
          <th scope="col">Purpose</th>
          <th scope="col">Expiration Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($tokens as $token) : ?>
          <tr>
            <td>{{ $token->token }}</td>
            <td>{{ $token->thesis_id }}</td>
            <td>{{ $token->requesting_id }}</td>
            <td>{{ $token->date_requested }}</td>
            <td>{{ $token->purpose }}</td>
            <td>{{ $token->expiration_date }}</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

@endsection
