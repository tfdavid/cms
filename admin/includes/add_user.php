

<?php
    if(isset($_POST['create_user'])){
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']["tmp_name"];

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        // $post_date = date('d-m-y');

        // move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "INSERT INTO users(user_firstname, user_lastname,
        user_role, user_name, user_email, user_password) ";
        $query.= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_name}',
        '{$user_email}', '{$user_password}') ";  

        $create_user_query = mysqli_query($connection, $query);

        confirmQuery($create_user_query);
       
    }
?>




<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    <div/>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>





    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>        
            <option value="subscriber">Subscriber</option>                
        </select>
     </div>
   
    <!-- <div class="form-group">
        <label for="post_status">User Image</label>
        <input type="file" name="user_image">
    </div> -->
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
     <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="post_content">Email</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div> -->

    <div class="form-group">
        <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
    </div>

</form>