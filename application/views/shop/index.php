<pre>
<?php //  print_r($products);?>
</pre>
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
                                            <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $product->id; ?>">
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
                        <?php endforeach; ?>					</div>
					<!-- List Style -->
					<div role="tabpanel" class="tab-pane clear products-container" id="list-view">
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
                                                    <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $product->id; ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
            <?php // $this->load->view('shop/includes/product_details_modal') ;?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<ul class="mypagination">
						<li class="active">
							<a href="#">1</a>
						</li>
						<li>
							<a href="#">2</a>
						</li>
						<li>
							<a href="#">3</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

