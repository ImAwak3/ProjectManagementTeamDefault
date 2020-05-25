<!-- include the header and the menu section -->
<?php
    include 'includes/connection.php';
        include "includes/header.php";
    include "includes/navigation.php"; 

    global $page;
?>


    
    <section id="search-banner">
		<div class="jumbotron">
			<h3>Search Results</h3>

			<div class = "col-lg-12">
				<div class="form-search">			
					<!-- search box -->
					<form method = "post" action="search.php" class="book-search">		
						<input type="text" placeholder = "Search store by product or shop name" name = "search_products">
						<button type="submit" class = "search-btn"  name = "search"><i class="fas fa-search"></i></button>
					</form>
				</div>	<!--.form-search-->
			</div><!--col-->
		</div><!--jumbotron-->
	</section><!--search-banner-->
   

    <section id="search-results">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-10">
					
				<div class="book-items">
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
										$results_per_page = 8;
										$start_from = ($page-1)*$results_per_page;
																					
										$query = "SELECT * FROM products, product_type WHERE 
                                        product.PRODUCTTYPE_ID = product_type.PRODUCTTYPE_ID AND lower(PRODUCT_NAME) LIKE '%$search%' OR lower(PRODUCTTYPE_NAME) LIKE '%$search%' LIMIT $start_from, ".$results_per_page;
										$search_query = oci_parse($connection, $query) or die(oci_error($connection));

										if(oci_num_rows($search_query)>0){
											while($row = oci_fetch_array($search_query)){
												$pID = $row['PRODUCT_ID'];
												$pName= $row['PRODUCT_NAME'];
												$pCat = $row['PRODUCTTYPE_NAME'];
												$pPrice = $row['PRODUCT_PRICE'];
												$pImage = $row['PRODUCTIMAGE_CODE'];
												?>
												<div class = "col-lg-4">
													<div class="card">		
														<div class="card-img-top">
															<img src="<?php echo $pImage; ?>" alt="Slider 1">
															<div class="hover-contents">
																<div class="hover-btns">
																	<a href="product.php?id=<?php echo $pId;?>" class = "view-btn"><i class="fas fa-eye"></i></a><br>
												

												
																</div>	<!--hover-btns-->
															</div><!--hover-contents-->
														</div><!--card-img-top-->					
							
														<div class="card-body ">
															<span class="card-title"><a href = "single.php?id=<?php echo $pID;?>"><?php echo $pName?></a></span><!--.card-title-->
															<span class="card-text">by:<a href = "shop.php"> <?php echo $pCat; ?></a></span>
															<span class="card-price"><?php echo '$'.$pPrice; ?></span>
														</div><!--card-body-->							
													</div><!--card-->
												</div><!--col-->
											<?php
											}
										}
										else{
											echo "No results found";
										}
									
								?>
								
								<?php
							
									
								$totalquery= "SELECT count(*) \"total\" FROM product, product_type WHERE 
                                product.PRODUCTTYPE_ID = product_type.PRODUCTTYPE_ID AND lower(PRODUCT_NAME) LIKE '%$search%' OR lower(PRODUCTTYPE_NAME) LIKE '%$search%'";
								$totalresult = oci_parse($connection, $totalquery);
								$totalrow = oci_fetch_assoc($totalresult);				
								
								$page_total_rec=$totalrow['total'];

								$page_total_page=ceil($page_total_rec/$results_per_page);
							}
							?>
					</div><!--row-->
				</div><!--book-items-->
				<ul class="pagination justify-content-center">

					<?php

						if($page>1)
						{	
							echo '<li class="page-item"><a class="page-link" href="search.php?search_products = '.$search.'&search=&page='.($page-1).'">Previous</a></li>';
						}
						for($i=1;$i<=$page_total_page;$i++)
						{
							echo '<li class="page-item">';

							echo '<a class = "page-link" href="search.php?search_products ='.$search.'&search=&page='.$i.'"';
							
							echo '>'.$i.'</a></li>';
							
						}

						if($page_total_page>$page)
						{
							echo '<li class="page-item"><a class="page-link" href="search.php?search_products = '.$search.'&search=&page='.($page+1).'">Next</a></li>';
						}

					?>

				</ul>
								
					
				</div><!--col-->

			</div><!--row-->
		</div><!--container-->
	</section><!--search-results-->

<?php include "includes/footer.php"; ?>