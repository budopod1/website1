<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP guide</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include "../day2/nav.php" ?>
    <div class="container">
        <h1>My CRUD guide</h1>

        <h3>How to Create (Insert Data)</h3>

        <pre><code>
        &#x3C;?php
if (isset($_POST[&#x27;submit&#x27;])) {
    #echo  &#x22;&#x3C;p&#x3E;Post submited. password:&#x3C;/p&#x3E;&#x22;;
    #var_dump($_POST[&#x22;password&#x22;]);
    #echo &#x22;&#x3C;p&#x3E;email:&#x3C;/p&#x3E;&#x22;;
    #var_dump($_POST[&#x27;email&#x27;]);

    $email = $_POST[&#x27;email&#x27;];
    $password = $_POST[&#x27;password&#x27;];

    include &#x22;conn.php&#x22;;
    $sql = &#x22;INSERT INTO users (email, &#x60;password&#x60;) VALUES (&#x27;$email&#x27;, &#x27;$password&#x27;)&#x22;;
    $connection-&#x3E;exec($sql);

}
?&#x3E;
        </code></pre>


        <h3>How to Read Data</h3>



        <pre><code>
        #Get all data data from users Place this at top of page
$sql = &#x22;SELECT * FROM users&#x22;;
$st = $connection-&#x3E;prepare($sql);
$st-&#x3E;execute();
$users = $st-&#x3E;fetchALL();


#This goes in the body of page where you want it to display

&#x3C;?php
    if ($users &#x26;&#x26; $st-&#x3E;rowCount() &#x3E; 0) {
        foreach ($users as $user) { ?&#x3E;
            &#x3C;div class=&#x22;row&#x22;&#x3E;
                &#x3C;div class=&#x22;col&#x22;&#x3E;
                    &#x3C;?php
                    echo $user[&#x27;email&#x27;]
                    ?&#x3E;
                &#x3C;/div&#x3E;
                &#x3C;div class=&#x22;col&#x22;&#x3E;
                    &#x3C;?php
                    echo $user[&#x27;password&#x27;]
                    ?&#x3E;
                &#x3C;/div&#x3E;
            &#x3C;/div&#x3E;
        &#x3C;?php
    }
}
?&#x3E;
        </code></pre>
        <h3>How to update data</h3>
        <pre><code>
            Grab data from data base
            #Check for user id in the address bar
    if (isset($_GET[&#x27;id&#x27;])) {
        $id=$_GET[&#x27;id&#x27;];
        #Get all data data from specific users
        $sql = &#x22;SELECT * FROM users WHERE id = $id&#x22;;
        $st = $connection-&#x3E;prepare($sql);
        $st-&#x3E;execute();
        $user = $st-&#x3E;fetch(PDO::FETCH_ASSOC);
    }

    Show data in your form
    &#x3C;form action=&#x22;&#x22; method=&#x22;POST&#x22;&#x3E;
        &#x3C;div class=&#x22;form-group&#x22;&#x3E;
            &#x3C;label for=&#x22;exampleInputEmail1&#x22;&#x3E;Email address&#x3C;/label&#x3E;
            &#x3C;input value=&#x22;&#x3C;?php echo $user[&#x22;email&#x22;] ?&#x3E;&#x22; type=&#x22;email&#x22; class=&#x22;form-control&#x22; id=&#x22;exampleInputEmail1&#x22; aria-describedby=&#x22;emailHelp&#x22; placeholder=&#x22;Enter email&#x22; name=&#x22;email&#x22;&#x3E;
            &#x3C;small id=&#x22;emailHelp&#x22; class=&#x22;form-text text-muted&#x22;&#x3E;We&#x27;ll never share your email with anyone else.&#x3C;/small&#x3E;
        &#x3C;/div&#x3E;
        &#x3C;div class=&#x22;form-group&#x22;&#x3E;
            &#x3C;label for=&#x22;exampleInputPassword1&#x22;&#x3E;Password&#x3C;/label&#x3E;
            &#x3C;input value=&#x22;&#x3C;?php echo $user[&#x22;password&#x22;] ?&#x3E;&#x22; type=&#x22;password&#x22; class=&#x22;form-control&#x22; id=&#x22;exampleInputPassword1&#x22; placeholder=&#x22;Password&#x22; name=&#x22;password&#x22;&#x3E;
        &#x3C;/div&#x3E;
        &#x3C;input type=&#x22;hidden&#x22; name=&#x22;id&#x22; value=&#x22;&#x3C;?php echo $user[&#x22;id&#x22;] ?&#x3E;&#x22;&#x3E;
        
        Handle updating data when form is submitted
        #Include connection to data base file
    include &#x22;./conn.php&#x22;;
    #Check if user has submitted form
    if (isset($_POST[&#x27;submit&#x27;])) {
        #echo  &#x22;&#x3C;p&#x3E;Post submitted. password:&#x3C;/p&#x3E;&#x22;;
        #var_dump($_POST[&#x22;password&#x22;]);
        #echo &#x22;&#x3C;p&#x3E;email:&#x3C;/p&#x3E;&#x22;;
        #var_dump($_POST[&#x27;email&#x27;]);

        $email = $_POST[&#x27;email&#x27;];
        $password = $_POST[&#x27;password&#x27;];
        $id= $_POST[&#x27;id&#x27;];

        #Update data in data base
        $sql = &#x22;UPDATE users SET email= &#x27;$email&#x27;, &#x60;password&#x60;=&#x27;$password&#x27; WHERE id=$id&#x22;;
        $connection-&#x3E;exec($sql);
    }
    </code></pre>
    <h3>How to Delete data from a data base</h3>
    <code><pre>
        Place at top of page
    #Handle deleting account
    if (isset($_POST[&#x27;delete&#x27;])) {
        $id= $_POST[&#x27;id&#x27;];
        $sql=&#x22;DELETE FROM users WHERE id = $id&#x22;;
        #Delete the data in data base
        $connection-&#x3E;exec($sql);
        header(&#x22;Location: ./index.php&#x22;);
        die();
    }

    Deleting data form

    &#x3C;form action=&#x22;&#x22; method=&#x22;POST&#x22;&#x3E;
            &#x3C;input type=&#x22;hidden&#x22; name=&#x22;id&#x22; value=&#x22;&#x3C;?php echo $user[&#x22;id&#x22;] ?&#x3E;&#x22;&#x3E;
            &#x3C;button type=&#x22;submit&#x22; class=&#x22;btn btn-danger mt-3&#x22; name=&#x22;delete&#x22;&#x3E;Delete&#x3C;/button&#x3E;
        &#x3C;/form&#x3E;
    </pre></code>
    </div>
</body>

</html>