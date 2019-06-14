<?php
#Check for session
include "adminsession.php";

#Include connection file
include "conn.php";

if (isset($_POST["submit"])) {
    #Get the id
    $id = $_POST['id'];

    #Update data in data base
    $sql = "UPDATE bugs SET resolved = 1 WHERE id=$id";
    $connection->exec($sql);
}

#Load data from data base
$sql = "SELECT * FROM bugs ORDER BY id DESC";
$st = $connection->prepare($sql);
$st->execute();
$bugs = $st->fetchALL();

#Check if admin has submitted new admin form
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password == $password2) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        #Insert data into data base
        $sql = "INSERT INTO `admin` (username, `password`) VALUES ('$username', '$password')";
        $connection->exec($sql);
    } else {
        $err = "Passwords don't match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include "nav.php" ?>
        <h1>Admin Control Panel</h1>
        <h2>Welcome <?php echo $_SESSION['username'] ?></h1>
            <br>
            <?php if (isset($err)) {
                echo "<h4>" . $err . "</h4>";
            } ?>
            <details class="mb-3">
                <summary>Add new admin</summary>
                <div class="row pt-3">
                    <div class="col"></div>
                    <div class="col border border-success p-3 pl-5 pr-5">
                        <h1>New Admin</h1>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Enter Username:</label>
                                <br>
                                <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Enter Password:</label>
                                <br>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password2">Enter Password (Confirm):</label>
                                <br>
                                <input class="form-control" type="password" name="password2" id="password2" placeholder="Password (Confirm)">
                            </div>
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                        </form>
                    </div>
                    <div class="col"></div>
                </div>
            </details>
            <hr>
            <small>(Resolve button will disappear if already resolved)</small>
            <div class="row mt-3">
                <div class="col">
                    <p><b>Title</b></p>
                </div>
                <div class="col">
                    <p><b>Content</b></p>
                </div>
                <div class="col">
                    <p><b>Resolved</b></p>
                </div>
                <div class="col">
                    <p><b>Resolve</b></p>
                </div>
            </div>
            <?php
            if ($bugs && $st->rowCount() > 0) {
                foreach ($bugs as $bug) { ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php
                            echo "<a href=\"bug.php?bugid=" . $bug['id'] . "\">" . $bug['title'] . "</a>"
                            ?>
                        </div>
                        <div class="col">
                            <?php
                            echo substr($bug['content'], 0, 20) . "...";
                            ?>
                        </div>
                        <div class="col">
                            <?php
                            if ($bug["resolved"] == 0) {
                                echo "No";
                            } else {
                                echo "Yes";
                            }
                            ?>
                        </div>
                        <div class="col">
                            <?php if ($bug["resolved"] == 0) { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $bug["id"] ?>">
                                    <button type="submit" name="submit" class="btn btn-success">Resolve</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                <?php
            }
        }
        ?>
            <?php include "footer.php"; ?>
    </div>
</body>

</html>