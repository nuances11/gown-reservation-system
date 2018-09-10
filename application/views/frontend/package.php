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
                            <div class="services-area-box" style="margin-bottom:20px">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <?php $img_url = (!empty($package->image)) ? BASE_URL() . 'uploads/img/packages/' . $package->image : BASE_URL() . 'assets/img/1.png' ; ?>
                                        <img src="<?php echo $img_url; ?>" alt="<?php echo $package->name;?>" class="img-responsive">
                                    </a>
                                    <div class="media-body">
                                        <span><?php echo 'PHP ' . number_format($package->price,2) ;?></span>
                                        <h3><a href="#"><?php echo strtoupper($package->name) ;?></a></h3>
                                        <!-- <p><?php echo $package->package_description ;?></p> -->
                                        <a href="javascript:void(0);" data-id="<?php echo $package->id ;?>" class="btn-shop-now addPackageToCart">Shop Now<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
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
<?php $this->load->view('shop/includes/package_details_modal') ;?>
