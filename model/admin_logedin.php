<?php 
    if ($_SESSION['admin'] != true) {
        header('Location: index.php');
    }

?>