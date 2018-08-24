<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Packages
		<small>Managed packages here</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				<i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">Packages</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		
		<div class="col-md-4 col-sm-12 col-xs-12">

            <!-- EDIT PACKAGE FORM -->
            <div class="box box-primary edit_package_form" style="display:none">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Package</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="edit-package">
                <div class="box-body">
						<div id="err"></div>
						<input type="hidden" name="package_id">
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
                        <div class="form-group">
							<label for="name">Price</label>
							<input class="form-control" placeholder="Enter price" name="price" type="number">
						</div>
                        <div class="form-group">
							<label for="name">Number of Item</label>
							<input class="form-control" placeholder="0" name="number_of_items" type="text">
						</div>
                        
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="is_available" value="1">
									Is Available
								</label>
							</div>
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" id="closeEditPackageForm" class="btn btn-default">Close</button>
					</div>
				</form>
			</div>

            <!-- ADD CATEGORY FORM -->
			<div class="box box-primary add_package_form">
				<div class="box-header with-border">
					<h3 class="box-title">Add Package</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="add-package">
                <div class="box-body">
						<div id="err"></div>
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
                        <div class="form-group">
							<label for="name">Price</label>
							<input class="form-control" placeholder="Enter price" name="price" type="number">
						</div>
                        <div class="form-group">
							<label for="name">Number of Item</label>
							<input class="form-control" placeholder="0" name="number_of_items" type="text">
						</div>
                        <div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="is_available" value="1">
									Is Available
								</label>
							</div>
						</div>
					</div>
                    
						
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>

				</form>
			</div>
		</div>

        <!-- User Table -->
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Package List</h3>
				</div>
				<div class="box-body">
					<table id="packages-table" data-source="<?php echo base_url(" categories/datatable ") ?>" class="table table-bordered table-striped"
					width="100%">
						<thead>
							<tr>
								<th width="15%">ID</th>
								<th>Name</th>
								<th>Number of items</th>
								<th width="20%">Price</th>
								<th width="20%"></th>
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
