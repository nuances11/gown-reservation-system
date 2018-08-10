<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Products
		<small>Managed products here</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				<i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">Products</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-md-4 col-sm-12 col-xs-12">

            <!-- EDIT PRODUCT FORM -->
			<div class="box box-primary edit_product_form" style="display:none">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Product</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="edit-product" enctype="multipart/form-data">
					<input type="hidden" name="product_id">
					<input type="hidden" name="image_file">
					<div class="box-body">
						<div class="form-group">
							<label for="product_img">File input</label>
							<input id="product_img" name="product_img" type="file">
						</div>
						<div class="image-container"></div>
                        <div id="err"></div>
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
						<div class="form-group">
							<label for="price">Price</label>
							<input class="form-control" placeholder="0.00" name="price" type="number">
						</div>
						<div class="form-group">
							<label>Category</label>
							<select class="form-control" name="category">
								<option value="">Select Group</option>
								<?php foreach($categories as $category):  ?>
									<option value="<?= $category->id ?>"><?= $category->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input class="form-control" placeholder="Enter quantity" name="quantity" type="number">
						</div>
						
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="is_featured" value="1">
									Is Featured
								</label>
							</div>

							<div class="checkbox">
								<label>
								<input type="checkbox" name="is_best" value="1">
									Is Best Product
								</label>
							</div>

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
						<button type="button" class="btn btn-default" id="closeEditProductForm">Close</button>
					</div>
				</form>
			</div>

            <!-- ADD PRODUCT FORM -->
			<div class="box box-primary add_product_form">
				<div class="box-header with-border">
					<h3 class="box-title">Add Product</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="add-product">
					<div class="box-body">
						<div id="err"></div>
						<div class="form-group">
							<label for="product_img">File input</label>
							<input id="product_img" name="product_img" type="file">
							<div class="image-container"></div>
						</div>
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
						<div class="form-group">
							<label for="price">Price</label>
							<input class="form-control" placeholder="0.00" name="price" type="number">
						</div>
						<div class="form-group">
							<label>Category</label>
							<select class="form-control" name="category">
								<option value="">Select Group</option>
								<?php foreach($categories as $category):  ?>
									<option value="<?= $category->id ?>"><?= $category->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input class="form-control" placeholder="Enter quantity" name="quantity" type="number">
						</div>
						
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="is_featured" value="1">
									Is Featured
								</label>
							</div>

							<div class="checkbox">
								<label>
								<input type="checkbox" name="is_best" value="1">
									Is Best Product
								</label>
							</div>

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
					<h3 class="box-title">Product List</h3>
				</div>
				<div class="box-body">
					<table id="products-table" data-source="<?php echo base_url(" products/datatable ") ?>" class="table table-bordered table-striped"
					width="100%">
						<thead>
							<tr>
								<th width="10%">ID</th>
								<th>Name</th>
                                <th>Category</th>
								<th width="10%">Qty</th>
                                <th>Status</th>
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
