<?php
    include("../db.php");
        $wordtext = $_POST['Word'];
        $wordweight = $_POST['Weight'];
        $wordid= $_POST['wordID'];
        

        $sql = "UPDATE wordlist SET text='$wordtext', weight='$wordweight' WHERE ID=$wordid";

        if ($conn->query($sql) === TRUE) {
            header('Location: ../index.php');
        } else {
        echo "Error updating record: " . $conn->error;
        }
?>