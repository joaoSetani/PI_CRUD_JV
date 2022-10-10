<?php

setcookie("login", "", time() - 3600, "/");
header("Location: /piOutubro8/piOutubro8/login.php");
die();
