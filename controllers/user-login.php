<?php
    if(isset($_POST['submitBtn']))
    {
        $uname = $_POST['username'];
        $pass = $_POST['password'];
    
        $query = "SELECT * FROM users WHERE username=:u_name"; 
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':u_name' => $uname
            )
        );

        $count = $statement->rowCount();
        if($count > 0){
            $result = $statement->fetchAll();
            foreach ($result as $row ) {
                if($pass == $row["password"])
                    {   
                        //check usertype
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['utype'] = $row['type'];
                        header("location:./".$_SESSION['utype']."/index.php");
    
                    }
                else
                    {
                        $_SESSION['errorMessage'] = 'Wrong Credentials';
                    }
            }
        }
        else
         {
          $_SESSION['errorMessage'] = 'Wrong Credentials';
         }
    }

    ?>