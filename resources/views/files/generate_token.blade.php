@extends('authentication.dashboard')

@section('header')

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>

    .content-fluid {
        text-align: center;
        margin-top: 20px;
    }

    .token-form {
        width: 500px;
        background: white;
        padding: 20px;
        margin: 20px auto;
    }

    .data {
        color: green;
    }
    
  </style>

@endsection


@section('main-content')

  <div class="content-fluid field">
    <h1>Token Generator</h1>
    <small>Generate a token for a thesis to be publicly accessed</small>

    <?php if (isset( $response )) : ?>
        <br><br>
        <div class="response">
            <h2>Success!</h2><br>

            <h4>Token:</h4>
            <p class="data">{{ $response->token }}</p>
            
            <h4>Expiration Date:</h4>
            <p class="data" id="expiration_date_string"></p>

            <h4>Call ID:</h4>
            <p class="data">{{ $response->thesis_id }}</p>

            <h4>Requesting ID:</h4>
            <p class="data">{{ $response->requesting_id }}</p>
        </div>
    <?php else : ?>
        <form action="/files/generate/token" class="token-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Call ID</label>
                <input type="text" class="form-control" id="thesis_id" name="thesis_id" required>
            </div>
            <div class="form-group">
                <label for="username">Days Available</label>
                <input type="text" class="form-control" id="days_available" name="days_available" value="3" required>
            </div>
            <div class="form-group">
                <label for="username">Purpose / Reason</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>
            <div class="form-group">
                <label for="username">Requesting ID</label>
                <input type="text" class="form-control" id="requesting_id" name="requesting_id" required>
            </div>
            <div class="form-group">
                <label for="username" style="text-align: left;">Token ID <br>
                <small>A value has been set automatically. <br>
                        But can be edited manually.</small></label>
                <input type="text" class="form-control" id="token" name="token" style="margin-top:20px;" required>
            </div>
            <input type="submit" class="btn btn-primary active" name="" id="" value="generate">
        </form>
        <div class="thesis-checker">
            <h4>Thesis Preview: </h4>
            <p id="preview_title"></p>
            <p id="preview_college"></p>
            <p id="preview_title"></p>
            <p id="preview_school_year"></p>
        </div>
    <?php endif; ?>

  </div>

@endsection


@section('scripts')
<script type="text/javascript">
    <?php if (isset( $fileset_id )) : ?>
        $('#thesis_id').val({!! $fileset_id !!})
    <?php endif; ?>

    <?php if (isset( $response )) : ?>
        var t = '{!! $response->expiration_date !!}'.split(/[- :]/);
        var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));

        $('#expiration_date_string').text(d);
    <?php endif; ?>

    var rand = function() {
        return Math.random().toString(36).substr(2); // remove `0.`
    };

    $('#token').val(rand());

    $('#thesis_id').on('input', function() {
        $.ajax({
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/check-thesis-record',
            data: {
                thesis_id: $(this).val()
            },
            success: function(data) {
                if (data.has_record == 'true') {
                    $('.thesis-checker').css({
                        'display': 'block'
                    })

                    $('#preview_title').html('TITLE: ' + data['title']);
                    $('#preview_college').html('COLLEGE: ' + data['college']);
                    $('#preview_program').html('PROGRAM ' + data['prgram']);
                    $('#preview_school_year').html('SCHOOL YEAR: ' + data['school_year']);
                } else {
                    $('.thesis-checker').css({
                        'display': 'none'
                    })
                }
            },
            error: function(jqXHR, status, error) {
                console.log(status + '\n' + error);
            }
        });
    })

</script>
@endsection
