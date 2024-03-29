<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include "nav.php" ?>
        <div class="row">
            <div class="col text-center">
                <h1>Admin Login</h1>
                <form action="adminlogin.php" method="post">
                    <div class="form-group">
                        <label for="username">Enter Username:</label>
                        <input type="text" name="username" id="username" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Enter Password:</label>
                        <input type="password" name="password" id="password" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>