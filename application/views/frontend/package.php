<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3">
			<?php $this->load->view('shop/includes/sidebar'); ?>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="services1-area">
				<div class="row">
                    <?php foreach($packages as $package) :?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="services-area-box">
                                <div class="media">
                                    <div class="media-body">
                                        <span><?php echo $package->dress_count . ' Item(s)' ;?></span>
                                        <h3><a href="#"><?php echo strtoupper($package->name) ;?></a></h3>
                                        <p><?php echo number_format($package->price,2) ;?></p>
                                        <a href="#" class="btn-shop-now">Shop Now<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Services1 Area End Here -->
