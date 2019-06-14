<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="../day2/index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../day4/admin.php">Admin</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../day3/php.php">php Guide</a>
    </li>
    <?php
    if (isset($_SESSION["loggedin"])) {?>
    <li class="nav-item">
        <a class="nav-link" href="../day2/logout.php">Logout</a>
    </li>
    <?php }?>
</ul>