<?php
  require_once "config/setup.php";
    session_start();
    include 'comment.inc.php';
?>

<html lang="en-US">
<head>
  <title>Camera</title>
  <link rel="stylesheet" href="camera3.css">
</head>

<body>
<H1>Camagru</H1>
          <a href="logout.php" name='logout'>Logout</a>
          <a href="index.php" name='logout'>BACK</a>

  <div class="camera">
  <form method="POST">
    <video id="video" width="640" height="480" autoplay="true"></video>
    <canvas id="canvas" width="640" height="480"></canvas>
    <input type="hidden" name="image" id="img">
    <canvas id="canvas2" width="640" height="480"></canvas>
    <a><img src="../images/camera_icon.png" alt="capture" id="snap"></a>
    <button type="Submit" class="btn" name="delete">Clear</button>
    <button type="Submit" class="btn" name="save">Upload</button>
  </form>
    <?php

        if (isset($_POST['save']))
        {
          
            $img = $_POST['image'];
            $servername = "localhost";
            $dusername = "root";
            $password = "asdfasdf";
            $dbname = "camagru";
            $name = $_SESSION['username'];
            try
            {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
              
                $str = "INSERT INTO userimage (img,user, likes) VALUES ('$img', '$name', 0)";
                $conn->exec($str);
           
            }
            catch(PDOException $e)
            {
                echo "[INFO] " . $e->getMessage();
            }
          
        }
    ?>
  </div>

  <div id="upload">
    <form action="camera3.php" method="POST" enctype="multipart/form-data">
        <label class="label">Upload a file:</label>
        <input type="file" name="file" class="btn2">
        <input type="submit" name="save" class="btn2" value="Upload">
    </form>

  </div>

   <div class="filter">
    <button onclick="add_filters(0);"><img class="stickers" name="cow" src="cow.png" alt="cow.png"></button>
    <button onclick="add_filters(1);"><img class="stickers" name="bear" src="bear.png" alt="bear.png"></button>
    
  </div>
  <script>
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var canvas2 = document.getElementById('canvas2');
    var context2 = canvas2.getContext('2d');
    var stickers = document.querySelectorAll( '.stickers' );


    console.log(stickers[1]);
    stickers.forEach( function( item ){
        item.onclick = function(){
            console.log( item );
        }
    })

   
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
    {
      navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream)
      {
          video.srcObject = stream;
      });
    }

    var filters = new Array;

    filters[0] = "cow.png";
    filters[1] = "bear.png";
 

    function  add_filters(e)
    {
        var image = new Image();
        image.src = filters[e];
        context.drawImage(image,0,0,640,480);
    }

    
    document.getElementById("snap").addEventListener("click", function() {
      context2.drawImage(video, 0, 0, 640, 480);
        context2.drawImage(canvas, 0, 0, 640, 480);
        document.getElementById("img").value = canvas2.toDataURL();
    });
  </script>
</body>
</html>