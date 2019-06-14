<?php
session_unset();
session_destroy();
header("Location: ../day4/admin.php");
die()
?>