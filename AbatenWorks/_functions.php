<?php 

    function dbconnection(){

        date_default_timezone_set('Asia/Manila');

        $dbconnection = new PDO('mysql:dbname=crud; host=localhost; charset=utf8mb4', 'root', '');

        $dbconnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbconnection;
    }

    function selectFruits(){
        $statement=dbConnection()->prepare("SELECT * FROM fruit Order By fruit_id ASC"); 
        $statement->execute();
        
        return $statement;
    }

    // create fruits

    function createFruit($fruitName, $fruitQty){
        $statement=dbConnection()->prepare("INSERT INTO 
                                                    fruit      
                                                    (
                                                        fruit_name, 
                                                        fruit_qty, 
                                                        fruit_created, 
                                                        fruit_updated
                                                    ) 
                                                    VALUES 
                                                    (
                                                        :fruit_name, 
                                                        :fruit_qty, 
                                                        NOW(), 
                                                        NOW()
                                                    )");

          // instead putting values directly to a query we use PDO variable as security measures                                          
        $statement->execute([
            'fruit_name' => $fruitName,
            'fruit_qty' => $fruitQty
        ]);

        // confirm if the query is executed properly

        if ($statement){
            return true;
        }else{
            return false;
        }
    }

    // update fruits

    function updateFruit($fruitName, $fruitQty, $fruitId){
        $statement=dbConnection()->prepare("UPDATE 
                                                    fruit 
                                                    SET 
                                                        fruit_name = :fruit_name, 
                                                        fruit_qty = :fruit_qty, 
                                                        fruit_updated = NOW() 
                                                    WHERE 
                                                        fruit_id = :fruit_id");

        $statement->execute([
            'fruit_name' => $fruitName,
            'fruit_qty' => $fruitQty,
            'fruit_id' => $fruitId
        ]);
        
        // confirm if the query is executed properly
        
        if ($statement){
            return true;
        } else{
            return false;
        }

    }

    // delete fruits
    
    function deleteFruit($fruitId){
        $statement=dbConnection()->prepare("DELETE FROM 
                                                    fruit 
                                                    WHERE 
                                                    fruit_id = :fruit_id");
        $statement->execute([
            'fruit_id' => $fruitId
        ]);
        
        // confirm if the query is executed properly
        
        if ($statement){
            return true;
        } else{
            return false;
        }
    }

    //get fruits
    function searchFruits($searchText){

        $statement=dbConnection()->prepare("SELECT 
                                            * 
                                            FROM
                                            fruit
                                            WHERE
                                            fruit_name LIKE
                                            :fruit_name
                                            Order By
                                            fruit_name
                                            ASC");
        $statement->execute([
            'fruit_name' => "%$searchText%"
        ]);     
        return $statement;
    }
    function searchFruitsCount($searchText){

        $statement=dbConnection()->prepare("SELECT 
                                            * 
                                            FROM
                                            fruit
                                            WHERE
                                            fruit_name LIKE :fruit_name
                                            Order By
                                            fruit_name
                                            ASC");
                                            
        $statement->execute([
            'fruit_name' => "%$searchText%"
        ]);

        $count=$statement->rowCount();
        return $count;
    }
?>