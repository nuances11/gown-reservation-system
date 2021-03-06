<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Invoice
		<small>#<?php echo $this->uri->segment(3);?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Invoice</li>
	</ol>
</section>

<!-- Main content -->
<section class="invoice">
	<!-- title row -->
	<div class="row">
        <?php if ($this->session->flashdata('update')) :?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('update') ;?>
            </div>
        <?php endif;?>
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
                    }elseif ($order->status == 2) {
                        echo '<span style="color:red;"><strong>DECLINED</strong></span>';
                    }elseif($order->status == 3){
						echo '<span style="color:white;background-color:green;border-radius:10px;"><strong>COMPLETED</strong></span>';
					}
                ?>
            <br>
            <b>Change Status:</b>
            <div class="btn-group">
                <button type="button" class="btn btn-default"><?php
                    if ($order->status == 0) {
                        echo 'PENDING';
                    }elseif ($order->status == 1) {
                        echo 'APPROVED';
                    }elseif ($order->status == 2) {
                        echo 'DECLINED';
                    }elseif ($order->status == 3) {
						echo 'COMPLETED';
					}
                ?></button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
					<?php if ($order->status == 0) : ?>
						<li><a href="javascript:void(0);" data-id="<?php echo $this->uri->segment(3);?>" class="updateOrderStatus" data-status="accept">Accept</a></li>
						<li class="divider"></li>
						<li><a href="javascript:void(0);" data-id="<?php echo $this->uri->segment(3);?>" class="updateOrderStatus" data-status="decline"><span style="color:red;">Decline</span></a></li>
					<?php endif; ?>
					<?php if ($order->status == 1) : ?>
						<li><a href="javascript:void(0);" data-id="<?php echo $this->uri->segment(3);?>" class="updateOrderStatus" data-status="completed">Completed</a></li>
					<?php endif;?>
					
					<!-- <li class="divider"></li>
					<li><a href="javascript:void(0);" data-id="<?php echo $this->uri->segment(3);?>" class="updateOrderStatus" data-status="completed">Completed</a></li> -->
					

				<!-- <li><a href="<?php echo BASE_URL() .'transactions/order/pending/' . $this->uri->segment(3) ;?>">Pending</a></li>
                <li><a href="<?php echo BASE_URL() .'transactions/order/accept/' . $this->uri->segment(3) ;?>">Accept</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo BASE_URL() .'transactions/order/complete/' . $this->uri->segment(3) ;?>">Completed</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo BASE_URL() .'transactions/order/decline/' . $this->uri->segment(3) ;?>"><span style="color:red;">Decline</span></a></li> -->
                </ul>
            </div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<h3>Product</h3>
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
                    <?php foreach ($order->productDetails as $trans) : ?>
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
		<?php if($order->packageDetails) :?>
			<div class="col-xs-12 table-responsive">
				<h3>Package</h3>
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
						<?php $packagetotal = 0; ?>
						<?php foreach ($order->packageDetails as $package) : ?>
						<?php $packagetotal += $package->subtotal ;?>
						<tr>
							<td><?php echo $package->id ;?></td>
							<td><?php echo $package->qty ;?></td>
							<td><?php echo $package->name ;?></td>
							<td><?php echo $package->res_date ;?></td>
							<td><?php echo 'PHP ' . number_format($package->subtotal, 2) ;?></td>
						</tr>
						
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		<?php endif;?>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">
		</div>
		<!-- /.col -->
		<div class="col-xs-6">

			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Total:</th>
						<?php if($order->packageDetails) :?>
							<?php $grandTotal = $total + $packagetotal ;?>
							<td><strong><?php echo 'PHP ' . number_format($grandTotal, 2) ;?></strong></td>
						<?php else: ?>
							<td><strong><?php echo 'PHP ' . number_format($total, 2) ;?></strong></td>
						<?php endif;?>
					</tr>
				</table>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-xs-12">
            <a href="<?php echo BASE_URL() . 'transactions/order-print/' . $this->uri->segment(3) ;?>" target="_blank" id="printInvoice" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
			<a href="<?php echo BASE_URL() . 'transactions' ;?>" class="btn btn-default"> Back</a>
		</div>
	</div>
</section>
<!-- /.content -->
<div class="clearfix"></div>
