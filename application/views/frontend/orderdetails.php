<div class="order-details-page-area">
    <?php
        $total = 0;

        foreach ($transaction->transDetails as $item) {
            $total += $item->subtotal;
        }

    ?>
	<div class="container">
		<!-- <h2 class="order-details-page-title">Thank You. Your Order Has been Received.</h2> -->
		<ul class="order-details-summery">
			<li>Order Number:<span>
					<?php echo $transaction->transaction_no ;?></span></li>
			<li>Order Date:<span>
					<?php echo date('F jS Y', strtotime($transaction->created_at)) ;?></span></li>
			<li>Email:<span>
					<?php echo $transaction->email ;?></span></li>
			<li>Total:<span>PHP <?php echo number_format($total,2);?></span></li>
            <li>Status:<span>Pending</span></li>
		</ul>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3>Order Details</h3>
				<div class="order-details-page-top table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<td class="order-details-form-heading">Product</td>
								<td class="order-details-form-heading">Total</td>
							</tr>
						</thead>
						<tbody>
                            <?php foreach ($transaction->transDetails as $item) : ?>
                                <tr>
                                    <td><?php echo $item->tdqty; ?> X <?php echo $item->name; ?></td>
                                    <td>PHP <?php echo number_format($item->price,2); ?></td>
                                </tr>
                            <?php endforeach;?>							
							<tr>
								<td><strong>TOTAL</strong></td>
								<td><strong>PHP <?php echo number_format($total,2); ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3>Billing Information</h3>
				<div class="order-details-page-bottom">
					<ul>
						<li><strong>Name:</strong> <?php echo $transaction->firstname . ' ' . $transaction->lastname ;?></li>
						<li><strong>Address:</strong> <?php echo $transaction->address ;?></li>
						<li><strong>Email:</strong> <?php echo $transaction->email ;?></li>
						<li><strong>Phone:</strong> <?php echo $transaction->phone ;?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
