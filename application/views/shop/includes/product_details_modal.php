<!-- Modal Dialog Box Start Here-->
<?php foreach($products as $product) :?>
<div id="#myModal-<?php echo $product->id; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-body">
			<button type="button" class="close myclose" data-dismiss="modal">&times;</button>
			<div class="product-details1-area">
				<div class="product-details-info-area">
					<div class="row">
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
							<div class="inner-product-details-left">
								<div class="tab-content">
									<div id="metro-related1" class="tab-pane fade active in">
										<a href="#">
                                            <?php $img_url = (!empty($product->image)) ? BASE_URL() . 'uploads/img/products/' . $product->image : BASE_URL() . 'assets/img/9.jpg' ; ?>
											<img class="img-responsive" src="<?php echo $img_url ;?>" alt="single">
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
							<div class="inner-product-details-right">
								<h3><?php echo $product->name;?></h3>
								<p class="price">$59.00</p>
								<p><?php echo $product->description ;?></p>
								<div class="product-details-content">
									<!-- <p>
										<span>Availability:</span> In stock</p> -->
									<p>
										<span>Category:</span> <a href="<?php echo BASE_URL() . 'shop/cat/' . $product->cat_id ;?>'"><?php echo $product->cat_name;?></a></p>
								</div>
								<ul class="inner-product-details-cart">
									<li>
                                        <a class="product_add_to_cart" data-id="<?php echo $product->id ;?>" href="javascript:void(0);">Add To Cart</a>
									</li>
									<li>
										<div class="input-group quantity-holder" id="quantity-holder">
											<input type="text" placeholder="1" value="1" class="form-control quantity-input" name="quantity">
											<div class="input-group-btn-vertical">
												<button type="button" class="btn btn-default quantity-plus">
													<i aria-hidden="true" class="fa fa-plus"></i>
												</button>
												<button type="button" class="btn btn-default quantity-minus">
													<i aria-hidden="true" class="fa fa-minus"></i>
												</button>
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-heart-o" aria-hidden="true"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-services-shop-now" data-dismiss="modal">Close</a>
		</div>
	</div>
</div>
<?php endforeach; ?>
<!-- Modal Dialog Box End Here-->
