<?php 
    include("../db.php");

        $id = $_GET['wordid'];

        $sql = "DELETE FROM wordlist WHERE ID=$id";

        if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        }
?>