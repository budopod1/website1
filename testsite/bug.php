<?php
if (isset($_GET['bugid'])) {
    echo "id exists";
    $id=$_GET['bugid'];
    #Get all data data from specific users
    $sql = "SELECT * FROM bugs WHERE id = $id";
    $st = $connection->prepare($sql);
    $st->execute();
    $bug = $st->fetch(PDO::FETCH_ASSOC);
    echo $bug["title"];
}
#else {
#    die();
#}
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
        <h1>Bug <?php ?></h1>
    </div>
</body>
</html>