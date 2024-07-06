<?php
    require('C:\Users\ASUS\Downloads\bhaikanayaxaamp\htdocs\HB\admin\inc\db_config.php');
    require('C:\Users\ASUS\Downloads\bhaikanayaxaamp\htdocs\HB\admin\inc\essentials.php');


    if(isset($_GET['email_confirmation'])){
        $data= filteration($_GET);

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? LIMIT 1",
        [$data['email'],$data['token']],'ss');

        if(mysqli_num_rows($query)==1){
            $fetch = mysqli_fetch_assoc($query);
            if($fetch['is_verified']==1){
                echo "<script>alert('Account Already Verified!')</script>";
            }
            else{
                $update = update("UPDATE `user_cred` SET `is_verified`=? WHERE `id`=?",[1,$fetch['id']],'ii');
                if($update){
                    echo "<script>alert('Account Verified Successfully!')</script>";
                }
                else{
                    echo "<script>alert('Email verification failed!')</script>";

                }
            }
            redirect('index.php');

        }
        else{
            echo "<script>alert('Invalid Link!')</script>";
        }
    }

    
?>