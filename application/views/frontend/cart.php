<div class="cart-page-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="cart-page-top table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<td class="cart-form-heading">Product</td>
								<td class="cart-form-heading">Price</td>
								<td class="cart-form-heading">Quantity</td>
								<td class="cart-form-heading">Total</td>
								<td class="cart-form-heading"></td>
							</tr>
						</thead>
						<tbody id="quantity-holder">
							<?php $subtotal = '' ;?>
							<?php $size = ''; ?>
                            <?php if($this->cart->contents()) :?>
							<?php foreach ($this->cart->contents() as $items) :?>
							<tr>
								<td>
									<h3>
										<a href="#">
											<?php echo $items['name'] ;?>
										</a>
									</h3>
								</td>
								<td class="amount">PHP
									<?php echo number_format($items['price'],2) ;?>
								</td>
								<td class="quantity">
									<div class="input-group quantity-holder">
										<input type="text" name="quantity" class="form-control quantity-input" value="<?php echo $items['qty'];?>" placeholder="1">
										<div class="input-group-btn-vertical">
											<button class="btn btn-default quantity-plus update-item" data-row-id="<?php echo $items['rowid'];?>" data-qty="<?php echo $items['qty'];?>" type="button">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</button>
											<button class="btn btn-default quantity-minus update-item" data-row-id="<?php echo $items['rowid'];?>" data-qty="<?php echo $items['qty'];?>" type="button">
												<i class="fa fa-minus" aria-hidden="true"></i>
											</button>
										</div>

									</div>
								</td>
								<td class="amount">
								    <?php echo $this->cart->format_number($items['subtotal']); ?>
								</td>
								<td class="dismiss">
									<a href="#" class="removeItem" data-row-id="<?php echo $items['rowid'];?>">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center"><div class="alert alert-danger">Empty Cart</div></td>
                                </tr>
                            <?php endif; ?>
						</tbody>
					</table>
					<div class="update-button">
						<a class="btn-apply-coupon disabled" href="/shop">Continue Shopping</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="cart-page-bottom-right">
					<h3>Total
						<span>PHP
							<?php echo $this->cart->format_number($this->cart->total()); ?>
						</span>
					</h3>
					<div class="proceed-button">
						<a class="btn-apply-coupon disabled" href="<?php echo BASE_URL() . 'shop/checkout';?>">Proceed To Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
