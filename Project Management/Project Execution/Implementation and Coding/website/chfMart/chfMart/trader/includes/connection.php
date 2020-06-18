<?php $conn = oci_connect('example', 'new_workspace', '//localhost/xe'); 

if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; 
} 
   


?>