<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Transactions
		<small>Managed transactions here</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				<i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">Transactions</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">

		<!-- Transactions Table -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Transaction List</h3>
				</div>
				<div class="box-body">
					<table id="transactions-table" data-source="<?php echo base_url(" products/datatable ") ?>" class="table table-bordered table-striped"
					width="100%">
						<thead>
							<tr>
								<th width="15%">ORDER #</th>
								<th>Name</th>
								<th>Email</th>
								<th>Order Created</th>
								<th>Phone</th>
								<th width="10%">Status</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.user table -->
		</div>
	</div>
</section>
<!-- /.content -->
