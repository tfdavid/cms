<?php include "includes/admin_header.php" ?>
<?php
    if(isset($_SESSION['user_id'])){
        $user_session_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = {$user_session_id} ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }
?>
<?php
    if(isset($_POST['edit_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']["tmp_name"];

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password_post = $_POST['user_password'];
        // $post_date = date('d-m-y');

        if(!empty($user_password_post)){
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);
            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 12) );
        }
       

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}',
                user_role = '{$user_role}', user_name = '{$user_name}',
                user_email = '{$user_email}', user_password = '{$user_password}' 
                WHERE user_id = '{$user_session_id}' ";

        $edit_user_query = mysqli_query($connection, $query);
        confirmQuery($edit_user_query);
        if($edit_user_query){
            $_SESSION['username'] = $user_name;
        }
        
    }  
?>



    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php" ?>






        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                              Welcome to Profile
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="user_firstname">Firstname</label>
                                <input type="text" value='<?php echo $user_firstname ?>' class="form-control" name="user_firstname">
                            <div/>
                            <div class="form-group">
                                <label for="user_lastname">Lastname</label>
                                <input type="text" value='<?php echo $user_lastname ?>' class="form-control" name="user_lastname">
                            </div>

                            <div class="form-group">

                                <select name="user_role" id="">

                                     <?php
                                        if($user_role == 'admin'){
                                            echo $user_role;
                                            echo "<option selected value='admin'>admin</option>";
                                            echo "<option value='subscriber'>subscriber</option>"; 
                                        }                                        
                                        else{    
                                            echo "<option selected value='subscriber'>subscriber</option>";  
                                            echo "<option value='admin'>admin</option>"; 
                                        }

                                    ?>              
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" value='<?php echo $user_name ?>' class="form-control" name="user_name">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" value='<?php echo $user_email ?>' class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" name="user_password">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="edit_user" value="Update Profile" class="btn btn-primary">
                            </div>

                        </form>
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>





        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php" ?>