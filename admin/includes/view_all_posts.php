<?php
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status= '{$bulk_options}' WHERE post_id= {$postValueId}";
                    $update_to_published = mysqli_query($connection, $query);
                    confirmQuery($update_to_published);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status= '{$bulk_options}' WHERE post_id= {$postValueId}";
                    $update_to_draft = mysqli_query($connection, $query);
                    confirmQuery($update_to_draft);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id= {$postValueId}";
                    $delete_posts = mysqli_query($connection, $query);
                    confirmQuery($delete_posts);
                    break;


            }


        }
    }
?>


<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">

                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>




        <thead>
            
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($_GET['delete'])){

                if(isset($_SESSION['user_role'])){

                    if($_SESSION['user_role'] == 'admin'){

                        $the_post_id =$_GET['delete'];
                        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                        $delete_query = mysqli_query($connection, $query);
                        confirmQuery($delete_query);
                    }

                }

             
            }
        ?>

        <?php
            $query = "SELECT posts.*, categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
            $select_posts= mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                // $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<tr>";
        ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
        <?php
                echo "<td>$post_id</td>";

                echo "<td>$post_user</td>";

                echo "<td>$post_title</td>";

                $comment_count_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $select_comment_number= mysqli_query($connection, $comment_count_query);

                $row = mysqli_fetch_array($select_comment_number);               
                $comment_id = $row['comment_id'];
                $comment_count = mysqli_num_rows($select_comment_number);


                echo "<td>$cat_title</td>";
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='images'></td>";
                echo "<td>$post_tags</td>";
                echo "<td><a href='post_comments.php?id=$post_id'>$comment_count</a></td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
                
        </tbody>
    </table>
</form>


