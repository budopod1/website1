<?php
    #Include connection to data base file
    include "./conn.php";

    #Handle deleting account
    if (isset($_POST['delete'])) {
        $id= $_POST['id'];
        $sql="DELETE FROM users WHERE id = $id";
        #Delete the data in data base
        $connection->exec($sql);
        header("Location: ./index.php");
        die();
    }

    #Check if user has submitted form
    if (isset($_POST['submit'])) {
        #echo  "<p>Post submitted. password:</p>";
        #var_dump($_POST["password"]);
        #echo "<p>email:</p>";
        #var_dump($_POST['email']);

        $email = $_POST['email'];
        $password = $_POST['password'];
        $id= $_POST['id'];

        #Update data in data base
        $sql = "UPDATE users SET email= '$email', `password`='$password' WHERE id=$id";
        $connection->exec($sql);
    }
    #Check for user id in the address bar
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        #Get all data data from specific users
        $sql = "SELECT * FROM users WHERE id = $id";
        $st = $connection->prepare($sql);
        $st->execute();
        $user = $st->fetch(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update User data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Update user data</h1>
        <h3>You are updating user with email <?php echo $user["email"] ?></h3>
        <form action="" method="POST" class="mb-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input value="<?php echo $user["email"] ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input value="<?php echo $user["password"] ?>" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <input type="hidden" name="id" value="<?php echo $user["id"] ?>">
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
        </form>
        <a href="index.php">back</a>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $user["id"] ?>">
            <button type="submit" class="btn btn-danger mt-3" name="delete">Delete</button>
        </form>
    </div>
</body>
</html>