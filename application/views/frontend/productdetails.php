<div class="product-details1-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<?php $this->load->view('shop/includes/sidebar'); ?>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php if($product) :?>
				<div class="inner-shop-details">
					<div class="product-details-info-area">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="inner-product-details-left">
									<div class="tab-content">
										<div class="tab-pane fade active in" id="related1">
											<?php
                                                    $img = ($product->image) ? base_url() . 'uploads/img/products/' . $product->image : base_url() . 'assets/img/product-details1.jpg';
                                                ?>
												<a href="javascript:void(0);" class="zoom ex1">
													<img alt="single" src="<?php echo $img ;?>" class="img-responsive">
												</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="inner-product-details-right">
									<h3>
										<?php echo $product->name;?>
									</h3>
									<p class="price">PHP
										<?php echo number_format($product->price,2) ;?>
									</p>
									<p>
										<?php echo $product->description ;?>
									</p>

									<form id="checkout-form">
										<div class="alert alert-danger out-of-stock-alert">
											<p>Sorry, product is
												<strong>OUT OF STOCK</strong>
												<a href="<?php echo BASE_URL() . 'shop';?>">click here</a> to shop </p>
										</div>
										<div class="input-group">
											<label>PICK A DATE : </label>
											<input type="text" size="7"  data-id="<?php echo $product->id ;?>" class="form-control datepicker" id="datepicker" name="date">
										</div>
										<br/>
										<p class="product_qty"></p>
										<ul class="inner-product-details-cart">
											<li>
												<div class="input-group quantity-holder" id="quantity-holder">
													<input type="text" name="quantity" min="0" class="form-control quantity-input" value="1" placeholder="1">
													<div class="input-group-btn-vertical">
														<button class="btn btn-default quantity-plus" type="button">
															<i class="fa fa-plus" aria-hidden="true"></i>
														</button>
														<button class="btn btn-default quantity-minus" type="button">
															<i class="fa fa-minus" aria-hidden="true"></i>
														</button>
													</div>
												</div>
											</li>
											<li>
												<a href="javascript:void(0);" data-id="<?php echo $product->id ;?>" id="productAddToCart">Add To Cart</a>
											</li>
										</ul>

									</form>

								</div>
							</div>
						</div>
					</div>
                    <?php else: ?>
                    <div class="alert alert-danger">
                        No product found
                    </div>
                    <?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</div>
