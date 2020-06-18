<?php
include "includes/connection.php";
if(isset($_POST['page'])){ 
    // Include pagination library file 
    include_once "Pagination.class.php";
        
    // Set some useful configuration 
    $baseURL = 'sortData.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 5; 
     
    // Set conditions for search 
    $whereSQL = $orderSQL = ''; 
    // if(!empty($_POST['keywords'])){ 
    //     $whereSQL = "WHERE PORDUCT_NAME LIKE '%".$_POST['keywords']."%'"; 
    // } 
    if(!empty($_POST['sortBy'])){ 
        $orderSQL = " ORDER BY PRODUCT_NAME ".$_POST['sortBy']; 
    }else{ 
        $orderSQL = " ORDER BY PRODUCT_NAME DESC "; 
    } 
     
    // Count of all records 
  
    $count_query = "select * from product".$whereSQL.$orderSQL;
    $parse = oci_parse($conn, $count_query);
    $execute = oci_execute($parse);
    $rownum = oci_fetch_all($parse, $res);
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rownum, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'postContent', 
        'link_func' => 'searchFilter' 
    ); 
    $pagination =  new Pagination($pagConfig); 
    
 
    // Fetch records based on the offset and limit 
    $query = "SELECT * FROM product "; 
     
    $parse = oci_parse($conn, $query);
    $execute = oci_execute($parse);
    $result = array();
    $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW );
    

    if($numRows > 0){ 
        foreach($result as $row){
        ?>
            <div class="post-list">
            <?php while($row = oci_fetch_assoc($parse)){ ?>
                <div class="list-item"><a href="#"><?php echo $row["title"]; ?></a></div>
            <?php } ?>
            </div>
            
            <!-- Display pagination links -->
            <?php echo $pagination->createLinks(); ?>
            <?php
        }
    }
   
    else{ 
        echo '<p>Post(s) not found...</p>'; 
    } 
} 