<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3">
			<?php $this->load->view('shop/includes/sidebar'); ?>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
					<div class="inner-shop-top-left">
						<div class="dropdown">
							<button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Date</a>
								</li>
								<li>
									<a href="#">Best Sale</a>
								</li>
								<li>
									<a href="#">Rating</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
					<div class="inner-shop-top-right">
						<ul>
							<li class="active">
								<a href="#gried-view" data-toggle="tab" aria-expanded="false">
									<i class="fa fa-th-large"></i>
								</a>
							</li>
							<li>
								<a href="#list-view" data-toggle="tab" aria-expanded="true">
									<i class="fa fa-list"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row inner-section-space-top">
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active clear products-container" id="gried-view">
                    <?php if($products) :?>
                        <?php foreach($products as $product) :?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="product-box1">
                                    <ul class="product-social">
                                        <li>
                                            <a class="product_add_to_cart" data-id="<?php echo $product->id ;?>" href="javascript:void(0);">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo BASE_URL() . 'shop/product/' . $product->id; ?>">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="product-img-holder">
                                        <a href="#">
                                            <?php $img_url = (!empty($product->image)) ? BASE_URL() . 'uploads/img/products/' . $product->image : BASE_URL() . 'assets/img/9.jpg' ; ?>
                                            <img class="img-responsive" src="<?php echo $img_url; ?>" alt="<?php echo $product->name;?>">
                                        </a>
                                    </div>
                                    <div class="product-content-holder">
                                        <h3>
                                            <a href="#"><?php echo $product->name;?></a>
                                        </h3>
                                        <span>Php <?php echo number_format($product->price,2);?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="alert alert-danger">
                            No products found
                        </div>	
                        <?php endif; ?>				
                    </div>
					<!-- List Style -->
					<div role="tabpanel" class="tab-pane clear products-container" id="list-view">
                    <?php if($products) :?>
                        <?php foreach($products as $product) :?>
                            <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                <div class="product-box2">
                                    <div class="media">
                                        <a class="pull-left" href="<?php echo BASE_URL() . 'shop/product/' . $product->id; ?>">
                                            <?php $img_url = (!empty($product->image)) ? BASE_URL() . 'uploads/img/products/' . $product->image : BASE_URL() . 'assets/img/9.jpg' ; ?>
                                            <img class="img-responsive" src="<?php echo $img_url; ?>" alt="<?php echo $product->name;?>" />
                                        </a>
                                        <div class="media-body">
                                            <div class="product-box2-content">
                                                <h3>
                                                    <a href="<?php echo BASE_URL() . 'shop/product/' . $product->id; ?>"><?php echo $product->name;?></a>
                                                </h3>
                                                <span>Php <?php echo number_format($product->price,2);?></span>
                                                <p><?php echo $product->description ;?></p>
                                            </div>
                                            <ul class="product-box2-cart">
                                                <li>
                                                    <a class="product_add_to_cart" data-id="<?php echo $product->id ;?>" href="javascript:void(0);">Add To Cart</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo BASE_URL() . 'product/' . $product->id; ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="alert alert-danger">
                            No products found
                        </div>
                        <?php endif ; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

