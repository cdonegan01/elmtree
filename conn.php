<?php
        $host = "cdonegan01.lampt.eeecs.qub.ac.uk";
        $user = "cdonegan01";
        $pw = "HlXYJ2W1k3FytTkv";
        $db = "cdonegan01";

        $conn = new mysqli($host, $user, $pw, $db);

        if($conn->connect_error) {
          echo $conn->connect_error;
        }
