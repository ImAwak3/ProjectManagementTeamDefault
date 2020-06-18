<!-- include the header and the menu section -->
<?php
    include 'includes/connection.php';
        include "includes/header.php";
    include "includes/navigation.php"; 

    global $page, $page_total_page;
?>


    
    <section id="search-banner">
		<div class="jumbotron">
			<h3 class = "text-center pb-4">Search Results</h3>

			<div class = "col-lg-12 col-md-12 col-sm-12">
				<div class="form-search">			
					<!-- search box -->
					<form method = "get" action="search.php">		
						<input type="text" placeholder = "Search store by product or shop name" name = "search_products" class = "search">
						<button type="submit" class = "search-btn"  name = "submit"><i class="fa fa-search"></i>
					</form>
				</div>	<!--.form-search-->
			</div><!--col-->
		</div><!--jumbotron-->
	</section><!--search-banner-->
   

    <section id="search-results">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div class="product-items">
						<div class="row items">
							<?php						
								if(isset($_GET['submit'])){
								
										if(isset($_GET['page'])){
											$page = $_GET['page'];
											
										}
										else{
											$page=1;
												
										}
										
										$search = htmlentities($_GET['search_products'], ENT_QUOTES);	
											$results_per_page = 12;
											$start_from = ($page-1)*$results_per_page;

											$name_query = "SELECT * FROM product, product_type WHERE 
											product.PRODUCTTYPE_ID = product_type.PRODUCTTYPE_ID AND lower(PRODUCT_NAME) LIKE '%$search%' AND ROWNUM<=$start_from".$results_per_page;
											$name_parse = oci_parse($conn, $name_query);
											$execute = oci_execute($name_parse);
											$res = array();

											$numNameRows = oci_fetch_all($name_parse, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW );	
																		
											$query = "SELECT * FROM product, product_type WHERE 
											product.PRODUCTTYPE_ID = product_type.PRODUCTTYPE_ID AND lower(PRODUCTTYPE_NAME) LIKE '%$search%' AND ROWNUM<=$start_from".$results_per_page;
											$parse = oci_parse($conn, $query);
											$search_execute = oci_execute($parse);

											$result = array();
											$numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW );

											if($numRows > 0){ 
												foreach($result as $row){
													$pID = $row['PRODUCT_ID'];
													$pName= $row['PRODUCT_NAME'];
													$pCat = $row['PRODUCTTYPE_NAME'];
													$pPrice = $row['PRODUCT_PRICE'];
													$pImage = $row['PRODUCTIMAGE_CODE'];
													?>
													<div class = "col-lg-4">
													<div class="product-item">
														<div class="pi-pic">
															<img src="img/products/<?php echo $pImage;?>" alt="">
														
														</div>
														<div class="pi-text">
															<div class="catagory-name"><?php echo $pCat;?></div>
															<a href="#">
																<h5><?php echo $pName;?></h5>
															</a>
															<div class="product-price"><?php echo $pPrice;?></div>
														</div>
													</div>
													</div><!--col-->
													<?php
												}
											}	

											elseif($numNameRows>0){
												foreach($res as $row){
													$pID = $row['PRODUCT_ID'];
													$pName= $row['PRODUCT_NAME'];
													$pCat = $row['PRODUCTTYPE_NAME'];
													$pPrice = $row['PRODUCT_PRICE'];
													$pImage = $row['PRODUCTIMAGE_CODE'];
													?>
													<div class = "col-lg-4">
														<div class="product-item">
															<div class="pi-pic">
																<img src="img/products/<?php echo $pImage;?>" alt="">
															
															</div>
															<div class="pi-text">
																<div class="catagory-name"><?php echo $pCat;?></div>
																<a href="#">
																	<h5><?php echo $pName;?></h5>
																</a>
																<div class="product-price"><?php echo $pPrice;?></div>
															</div>
														</div>
													</div><!--col-->
													<?php
												}
											}
											else{
												echo "No results found";
											}
										
									?>
									
									<?php
								
										
									$totalquery= "SELECT * FROM product, product_type WHERE 
									product.PRODUCTTYPE_ID = product_type.PRODUCTTYPE_ID AND lower(PRODUCT_NAME) LIKE '%$search%'";
									$totalresult = oci_parse($conn, $totalquery);
									$execute = oci_execute($totalresult);
									$totalrow = oci_fetch_all($totalresult, $res);				
									
									$page_total_rec=$totalrow;

									$page_total_page=ceil($page_total_rec/$results_per_page);
								}							
								?>
						</div><!--row-->
					</div><!--book-items-->
					<ul class="pagination justify-content-center">

						<?php

							if($page>1)
							{	
								echo '<li class="page-item"><a class="page-link" href="search.php?search_products='.$search.'&submit='.$_GET['submit'].'&page='.($page-1).'">Previous</a></li>';
							}
							for($i=1;$i<=$page_total_page;$i++)
							{
								echo '<li class="page-item active">';

								echo '<a class="page-link" href="search.php?search_products='.$search.'&submit='.$_GET['submit'].'&page='.$i.'"';
								
								echo '>'.$i.'</a></li>';
								
							}

							if($page_total_page>$page)
							{
								echo '<li class="page-item"><a class="page-link" href="search.php?search_products='.$search.'&submit='.$_GET['submit'].'&page='.($page+1).'">Next</a></li>';
							}

						?>

					</ul>
								
					
				</div><!--col-->

			</div><!--row-->
		</div><!--container-->
	</section><!--search-results-->

<?php include "includes/footer.php"; ?>