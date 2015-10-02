<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>AJAX Postcode Lookup</title>

    <!-- Bootstrap -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


    <style>
    #postcode {
    text-transform: uppercase;
}

::-webkit-input-placeholder {
   text-transform: initial;
}

:-moz-placeholder {
   text-transform: initial;
}

::-moz-placeholder {
   text-transform: initial;
}

:-ms-input-placeholder {
   text-transform: initial;
}

</style>


    <div class="col-sm-6 col-sm-offset-3 well" style="margin-top:50px;">
    <h1>AJAX Postcode Lookup</h1>
    <p>Postcode to address lookup using Google API</p>
      <form action="process.php" method="post" class="ajax">

        <div class="form-group">
          <label>House / Flat / Building number or name</label>
          <input type="text" name="number" class="form-control" placeholder="Number or house name">
        </div>
        <div id="hidden" style="display: none;">
          <div class="form-group">
            <label>Street</label>
            <input id="street" type="text" name="street" class="form-control" placeholder="Street">
          </div>

          <div class="form-group">
            <label>Town</label>
            <input id="town" type="text" name="town" class="form-control" placeholder="Street">
          </div>

          <div class="form-group">
            <label>County</label>
            <input id="county" type="text" name="county" class="form-control" placeholder="Street">
          </div>
        </div>
      <div class="form-group">
        <label>Postcode</label>
        <input id="postcode" type="text" name="postcode" class="form-control" placeholder="Postcode">
      </div>
      <button type="submit" id="submit" name="submit" value="send" class="btn btn-default">Submit</button>
    </form>



  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>

    /* Post data to process sms
    -------------------------------------------------------*/
    $('form.ajax').on('submit', function(){
      $('#submit').prop('disabled', true).html("sending");
        var that = $(this),
          url = that.attr('action'),
          type = that.attr('method'),
          data = {};

        that.find('[name]').each(function(index, value){
          var that = $(this),
          name = that.attr('name'),
          value = that.val();
          data[name] = value;
        });

        $.ajax({
          url: url,
          type: type,
          data: data,

          success: function(data) {
            console.log('success');
            $('#submit').prop('disabled', false).html("Submit");
            var parsed = JSON.parse(data);
            $('#street').val(parsed.street);
            $('#town').val(parsed.town);
            $('#county').val(parsed.county);
            $('#hidden').fadeIn('fast');
          },

          error: function(data) {
            console.log('error');

          },
          complete: function() {
            console.log('complete');
          }
        });

      return false;
    });


    </script>
  </body>
</html>
