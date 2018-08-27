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
                    contents += '<li><ul class="checkout"><li><a href="cart.html" class="btn-checkout"><i class="fa fa-shopping-cart" aria-hidden="true"></i>View Cart</a></li><li><a href="check-out.html" class="btn-checkout"><i class="fa fa-share" aria-hidden="true"></i>Checkout</a></li></ul></li>';

                }else{
                    contents += '<div class="alert alert-danger">No products on cart</div>';
                }
                $('a#cartTotal span').html(response.totalCartItems);
                cartContents.html(contents);
            }
        });
    }

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