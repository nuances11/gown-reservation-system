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
                console.log(response);
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
        console.log($(this).val());
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
                        //console.log(response);
                        $.each( response, function( key, value ) {
                            console.log(response);
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
                console.log(response);
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
                    },
                    dataType: "json",
                    success: function(response)
                    {
                        console.log(response);
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
    })

    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        var r = confirm("Are you sure you want to checkout?");
        if (r == true) {
            
            $.ajax({
                type: "POST",
                url: "/shop/checkout-cart",
                data: data,
                dataType: "json",
                success: function(response)
                {
                    console.log(response);
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
        console.log(rowid);
        $.ajax({
            type: "POST",
            url: "/shop/removeItem",
            data: { rowid : rowid },
            dataType: "json",
            success: function(response)
            {
                console.log(response);
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
        console.log(rowid);
        $.ajax({
            type: "POST",
            url: "/shop/removeItem",
            data: { rowid : rowid },
            dataType: "json",
            success: function(response)
            {
                console.log(response);
                if (response.success) {
                    location.reload();
                }else{
                    alert(response.message);
                }
            }
        });
    })
    
    $(document).on('click', '.product_add_to_cart', function(e) {
    // $('.product_add_to_cart').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            type: "POST",
            url: "/shop/add",
            data: { id : id },
            dataType: "json",
            success: function(response)
            {
                console.log(response);
                if (response.success) {
                    alert(response.message);
                    updateCartCount();
                }else{
                    alert(response.message);
                }
            }
        });
    })
})