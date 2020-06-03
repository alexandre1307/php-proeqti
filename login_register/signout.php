<?php
session_start();
session_unset();
header("Location: /market/public/index.php");