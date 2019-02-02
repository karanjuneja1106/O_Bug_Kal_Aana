<!DOCTYPE html>
<html>
<head>
  <title>
    Login Page for This
  </title>
  <meta charset="utf-8">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container mdl-shadow--2dp">
    <form style="margin-top: 100px">
      <div class="form-group">
        <label for="email"><h4>Username</h4></label>
        <input name="Email" class="form-control" id="email" placeholder="Enter your Username" required="" minlength="2">
      </div>
      <div class="form-group">
        <label for="pwd"><h4>Password:</h4></label>
        <input type="password" name="Password" class="form-control" id="pwd" placeholder="Enter the password" required="" minlength="6">
      </div>

      <div class="form-group col-md4 text-center">
        <button type="submit"  class="btn btn-primary" name="submit" id="login" style="text-align: center;">LOGIN</button>
      </div>

    </form>

    <div class="text-center">
      <a href="register.php" class="btn btn-light" style="background-color: #FFFFFF; color: #000000" role="button">Still Not Registered?</a>
    </div>
  </div>

  <script>
    $('#login').click(function(event){
      event.preventDefault();
      $('#email').checkValidity();
      $('#email').reportValidity();
      $('#pwd').checkValidity();
      $('#pwd').reportValidity();

      var string = {username : $('#email').val(), password : $('#pwd').val()};
      
      var username = $('#email').val();
      var pwd = $('#pwd').val();
      console.log(username);
      console.log(pwd);
      console.log(string);
      // debugger;
    $.ajax({
      type:    "POST",
      url:     "http://172.23.0.57:8000/api/Accounts/loginUser/",
      data:    string,
      headers: {"Access-Control-Allow-Origin": "http://localhost"},
      success: function(data) {
          var code = data["data"];
          if(code == "1"){
            // alert("logged in");
            location.replace("index.php")
          }else{
            alert("Invalid Credentials");
          }
      },
      error:   function(jqXHR, textStatus, errorThrown) {
            alert("Error, status = " + textStatus + ", " +
                  "error thrown: " + errorThrown
            );
      }
    });
    })

    jQuery.fn.checkValidity = function() {
      var el = this[0];
      return el && el.checkValidity();
    };
    jQuery.fn.reportValidity = function() {
        var el = this[0];
        return el && el.reportValidity();
    };
  </script>

</body>
</html>