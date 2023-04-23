<?php
try {
    if(isset($_POST))
    {
        if($_POST['upload']=='req')
        {
            $conn = new mysqli('localhost', 'root', 'O1!parolarandOm','retea');
            $date = date('Y-m-d H:i:s');
            $username=$_POST['username'];
            $sql = "INSERT INTO requests (date, working, username) VALUES ('".$date."', 0, '".$username."')";
            if ($conn->query($sql) === TRUE) {
                $stmt = $conn->prepare("SELECT `id` FROM `requests` WHERE `date` = ?");
                $stmt->bind_param("s", $date);
                $stmt->execute();
                $result =  $stmt->get_result();
                while($row = $result->fetch_assoc())
                {
                    echo $row["id"];
                }
            $conn->close();
        } 
            else {
                echo "error";
            }
        }
        else if($_POST['upload']=='check')
        {
            $mysqli = new mysqli('localhost', 'root', 'O1!parolarandOm', 'retea');

            $result = $mysqli->query("SELECT `working` FROM `requests` WHERE `id` = 1");
            $row = $result->fetch_assoc();
            $working = $row['working'];

            if ($working < 5) {
                $working++;
                $mysqli->query("UPDATE `requests` SET `working` = $working WHERE `id` = 1");
                echo "liber";
            }

            $mysqli->close();
        }
        else if($_POST['upload']=='resetrequests')
        {
            $mysqli = new mysqli('localhost', 'root', 'O1!parolarandOm', 'retea');

            $result = $mysqli->query("SELECT `working` FROM `requests` WHERE `id` = 1");
            $row = $result->fetch_assoc();
            $working = $row['working'];
            $working--;
            $mysqli->query("UPDATE `requests` SET `working` = $working WHERE `id` = 1");
        }
        else if($_POST['upload']=='forcereset')
        {
            $mysqli = new mysqli('localhost', 'root', 'O1!parolarandOm', 'retea');

            $result = $mysqli->query("SELECT `working` FROM `requests` WHERE `id` = 1");
            $row = $result->fetch_assoc();
            $working = 0;
            $mysqli->query("UPDATE `requests` SET `working` = $working WHERE `id` = 1");
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>