<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Users
		<small>Managed user here</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				<i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">Users</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<!-- Add User -->
		<div class="col-md-4 col-sm-12 col-xs-12">

            <!-- EDIT USER FORM -->
            <div class="box box-primary edit_user_form" style="display:none">
				<div class="box-header with-border">
					<h3 class="box-title">Edit User</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="edit-user">
					<div class="box-body">
						<div id="err"></div>
						<input type="hidden" name="user_id">
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
						<div class="form-group">
							<label>User Group</label>
							<select class="form-control" name="user_group">
								<option value="">Select Group</option>
								<option value="1">Admin</option>
								<option value="2">Staff</option>
							</select>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control" name="password" placeholder="Password" type="password">
						</div>
						<div class="form-group">
							<label for="cpassword">Password</label>
							<input class="form-control" name="cpassword" placeholder="Confirm Password" type="password">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-default" id="closeEditUserForm">Close</button>
					</div>
				</form>
			</div>

            <!-- ADD USER FORM -->
			<div class="box box-primary add_user_form">
				<div class="box-header with-border">
					<h3 class="box-title">Add User</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="add-user">
					<div class="box-body">
                        <div id="err"></div>
						<div class="form-group">
							<label for="name">Name</label>
							<input class="form-control" placeholder="Enter name" name="name" type="text">
						</div>
                        <div class="form-group">
							<label for="username">Username</label>
							<input class="form-control" placeholder="Enter username" name="username" type="text">
						</div>
						<div class="form-group">
							<label>User Group</label>
							<select class="form-control" name="user_group">
								<option value="">Select Group</option>
								<option value="1">Admin</option>
								<option value="2">Staff</option>
							</select>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control" name="password" placeholder="Password" type="password">
						</div>
						<div class="form-group">
							<label for="cpassword">Password</label>
							<input class="form-control" name="cpassword" placeholder="Confirm Password" type="password">
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
					<h3 class="box-title">User List</h3>
				</div>
				<div class="box-body">
					<table id="users-table" data-source="<?php echo base_url(" users/datatable ") ?>" class="table table-bordered table-striped"
					width="100%">
						<thead>
							<tr>
								<th width="15%">User Group</th>
								<th>Name</th>
								<th width="20%">Account Created</th>
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
