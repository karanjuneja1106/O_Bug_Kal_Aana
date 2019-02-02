<!DOCTYPE html>
<html>
<head>
  <title>
    Register Page
  </title>
  <meta charset="utf-8">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script> -->
</head>
<body>

  <div class="container mdl-shadow--2dp">
    <form style="margin-top: 100px" action="">
      <div class="form-group">
        <label for="fname"><h4>First Name</h4></label>
        <input type="fname" name="Fname" class="form-control" id="fname" placeholder="Enter the First Name" required="">
      </div>

      <div class="form-group">
        <label for="lname"><h4>Last Name</h4></label>
        <input type="lname" name="Lname" class="form-control" id="lname" placeholder="Enter the Last Name" required="">
      </div>

      <div class="form-group">
        <label for="email"><h4>Email Address</h4></label>
        <input type="email" name="Email" class="form-control" id="email" placeholder="Enter your Email Address" required="">
      </div>

      <div class="form-group">
        <label for="username"><h4>UserName</h4></label>
        <input type="username" name="Username" class="form-control" id="username" placeholder="Enter the Your Usernmae" required="">
      </div>

      <div class="form-group">
        <label for="pwd"><h4>Password:</h4></label>
        <input type="password" name="Password" class="form-control" id="pwd" placeholder="Enter the password" required="" minlength="6">
      </div>

      <div class="form-group col-md4 text-center">
        <button type="submit" class="btn btn-primary" name="submit" id="login" style="text-align: center;">REGISTER</button>
      </div>

    </form>

    <div class="text-center">
      <a href="login.php" class="btn btn-light" style="background-color: #FFFFFF; color: #000000" role="button">Already a Member?</a>
    </div>

  </div>

  <script>
    $('#login').click(function(event){
      event.preventDefault();
      $('#fname').checkValidity();
      $('#fname').reportValidity();
      $('#lname').checkValidity();
      $('#lname').reportValidity();
      $('#email').checkValidity();
      $('#email').reportValidity();
      $('#username').checkValidity();
      $('#username').reportValidity();
      $('#pwd').checkValidity();
      $('#pwd').reportValidity();

      var string = {first_name : $('#fname').val(), last_name : $('#lname').val(), email : $('#email').val(), 
                    username : $('#username').val(), password : $('#pwd').val()};

      console.log(string);

    $.ajax({
      type:    "POST",
      url:     "http://172.23.0.57:8000/api/Accounts/createUser/",
      data:    string,
      headers: {"Access-Control-Allow-Origin": "http://localhost"},
      success: function(data) {
          var code = data["data"];
          if(code == "1"){
            location.replace("login.php")
            // alert("successfully registered");
          }else{
            alert("can't successfully registered");
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

<!--     $('#login').click(function(event){
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
      url:     "http://10.42.0.146:8000/api/Accounts/loginUser/",
      // "content-type": 'application/json; charset=utf-8',
      data:    string,
      headers: {"Access-Control-Allow-Origin": "http://localhost"},
      success: function(data) {
          var code = data["data"];
          if(code == "1"){
            alert("logged in");
          }else{
            alert("Invalid Credentials");
          }
      },
      // vvv---- This is the new bit
      error:   function(jqXHR, textStatus, errorThrown) {
            alert("Error, status = " + textStatus + ", " +
                  "error thrown: " + errorThrown
            );
      }
    });
    }) -->
