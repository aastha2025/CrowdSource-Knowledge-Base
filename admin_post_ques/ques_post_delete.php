<?php
include "../connection.php";

$id = $_REQUEST['id'];

$sql =" SELECT 'ask' AS type FROM ask_tb WHERE id = ?
    UNION
    SELECT 'post' AS type FROM post_tb WHERE id = ?
    LIMIT 1;

";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id , $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$view = $row['view'];
$view = !$view;

if ($row) {
    $type = $row['type'];

    if($type === 'ask'){
        $sql1 = "UPDATE ask_tb SET view = ? WHERE id = ?";
    }
    else if($type === 'post'){
        $sql1 = "UPDATE post_tb SET view = ? WHERE id = ?";
    }
    else{
        echo "invalid type";
        exit();
    }

    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $id );

    if ($stmt1->execute()) {
        // header("Location: ../../admin_manage_category.php");
        echo ' 
        <script>window.open("../admin.php","_self")</script>
        ';
    } 
    else{
        echo "ERROR: Could not execute deletion.";
    }

}
else {
    echo "NO MATCH RECORD FOUND...";
}

$conn->close();

?>