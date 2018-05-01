    <?php include "includes/db.php"; ?>
    
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

            if(isset($_GET['category'])){
                $post_category_id = $_GET['category'];

                $per_page = 3;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];                
                }
                else{
                    $page = 1;
                }
                if($page==1){
                    $page_1 = 0;
                }
                else{
                    $page_1 = ($page*$per_page) -$per_page;
                }

            

            $post_query_count = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ";
            $find_count= mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count/$per_page);
            if($count < 1){
                echo "<h1 class='text-center'>No posts available</h1>";
            }






           
            
            else{
                 $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ORDER BY post_date DESC, post_id DESC LIMIT $page_1, $per_page";
                 $select_all_posts_query = mysqli_query($connection, $query);


                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 100);

            ?>
              
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                    <img width=200 class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>  


            <?php  } 
                    }  }else{
                        header("Location: index.php");
                    }
            
            
            
            ?>

                 
            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/sidebar.php"; ?>
            
        </div>
        <!-- /.row -->

        <hr>
        <ul class='pager'>
                <?php
                    for($i = 1; $i<=$count; $i++){

                        if($i ==$page ){
                            echo "<li><a class='active_link' href = 'index.php?page={$i}'>${i}</a></li>";
                        }
                        else{
                            echo "<li><a href = 'category.php?category={$post_category_id}&page={$i}'>${i}</a></li>";
                        }
                        
                    }
                ?>
        
        </ul>

    <?php include "includes/footer.php"; ?>