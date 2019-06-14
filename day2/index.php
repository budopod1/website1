<?php
#Include connection to data base file
include "./conn.php";

if (isset($_POST["img"])) {

    try {
        //HANDLE IMAGE
        if ($_FILES['myimg']['size'] != 0) {
            $folder = "./img/";
            $name = $_FILES['myimg']['name'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newname = time() . "_" . "." . $ext;
            move_uploaded_file($_FILES["myimg"]["tmp_name"], "$folder" . $newname);
            $imgsrc = $folder . $newname;
        } else {
            $imgsrc = "";
        }

        $title = $_POST['title'];

        $sql = "INSERT INTO img (title, img_url) VALUES ('$title', '$imgsrc')";
        $connection->exec($sql);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

#Check if user has submitted form
if (isset($_POST['submit'])) {
    #echo  "<p>Post submitted. password:</p>";
    #var_dump($_POST["password"]);
    #echo "<p>email:</p>";
    #var_dump($_POST['email']);

    $email = $_POST['email'];
    $password = $_POST['password'];

    #Insert data into data base
    $sql = "INSERT INTO users (email, `password`) VALUES ('$email', '$password')";
    $connection->exec($sql);
}

#Get all data data from users
$sql = "SELECT * FROM users";
$st = $connection->prepare($sql);
$st->execute();
$users = $st->fetchALL();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Submit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php include "nav.php" ?>

    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
        </form>
    
        <?php
        if ($users && $st->rowCount() > 0) {
            foreach ($users as $user) { ?>
                <div class="row">
                    <div class="col">
                        <a href="update.php?id=<?php echo $user['i d']; ?>">
                            <?php
                            echo $user['email']
                            ?>
                        </a>
                    </div>
                    <div class="col">
                        <?php
                        echo $user['password']
                        ?>
                    </div>
                </div>
            <?php
        }
    }
    ?>
    
    
        <br>
        <br>
    
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter image title" name="title" required>
                <input type="file" name="myimg" id="myimg" class="form-control" accept=".png,.jpg,.jpeg,.svg" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success" name="img">Upload my Image</button>
        </form>
    </div>



</body>

</html>