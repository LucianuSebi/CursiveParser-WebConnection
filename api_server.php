<?php
// Show all information, defaults to INFO_ALL
try {
    if(isset($_POST))
    {
        $userpassword=$_POST['userpassword'];
        $username=$_POST['username'];
        
        if($_POST['upload']=='upload'){
            //if($_POST['upload']=='upload'){
            //echo "O1!parolarandOm";
            $conn = new mysqli('localhost', 'root', 'O1!parolarandOm','retea');
            


            $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `id` = ?");

            $stmt->bind_param("s", $username);
            
            $stmt->execute();
            $result =  $stmt->get_result();


            if(!$result) {
                echo "parola incorecta";
            } 
            else {
                while($row = $result->fetch_assoc())
                {
                    $gavepass=0;
                    if($row["password"]==$userpassword)
                    {
                        echo "O1!parolarandOm";
                        $gavepass=1;
                    }
                    if($gavepass==0)
                        echo "parola incorecta";
                }
            }
        }

        
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>