<!DOCTYPE html>

<head>
    <title>Camagru</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
            <a class="info" href="index.php" name='logout'>BACK</a>
            <br>
            <a class="info" href="logout.php" name='logout'>Logout</a>

            <?php
                session_start();
        
                $servername = "localhost";
                $username = "root";
                $password = "asdfasdf";
                $dbname = "camagru";
                $DB_DSN='mysql:host=localhost;dbname=camagru';
              
                $user = $_GET['user'];
                try
                {
                    $conn = new PDO($DB_DSN, $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $str = "SELECT * FROM userimage";
                    $res = $conn->query($str);
                    echo '<div class="container">';
                    while ($new = $res->fetch())
                    {
                         $img = "<img src=\"".$new['img']."\">";
                        echo '<div class="img-con">';
                        echo $img;
                            
                            $comment = $_POST['Comment'];
                            
                            $comment = trim($comment,"'");
                            $comment = trim($comment,"<");
                            $comment = trim($comment,">");

                            $comment = trim($comment,"'");
                            $comment = trim($comment,"/");
                            $comment = trim($comment,"\"");
                            $likes = $likes + $_GET['likes'];
                                echo '<form method="post">;
                                <button  name="new">Like</button>
                                <button type="submit" class="btn" name="like">Comment</button>
                                
                                <input class="inp" type="text" name="Comment" required>
                                '.$comment.' 
                                </form>';
                          
                
                            echo random_int(0,15);
                    
                            echo '</div>';
                    }
                }
                catch(PDOException $e)
                {
                    echo "ERROR";
                }


            ?>
</body>