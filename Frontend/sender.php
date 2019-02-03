<?php
  if (isset($_FILES['image'])) {
    $errors = array();
  
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
  
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
      $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 123456) {
      $errors[] = "the size of the file has been exceeded";
    }

    if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "images/".$file_name);
    }
    else{
      print_r($errors);
    }
  }
?>

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
  
</head>
<body onload="myFunction()">

  <div class="container">
      <form action="" style="margin-top: 100px;" id="form_upload" method="POST" enctype="multipart/form-data"">
        <div class="form-group">
          <input type="file" name="image" id = "files" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="location"><h4>Location</h4></label>
          <p id="location"></p>
        </div>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary" name="submit" id="submit">SUBMIT</button>
        </div>
      </form>
  </div>
  <script type="text/javascript">

    var x = document.getElementById("location");
    function myFunction() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
        alert("Not Hello world");
      }
    }

    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
    }

  </script>

  <script type="text/javascript">
    $('#submit').on('click', function(e) {
      e.preventDefault();
      let files = new FormData();
      let file = $('#files')[0].files[0];
      files.append("garbage_img", file);
      debugger;
      console.log(files, file);
      var obj = {garbage_img:"files", address:"Test Address"};
      console.log(obj);
    $.ajax({
          url: "http://172.23.0.57:8000/api/Garbage/uploadGarbage/",
          type: "POST",
          data: obj,
          headers: {"Access-Control-Allow-Origin": "http://localhost"},
          success: function(){
              alert("file successfully submitted");
          },error: function(){
              alert("okey");
          }
       });
  });
/*
    document.getElementById('files').addEventListener('change', function(e) {
      var file = this.files[0];
      var xhr = new XMLHttpRequest();
      (xhr.upload || xhr).addEventListener('progress', function(e) {
          var done = e.position || e.loaded
          var total = e.totalSize || e.total;
          console.log('xhr progress: ' + Math.round(done/total*100) + '%');
      });
      xhr.addEventListener('load', function(e) {
          console.log('xhr upload complete', e, this.responseText);
      });
      xhr.open('post', 'http://172.23.0.57:8000/api/Garbage/uploadGarbage/', true);
      xhr.send(file);
    });
*/
/*    $("#form_upload").submit(function(e){
        e.preventDefault();

      var garbage_img = new FormData(this);

      console.log(garbage_img);

      
*/
  </script>
</body>
</html>