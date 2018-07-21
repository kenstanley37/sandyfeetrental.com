<?php
    include('../init.php');
    include('dbmysqli.php');
    if ($con->connect_errno) {
        printf("Connect failed: %s\n", $con->connect_error);
        exit();
    }
    $sql = file_get_contents(ROOT_DIR.'/inc/reset.sql');

    if ($con->multi_query($sql)) {
    do {
            /* store first result set */
            if ($result = $con->store_result()) {
                while ($row = $result->fetch_row()) {
                    printf("%s\n", $row[0]);
                }
                $result->free();
            }
            /* print divider */
            if ($con->more_results()) {
                printf("-----------------\n");
            } else {
                echo "Complete!";
            }
        } while ($con->next_result());
    } else {
        echo $con->error;
    }
    $con->close();  
?>