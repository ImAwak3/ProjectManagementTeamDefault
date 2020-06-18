<?php
include 'includes/connection.php';
$errors = array();
if(isset($_POST['add_product'])){
   
    
    if(!empty($_FILES['image']['name']))
    {	
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                array_push($errors, "The file is not an image. Please uplaod the appropriate image file");
                $uploadOk = 0;
            }

            // Check if file already exists
            if (!file_exists($target_file)) {          

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                    array_push($errors, "Sorry, only JPG, JPEG, PNG files are allowed.");
                }

                // Check if $uploadOk is set to 0 by an error
                   
                        $pName = e($_POST['product_title']);
                        $pDesc = e($_POST['pro_desc']);
                        $pPrice = e($_POST['price']);
                        $min_order = e($_POST['min_order']);
                        $max_order = e($_POST['max_order']);
                        $quantity = e($_POST['item_quantity']);
                        $stock_available = e($_POST['stock_avb']);
                        $allerg_info = e($_POST['alleg_info']);
                        $shop_name = e($_POST['shop_name']);
                        $product_type = e($_POST['product_type']);
                        echo $product_type;
                        $product_image_temp =$_FILES['image']['tmp_name'];
                        $pro_image = $_FILES['image']['name'];

                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        $product_image = "uploads/$pro_image";

                        
                        if(empty($shop_name)){
                            array_push($errors, "Please select your shop Name to which you want to add products");
                        }
                        if(empty($product_type)){
                            array_push($errors, "Please select the category of the product you want to add in your shop");
                        }              

                        $select = "select PRODUCTTYPE_ID from product_type where PRODUCTTYPE_NAME = $product_type";
                        $parse = oci_parse($conn, $select);
                        $execute = oci_execute($parse);
                        while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                            $product_type_id = $row['PRODUCTTYPE_ID'];

                            $query = "insert into product (PRODUCTTYPE_ID, PRODUCT_NAME, DESCRIPTION, PRODUCT_PRICE, QUANTITY_PERITEM, STOCK_AVAILABLE, MIN_ORDER, MAX_ORDER, ALLERGY_INFORMATION, PRODUCTIMAGE_CODE) values($product_type_id,'".$pName."', '".$pDesc."', $pPrice, $quantity, '".$stock_available."', $min_order, $max_order, '".$allerg_info."', '".$product_image."')";
                            $parse = oci_parse($conn, $query);
                            $execute = oci_execute($parse);
        
                       
                        }
                        

         } 
        
            else {
                array_push($errors, "Sorry, file already exists."); 
                $uploadOk = 1;
            }
    }
    

}
else{
    array_push($errors, "Please fill out all the information");
}
function e($val){
    return htmlEntities(trim($val), ENT_QUOTES);
}


function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo '<ul>';
                echo '<li>'.$error .'</li>';
                echo '</ul>';
            }
        echo '</div>';
    }
}	
