<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="billing-details-area">
				<h2 class="cart-area-title">BILLING DETAILS</h2>
				<form id="checkout-form">
					<div class="row">
						<!-- First Name -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="first-name">First Name *</label>
								<input type="text" name="first-name" id="first-name" class="form-control">
							</div>
						</div>
						<!-- last Name -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="last-name">Last Name *</label>
								<input type="text" name="last-name" id="last-name" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Company Name -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="company-name">Company Name</label>
								<input type="text" name="company-name" id="company-name" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Email -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="email">E-mail Address *</label>
								<input type="text" name="email" id="email" class="form-control">
							</div>
						</div>
						<!-- Phone -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="phone">Phone *</label>
								<input type="number" name="phone" id="phone" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Address -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Address</label>
								<input type="text" name="address" id="address" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Town / City -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="town-city">Town / City</label>
								<input type="text" name="town-city" id="town-city" class="form-control">
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="order-sheet">
				<h2>Your Order</h2>
                <?php if($this->cart->contents()) :?>
                    <?php foreach ($this->cart->contents() as $items) :?>
                        <ul>
                            <li><?php echo $items['qty'] ;?> x <?php echo $items['name'] ;?>
                                <span>PHP <?php echo $items['subtotal'] ;?></span>
                            </li>
                        </ul>
                    <?php endforeach;?>
                <?php else: ?>
                    <div class="alert alert-danger">
                        Empty Cart
                    </div>
                <?php endif; ?>
				<h3>Total
					<span>PHP <?php echo $this->cart->format_number($this->cart->total()); ?></span>
				</h3>
			</div>
            <div class="pLace-order">
				<button class="btn-send-message disabled" type="submit">Place Order</button>
			</div>
            </form>
            <div id="err"></div>
		</div>
	</div>
</div>
