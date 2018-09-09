<section class="invoice">
	<!-- title row -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				CASA MODA
				<small class="pull-right"><strong>Date:</strong> <?php echo date('F j, Y h:i:sa', strtotime($order->created_at)); ?></small>
			</h2>
		</div>
		<!-- /.col -->
	</div>
	<!-- info row -->
	<div class="row invoice-info">
		<div class="col-sm-4 invoice-col">
			Customer Details
			<address>
				<strong><?php echo strtoupper($order->firstname) . ' ' . strtoupper($order->lastname) ;?></strong><br>
				<?php echo ($order->address) ? $order->address : 'n/a' ; ?><br>
				<?php echo ($order->town_city) ? $order->town_city : 'n/a' ; ?><br>
				<?php echo ($order->phone) ? $order->phone : 'n/a' ; ?><br>
				<?php echo ($order->email) ? $order->email : 'n/a' ; ?>
			</address>
		</div>
		<!-- /.col -->
		<div class="col-sm-4 invoice-col">
			
		</div>
		<!-- /.col -->
		<div class="col-sm-4 invoice-col">
            <b>Order Status:</b> 
                <?php
                    if ($order->status == 0) {
                        echo '<span style="color:orange;"><strong>PENDING</strong></span>';
                    }elseif ($order->status == 1) {
                        echo '<span style="color:green;"><strong>APPROVED</strong></span>';
                    }else {
                        echo '<span style="color:red;"><strong>DECLINED</strong></span>';
                    }
                ?>
            <br>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
                        <th>ID</th>
						<th>Qty</th>
						<th>Product</th>
						<th>Res Date</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($order->transDetails as $trans) : ?>
                    <?php $total += $trans->subtotal ;?>
                    <tr>
                        <td><?php echo $trans->id ;?></td>
                        <td><?php echo $trans->qty ;?></td>
                        <td><?php echo $trans->name ;?></td>
                        <td><?php echo $trans->res_date ;?></td>
                        <td><?php echo 'PHP ' . number_format($trans->subtotal, 2) ;?></td>
                    </tr>
                    
                    <?php endforeach;?>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">

			<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
				dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
			</p>
		</div>
		<!-- /.col -->
		<div class="col-xs-6">

			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Total:</th>
						<td><strong><?php echo 'PHP ' . number_format($total, 2) ;?></strong></td>
					</tr>
				</table>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
<div class="clearfix"></div>
