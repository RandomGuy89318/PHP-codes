<?php
    require '_functions.php';

    if(isset($_POST['createFruit'])) {
        $fruitName = $_POST['fruitName'];
        $fruitQty = $_POST['fruitQty'];
    
        $request = createFruit($fruitName, $fruitQty);

        if($request == true) {
            header("location: index.php?note=added");
        } else {
            header("location: index.php?note=error");
        }
    } else {
        header("location: index.php?note=invalid");
    }
?>