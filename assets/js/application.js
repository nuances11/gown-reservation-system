$(document).ready(function() {

    $(document).on('submit', '#adminLogin', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "/users/signin",
            data: data,
            dataType: "json",
            success: function(response)
            {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function(){ window.location.href = response.redirect_url; }, 1500);
                }else{
                    toastr.error(response.message);
                }
            }
        });

    })

    $(document).on('click', '.updateOrderStatus', function() {
        var status = $(this).data('status');
        var id = $(this).data('id');

        bootbox.confirm({ 
            size: "small",
            title: "Update Transction",
            message: "Are you sure you want to update this transaction?", 
            callback: function(result){ 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "/transactions/set-order",
                        data: { 
                            id : id,
                            order : status,
                         },
                        dataType: "json",
                        success: function(response)
                        {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(function(){ location.reload(); }, 1500);
                            }else{
                                toastr.error(response.message);
                            }
                        }
                    });
                    
                }
            }
          })
        
    })

    // DATA TABLES
    var usersDataTable = $('#transactions-table').DataTable({
        "ajax": {
            url : 'transactions/datatable',
            type : 'GET'
        },
    })

    var usersDataTable = $('#users-table').DataTable({
        "ajax": {
            url : 'users/datatable',
            type : 'GET'
        },
    })
    var categoriesDataTable = $('#categories-table').DataTable({
        "ajax": {
            url : 'categories/datatable',
            type : 'GET'
        },
    })

    var productsDataTable = $('#products-table').DataTable({
        "ajax": {
            url : 'products/datatable',
            type : 'GET'
        },
    })

    var packagesDataTable = $('#packages-table').DataTable({
        "ajax": {
            url : 'packages/datatable',
            type : 'GET'
        },
    })

    $(document).on('click', '#imgUpload', function(e) {

        $('#uploader-container').css('display', 'block');

    })

    $(document).on('click', '.btnProductDelete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        bootbox.confirm({ 
            size: "small",
            title: "Delete Product",
            message: "Are you sure you want to delete this product?", 
            callback: function(result){ 
                if (result) {
                 
                    $.ajax({
                        type: "POST",
                        url: "products/delete",
                        data: { id : id },
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                productsDataTable.ajax.reload();
                            }else{
                                toastr.error(response.message);
                            }
                        }
                    });
                    
                }
            }
          })
    })

    $(document).on('click', '.btnCategoryDelete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        bootbox.confirm({ 
            size: "small",
            title: "Delete Category",
            message: "Are you sure you want to delete this category?", 
            callback: function(result){ 
                if (result) {
                 
                    $.ajax({
                        type: "POST",
                        url: "categories/delete",
                        data: { id : id },
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                categoriesDataTable.ajax.reload();
                            }else{
                                toastr.error(response.message);
                            }
                        }
                    });
                    
                }
            }
          })
    })

    // Delete User Button
    $(document).on('click', '.btnUserDelete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        bootbox.confirm({ 
            size: "small",
            title: "Delete User",
            message: "Are you sure you want to delete this user?", 
            callback: function(result){ 
                if (result) {
                 
                    $.ajax({
                        type: "POST",
                        url: "users/delete",
                        data: { id : id },
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                usersDataTable.ajax.reload();
                            }else{
                                toastr.error(response.message);
                                usersDataTable.ajax.reload();
                            }
                        }
                    });
                    
                }
            }
          })
    })

    $(document).on('click', '#closeEditUserForm', function(e) {
        $('.add_user_form').css('display', 'block');
        $('.edit_user_form').css('display', 'none');
        $('#add-user').trigger('reset');
        $('#edit-user').trigger('reset');
    })

    $(document).on('click', '#closeEditCategoryForm', function(e) {
        $('.add_category_form').css('display', 'block');
        $('.edit_category_form').css('display', 'none');
        $('#add-category').trigger('reset');
        $('#edit-category').trigger('reset');
    })

    $(document).on('click', '#closeEditProductForm', function(e) {
        $('.add_product_form').css('display', 'block');
        $('.edit_product_form').css('display', 'none');
        $('#add-product').trigger('reset');
        $('#edit-product').trigger('reset');
        $('.image-container').html('');
    })

    $(document).on('click', '#closeEditPackageForm', function(e) {
        $('.add_package_form').css('display', 'block');
        $('.edit_package_form').css('display', 'none');
        $('#add-package').trigger('reset');
        $('#edit-package').trigger('reset');
    })

    // Edit User Button
    $(document).on('click', '.btnUserEdit', function(e) {
        e.preventDefault();
        $('.add_user_form').css('display', 'none');
        $('.edit_user_form').css('display', 'block');
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "users/edit",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                if (response.success) {
                    $('#edit-user input[name=name]').val(response.user.name);
                    $('#edit-user input[name=username]').val(response.user.username);
                    $('#edit-user select[name=user_group]').val(response.user.user_group);
                    $('#edit-user input[name=user_id]').val(response.user.id);

                }else{
                    toastr.error(response.message);
                    usersDataTable.ajax.reload();
                }
            }
        });

    })

    // Edit Package  Button
    $(document).on('click', '.btnPackageEdit', function(e) {
        e.preventDefault();
        $('.add_package_form').css('display', 'none');
        $('.edit_package_form').css('display', 'block');
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "packages/edit",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                if (response.success) {
                    $('#edit-package input[name=package_id]').val(response.package.id);
                    $('#edit-package input[name=name]').val(response.package.name);
                    $('#edit-package input[name=price]').val(response.package.price);
                    $('#edit-package input[name=number_of_items]').val(response.package.dress_count);

                }else{
                    toastr.error(response.message);
                    packagesDataTable.ajax.reload();
                }
            }
        });

    })

    // Edit Category  Button
    $(document).on('click', '.btnCategoryEdit', function(e) {
        e.preventDefault();
        $('.add_category_form').css('display', 'none');
        $('.edit_category_form').css('display', 'block');
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "categories/edit",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                if (response.success) {
                    $('#edit-category input[name=name]').val(response.category.name);
                    $('#edit-category input[name=category_id]').val(response.category.id);

                }else{
                    toastr.error(response.message);
                    categoriesDataTable.ajax.reload();
                }
            }
        });

    })

    // Edit Product  Button
    $(document).on('click', '.btnProductEdit', function(e) {
        e.preventDefault();
        $('.add_product_form').css('display', 'none');
        $('.edit_product_form').css('display', 'block');
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "products/edit",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                console.log(response);
                if (response.success) {
                    $('#edit-product input[name=name]').val(response.product.name);
                    $('#edit-product select[name=size]').val(response.product.size_id);
                    $('#edit-product input[name=product_id]').val(response.product.id);
                    $('#edit-product input[name=price]').val(response.product.price);
                    $('#edit-product select[name=category]').val(response.product.category_id);
                    $('#edit-product input[name=qty]').val(response.product.qty);
                    $('#edit-product textarea[name=description]').val(response.product.description);
                    if (response.product.is_available) {
                        $('#edit-product input[type=checkbox][name=is_available]').prop('checked', true);
                    }
                    if(response.product.image){
                        $('.image-container').html('<img src="uploads/img/products/' + response.product.image + '" class="img-responsive">');
                        $('#edit-product input[name=image_file]').val(response.product.image);
                    }else{
                        $('.image-container').html('');
                    }
                    
                }else{
                    toastr.error(response.message);
                    productsDataTable.ajax.reload();
                }
            }
        });

    })

    // FORMS
    $('#add-package').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var errors = "";

        bootbox.confirm({ 
            size: "small",
            title: "Add Package",
            message: "Are you sure you want to add this package?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "packages/save",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#add-user').find('input:text, input:password, select, textarea').val('');
                                $('#add-user').find('input:radio, input:checkbox').prop('checked', false);
                                packagesDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
        })
    })

    $('#edit-package').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        bootbox.confirm({ 
            size: "small",
            title: "Edit Package",
            message: "Are you sure you want to update this package?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "packages/update",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#edit-package').find('input:text, input:password, select, textarea').val('');
                                $('#edit-package').find('input:radio, input:checkbox').prop('checked', false);
                                packagesDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })


    // FORMS
    $('#add-user').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var errors = "";

        bootbox.confirm({ 
            size: "small",
            title: "Add User",
            message: "Are you sure you want to add this user?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "users/save",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#add-user').find('input:text, input:password, select, textarea').val('');
                                $('#add-user').find('input:radio, input:checkbox').prop('checked', false);
                                usersDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    $('#edit-user').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        bootbox.confirm({ 
            size: "small",
            title: "Edit User",
            message: "Are you sure you want to update this user?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "users/update",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#edit-user').find('input:text, input:password, select, textarea').val('');
                                $('#edit-user').find('input:radio, input:checkbox').prop('checked', false);
                                usersDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    // FORMS
    $('#add-category').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var errors = "";

        bootbox.confirm({ 
            size: "small",
            title: "Add Category",
            message: "Are you sure you want to add this category?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "categories/save",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#add-category').find('input:text, input:password, select, textarea').val('');
                                $('#add-category').find('input:radio, input:checkbox').prop('checked', false);
                                categoriesDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    $('#edit-category').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        bootbox.confirm({ 
            size: "small",
            title: "Edit Category",
            message: "Are you sure you want to update this category?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "categories/update",
                        data: data,
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                $('#edit-user').find('input:text, input:password, select, textarea').val('');
                                $('#edit-user').find('input:radio, input:checkbox').prop('checked', false);
                                categoriesDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    // FORMS
    $('#add-product').on('submit', function(e) {
        e.preventDefault();
        // var data = $(this).serialize();
        var data = new FormData(this);
        var errors = "";

        bootbox.confirm({ 
            size: "small",
            title: "Add Product",
            message: "Are you sure you want to add this product?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "products/save",
                        data: data,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            //console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                // $('#add-product').find('input:text, input:number, input:password, input:file, select, textarea').val('');
                                // $('#add-product').find('input:radio, input:checkbox').prop('checked', false);
                                $('#add-product')[0].reset();
                                productsDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    toastr.error(response.validation_errors);
                                }else if(response.product_image){
                                    toastr.error(response.product_image);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    $('#edit-product').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);

        bootbox.confirm({ 
            size: "small",
            title: "Edit Product",
            message: "Are you sure you want to update this product?", 
            callback: function(result){ 
                if (result) {
                    
                    $.ajax({
                        type: "POST",
                        url: "products/update",
                        data: data,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.message);
                                // Clear all input on the Add user Form
                                // $('#edit-product').find('input:text, input:password, select, textarea').val('');
                                // $('#edit-product').find('input:radio, input:checkbox').prop('checked', false);
                                $('.image-container').html('');
                                $('#edit-product')[0].reset();
                                productsDataTable.ajax.reload(); // Reload Users DataTable
                            }else{
                                if (response.validation_errors) {
                                    console.log(response.validation_errors);
                                    toastr.error(response.validation_errors);
                                }else{
                                    toastr.error(response.message);
                                }
                            }
                        }
                    });
                    
                }
            }
          })

    })

    // Toastr Options
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

})
