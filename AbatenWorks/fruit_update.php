<?php 
    require '_functions.php';

    //get the fruitId from the url parameter
    $fruitId = $_GET['fruitId'];

    if (isset($_POST['updateFruit'])) {

        $fruitName = $_POST['fruitName'];
        $fruitQty = $_POST['fruitQty'];

        $request = updateFruit($fruitName, $fruitQty, $fruitId);

        if ($request == true) {

            header("location: index.php?note=update");
        } else {
            header("location: index.php?note=error");
        }
    } else {
        header("location: index.php?note=invalid");
    }

?>