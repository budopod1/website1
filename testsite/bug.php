<?php
include "conn.php";
if (isset($_GET['bugid'])) {
    $id=$_GET['bugid'];
    #Get all data data from specific bug
    $sql = "SELECT * FROM bugs WHERE id = $id";
    $st = $connection->prepare($sql);
    $st->execute();
    $bug = $st->fetch(PDO::FETCH_ASSOC);
} else {
    #No Content in $_GET
    header("Location: puffBugs.php");
    die();
}
if (isset($_POST["submit"])){
    $edit=$_POST["edit"];

    $prevcontent=$bug["content"];
    $title=$bug["title"];

    $newcontent=$prevcontent." EDIT: ".$edit;

    $sql = "UPDATE bugs SET title = :title, content = :newcontent WHERE id=$id";
    $statement = $connection->prepare($sql);
    $statement->execute(['title' => $title, 'newcontent' => $newcontent]);

    #Update all data data from specific bug
    $sql = "SELECT * FROM bugs WHERE id = $id";
    $st = $connection->prepare($sql);
    $st->execute();
    $bug = $st->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bugs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php include "nav.php"?>
        <h1>Bug <?php echo $bug["title"] ?>:</h1>
        <div class="border border-success"><p><?php echo $bug["content"] ?></p></div>
        <br>
        <h4>Resolved: <?php if ($bug["resolved"] == 0){echo "No";} else {echo "Yes";} ?></h4>
        <hr>
        <h3>Make it more clear!</h3>
        <h4>Edit it!</h4>
        <form action="" method="post">
            <div class="form-group">
                <label for="edit">Put your edit here:</label>
                <input type="text" class="form-control" id="edit" required name="edit">
            </div>
            <button name="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php include "footer.php"; ?>
    </div>
</body>
</html>