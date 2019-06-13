<ul class="nav nav-tabs">
    <li class="nav-item"></li>
        <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="puffBugs.php">Puff.io Bugs</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin</a>
    </li>
    <?php
    if (isset($_SESSION["loggedin"])) {?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php }?>
</ul>