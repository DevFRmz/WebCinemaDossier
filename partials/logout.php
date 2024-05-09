<?php

session_start();
session_destroy();

header("Location: /cinema_dossier/index.php");
