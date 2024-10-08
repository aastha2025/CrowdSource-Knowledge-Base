<?php
            include "connection.php";
   session_start();
            if (!isset($_SESSION['username'])) {
                die("You must be logged in to view this page.");
            }
            
            $type = isset($_GET['type']) ? $_GET['type'] : '';
        if($type === 'ask'){
                $sql ="SELECT * FROM ask_tb  ORDER BY created_at DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            echo '
            <div class="question-card mb-3">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">' . $row['title'] . '</h5>
                </div>
                <p class="card-text">' . $row['description'] . '</p>';
             
                    echo '<a href="./admin_post_ques/ques_update.php?id=' . $row['id'] . '&type=ask" class="btn btn-warning">Update</a>';
                    if($row['view'] === 1) {
                        echo '<a href="./admin_post_ques/delete.php?id=' . $row['id'] . '&type=ask"  class="btn btn-danger  ">HIDE</a>';
                      }else {
                        echo '<a href="./admin_post_ques/delete.php?id=' . $row['id'] . '&type=ask"  class="btn btn-success ">SHOW</a>';
                      }          
            echo '
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-sm btn-link">Answers</button>
                        <button class="btn btn-sm btn-link">Upvote</button>
                        <button class="btn btn-sm btn-link">Share</button>
                    </div>
                    <small class="text-muted">Posted by ' . $row['username'] . ' - ' . $row['created_at'] . '</small>
                </div>
            </div>';            
        }
    } else {
        echo '<p>No questions found.</p>';
              }

      }      
        else  if($type === 'post'){
            $sql ="SELECT * FROM post_tb  ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        
                echo '
                <div class="question-card mb-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                    </div>
                    <p class="card-text">' . $row['description'] . '</p>';
            
                if ($row['image']) {
                    echo '<img src="./postimage/' . $row['image'] . '" class="card-img-top" alt="Post image" style="width:500px" >';
                }
                  
                    echo '<br><a href="./admin_post_ques/post_update.php?id=' . $row['id'] . '&type=post" class="btn btn-warning">Update</a>';
                    if($row['view'] ===1) {
                        echo '<a href="./admin_post_ques/delete.php?id=' . $row['id'] . '&type=post"  class="btn btn-danger  ">HIDE</a>';
                      }else {
                        echo '<a href="./admin_post_ques/delete.php?id=' . $row['id'] . '&type=post"  class="btn btn-success ">SHOW</a>';
                      }            
                echo '
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-sm btn-link">Comment</button>
                            <button class="btn btn-sm btn-link">Upvote</button>
                            <button class="btn btn-sm btn-link">Share</button>
                        </div>
                        <small class="text-muted">Posted by ' . $row['username'] . ' - ' . $row['created_at'] . '</small>
                    </div>
                </div>';
            }
        }
        else{
            echo '<p>No post found.</p>';

        }
    }
    else {
        echo "Invalid type.";
    }
       $conn->close();
    ?>