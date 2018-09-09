$(document).ready(function() {
    /**
     * Number.prototype.format(n, x)
     * 
     * @param integer n: length of decimal
     * @param integer x: length of sections
     */
    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

    updateCartCount();

    function updateCartCount(){
        $.ajax({
            type: "GET",
            url: "/shop/cartount",
            dataType: "json",
            success: function(response)
            {
                var contents = '';
                var cartContents = $('#cartContents');

                if (response.totalCartItems > 0) {
                    $.each( response.items, function( key, value ) {
                        contents += '<li>';
                        contents += '<div class="cart-single-product">';
                        contents += '<div class="media">';
                        contents += '<div class="media-body cart-content">';
                        contents += '<ul>';
                        contents += '<li>';
                        contents += '<h2><a href="/shop/product/'+value.id+'">'+ value.name +'</a></h2>';
                        contents += '<h3>PHP  ' + value.price.format(2) + '</h3>';
                        contents += '</li>';
                        contents += '<li>';
                        contents += '<p>X ' + value.qty + '</p>';
                        contents += '</li>';
                        contents += '<li>';
                        contents += '<p>PHP  ' + value.subtotal.format(2) + '</p>';
                        contents += '</li>';
                        contents += '<li>';
                        contents += '<a class="trash deleteItem" href="#" data-row-id="' + value.rowid + '"><i class="fa fa-trash-o"></i></a>'
                        contents += '</li></ul></div></div></div></li>';
                    });

                    contents += '<li><span><span>TOTAL</span></span><span>PHP ' + response.total + '</span></li>';
                    contents += '<li><ul class="checkout"><li><a href="/shop/cart" class="btn-checkout"><i class="fa fa-shopping-cart" aria-hidden="true"></i>View Cart</a></li><li><a href="/shop/checkout" class="btn-checkout"><i class="fa fa-share" aria-hidden="true"></i>Checkout</a></li></ul></li>';

                }else{
                    contents += '<div class="alert alert-danger">No products on cart</div>';
                }
                $('a#cartTotal span').html(response.totalCartItems);
                cartContents.html(contents);
            }
        });
    }

    // Search Function
    var searchRequest = null;
    var minlength = 2;

    $(document).on('keyup', '#orderSearch', function(e) {
        
        var that = this;
        var value = $(this).val();
        var content = '';

        if (value.length >= minlength ) {
            if (searchRequest != null) 
                searchRequest.abort();
            searchRequest = $.ajax({
                type: "GET",
                url: "/shop/search/order",
                data: {
                    'trans' : value
                },
                dataType: "json",
                success: function(response){
                    //we need to check if the value is the same
                    if (value==$(that).val()) {
                    //Receiving the result of search here
                        $.each( response, function( key, value ) {
                            content += '<tr><td><a href="/shop/order/' + value.transaction_no + '">' + value.transaction_no + '<i class="fa fa-paperclip" aria-hidden="true"></i></a></td><td>' + value.firstname + ' ' + value.lastname + '</td><td>' + value.created_at + '</td><td class="pending">Pending</td></tr>';
                        })
                        $('#orderResultTable tbody').html(content);
                    }

                    
                }
            });
        }
    })

    $(document).on('click', '.update-item', function(e) {
        var qty = $('.quantity input[name=quantity]').val();
        var rowid = $(this).data('row-id');

        $.ajax({
            type: "POST",
            url: "/shop/updatecart",
            data: { 
                qty : qty,
                rowid : rowid,
            },
            dataType: "json",
            success: function(response)
            {
                if (response.success) {
                    location.reload();
                    updateCartCount();
                }else{
                    alert(response.message);
                }
            }
        });
        
    })

    $(document).on('click', '#productAddToCart', function(e) {
        e.preventDefault();
        var maxQty = $('.quantity-input').data('max-qty');
        var inputQty = $('input[name=quantity]').val();
        var id = $(this).data('id');
        var date = $('.quantity-input').data('date');
        var r = confirm("Are you sure you want to add this product to cart?");

        if (r == true) {
            
            if (inputQty) {
                if (inputQty > maxQty) {
                    alert('Input quantity is more than the current product quantity.');
                }else{
                    $.ajax({
                        type: "POST",
                        url: "/shop/add",
                        data: { 
                            id : id,
                            qty : inputQty,
                            date : date,
                        },
                        dataType: "json",
                        success: function(response)
                        {
                            if (response.success) {
                                alert(response.message);
                                updateCartCount();
                            }else{
                                alert(response.message);
                            }
                        }
                    });
                }
            }else{
                alert('Please add product quantity');
            }

        }

    })

    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var r = confirm("Are you sure you want to checkout?");
        if (r == true) {
            
            $.ajax({
                type: "POST",
                url: "/shop/checkout-cart",
                data: data,
                dataType: "json",
                success: function(response)
                {
                    
                    if (response.success) {
                        toastr.success(response.messages);
                        $('#checkout-form').trigger('reset');
                        setTimeout(function(){ window.location.href = response.url; }, 1500);
                        updateCartCount();
                    }else{
                        toastr.error(response.messages);
                    }
                }
            });

        }
    })


    $(document).on('click', '.deleteItem', function(e) {
        e.preventDefault();
        var rowid = $(this).data('row-id');
        
        $.ajax({
            type: "POST",
            url: "/shop/removeItem",
            data: { rowid : rowid },
            dataType: "json",
            success: function(response)
            {
                
                if (response.success) {
                    alert(response.message);
                    updateCartCount();
                }else{
                    alert(response.message);
                }
            }
        });
    })

    $(document).on('click', '.removeItem', function(e) {
        e.preventDefault();
        var rowid = $(this).data('row-id');
        
        $.ajax({
            type: "POST",
            url: "/shop/removeItem",
            data: { rowid : rowid },
            dataType: "json",
            success: function(response)
            {
                
                if (response.success) {
                    location.reload();
                }else{
                    alert(response.message);
                }
            }
        });
    })

    var dateToday = new Date(); 

    $('.inner-product-details-cart').hide();

    
    $( ".datepicker" ).datepicker({
        minDate: dateToday,
        onSelect: function(dateText, inst) {
            var id = inst.input.context.dataset.id;
            // var id = $(this).data('id');
            var mydata = {
                id : id,
                date : dateText,
            }

            $.ajax({
                type: "GET",
                url: "/shop/getAvailableQty",
                data: mydata,
                dataType: "json",
                success: function(response)
                {
                    if (response.success) {

                        if (response.availableQty > 0) {
                            $('.product_qty').html('<span>QTY : </span>' + response.availableQty);
                            $('.productDetailsModal .quantity-input').attr('data-qty', response.availableQty);
                            $('.productDetailsModal .quantity-input').attr('data-id', id);
                            $('.productDetailsModal .quantity-input').attr('data-date', dateText);
                            $('.inner-product-details-cart').show();

                            // for single product
                            $('#checkout-form input[name="quantity"]').attr('data-max-qty', response.availableQty);
                            $('#checkout-form input[name="quantity"]').attr('max', response.availableQty);

                        }else{
                            $('.out-of-stock-alert').show();
                        }
                        
                    }
                }
            });
            
        }
    });

    $(".productDetailsModal").on("hidden.bs.modal", function() {
        $('.productDetailsModal').find('input:text, input:password, select, textarea').val('');
        $('.productDetailsModal').find('input:radio, input:checkbox').prop('checked', false);
        $('.product_qty').html('');
        $('.inner-product-details-cart').hide();
    });
    
    $(document).on('click', '.product_add_to_cart', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        
        var imgSrc = ''
        $('.productDetailsModal').attr('data-id', id);
        $('.productDetailsModal').modal('show');

        $.ajax({
            type: "GET",
            url: "/products/edit",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                console.log(response);
                if (response.success) {
                    
                    var price = accounting.formatMoney(response.product.price, "PHP ", 2, ",", ".");
                    if(response.product.image){
                        imgSrc = '/uploads/img/products/' + response.product.image;
                    }else{
                        imgSrc = '/assets/img/1.jpg';
                    }
                    $('.productDetailsModal .product-img').attr('src', imgSrc);
                    $('.productDetailsModal .datepicker').attr('data-id', response.product.id);
                    $('.productDetailsModal #product-title').html(response.product.name);
                    $('.productDetailsModal .price').html(price);
                    $('.productDetailsModal .description').html(response.product.description);
                    $('.productDetailsModal .category').html('<span>Category:</span> ' + response.product.catname);
                }
                
            }
        });
    })

    $('.out-of-stock-alert').hide();

    // $(document).on('input', '.datepicker', function(e) {
    //     e.preventDefault();
    //     var date = $(this).val();
    //     var id = $(this).data('id');

    //     var mydata = {
    //         id : id,
    //         date : date,
    //     }

    //     $.ajax({
    //         type: "GET",
    //         url: "/shop/getAvailableQty",
    //         data: mydata,
    //         dataType: "json",
    //         success: function(response)
    //         {
    //             if (response.success) {

    //                 if (response.availableQty > 0) {
    //                     $('.product_qty').html('<span>QTY : </span>' + response.availableQty);
    //                     $('.productDetailsModal .quantity-input').attr('data-qty', response.availableQty);
    //                     $('.productDetailsModal .quantity-input').attr('data-id', id);
    //                     $('.productDetailsModal .quantity-input').attr('data-date', date);
    //                     $('.inner-product-details-cart').show();
    //                 }else{
    //                     $('.out-of-stock-alert').show();
    //                 }
                    
    //             }
    //         }
    //     });

    //     return;

    // })

    $(document).on('click', '#addToCart', function(e) {
        var availableQty = $('.productDetailsModal .quantity-input').data('qty');
        var id = $('.productDetailsModal .quantity-input').data('id');
        var date = $('.productDetailsModal .quantity-input').data('date');
        var inputQty = $('.productDetailsModal .quantity-input').val();
        var r = confirm("Are you sure you want to add this product to cart?");

        if (r == true) {

            if (availableQty < inputQty) {
                alert('Input quantity is greater than the available product quantity.');
                return;
            }else{
                
                $.ajax({
                    type: "POST",
                    url: "/shop/add",
                    data: { 
                        id : id,
                        qty : inputQty,
                        date : date,
                    },
                    dataType: "json",
                    success: function(response)
                    {
                        if (response.success) {
                            alert(response.message);
                            $('.productDetailsModal').modal('toggle'); 
                            updateCartCount();
                        }else{
                            alert(response.message);
                        }
                    }
                });

            }

        }
    })
})