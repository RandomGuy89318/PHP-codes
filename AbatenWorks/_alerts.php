<?php  
    //put alerts here

    //get the current page
    $currpage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

    $note = @$_GET['note'];

    if ($note == "error") {
        echo "
            <script>
                toastr.error('Error');
            </script>
        ";
    } else if ($note == "invalid") {
        echo "
            <script>
                toastr.error('Invalid');
            </script>
        ";
    } else {

        // fruits

        if ($currpage == "index") {
            
            if ($note == "added") {
                echo "
                    <script>
                        toastr.success('Fruit Added');
                    </script>
                ";
            } else if ($note == "update") {
                echo "
                    <script>
                        toastr.success('Changes Saved');
                    </script>
                ";
            } else if ($note == "delete") {
                echo "
                    <script>
                        toastr.success('Fruit Removed');
                    </script>
                ";
            } else {
                echo "";
            }

        }
        
    }
?>