<?php
#Connection file
include "conn.php";

if (isset($_POST['submit'])) {
    #echo  "<p>Post submited. password:</p>";
    #var_dump($_POST["password"]);
    #echo "<p>email:</p>";
    #var_dump($_POST['email']);

    $title = $_POST['title'];
    $content = htmlspecialchars($_POST['content']);

    $sql = "INSERT INTO bugs (`title`, `content`) VALUES (:title, :content)";
    $statement = $connection->prepare($sql);
    $statement->execute(['title' => $title, 'content' => $content]);
}
$sql = "SELECT * FROM bugs ORDER BY id DESC";
$st = $connection->prepare($sql);
$st->execute();
$bugs = $st->fetchALL();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Puff.io Bugs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include "nav.php" ?>
        <h1>Puff.io Bugs</h1>
        <div class="row">
            <div class="col">
                <img width="100" height="100" src="bug_img.png" alt="bug image">
                <h6 style="font-size: 8px">From Flaticon</h6>
            </div>
            <div class="col">
                <img src="puff.png" alt="A circle with two lines for eyes">
                <h6 style="font-size: 8px">From Cosmic Sushi</h6>
            </div>
        </div>

        <div class="bg-warning">
            <p>
                As you might know all programs have bugs. This is Puff.io's way of minimizing them!
                But we need YOUR help. When you play Puff.io please report any problems you have. We'll try to fix them!
        </div>
        </p>
        <h1 class="ml-5">Submit a bug</h1>
        <div class="row shadow pb-3 border border-success">
            <div class="col">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="title">Enter the Title of Your Bug</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" required name="title">
                    </div>
                    <div class="form-group">
                        <label for="content">Content of Your Bug</label>
                        <textarea class="form-control" id="content" placeholder="Content" rows="5" required name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

        </div>

        <br>
        <hr>

        <details>
            <summary>Show error reports</summary>
            <div class="row">
                <div class="col">
                    <p><b>Title</b></p>
                </div>
                <div class="col">
                    <p><b>Content</b></p>
                </div>
                <div class="col">
                    <p><b>Resolved</b></p>
                </div>
            </div>
            <?php
            if ($bugs && $st->rowCount() > 0) {
                foreach ($bugs as $bug) { ?>
                    <div class="row">
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
                    </div>
                <?php
            }
        }
        ?>
        </details>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>