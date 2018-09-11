<!-- Modal Dialog Box Start Here-->
<div class="modal fade packageDetailsModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
            <button type="button" class="close myclose" data-dismiss="modal">&times;</button>
            <div class="product-details1-area">
                <div class="product-details-info-area">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <div class="inner-product-details-left">
                                <div class="tab-content">
                                    <div id="metro-related1" class="tab-pane fade active in">
                                        <a href="#"><img class="img-responsive product-img" src="img/product/product-details1.jpg" alt="single"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                            <div class="inner-product-details-right">
                                <h3 id="product-title">Product Title Here</h3>
                                <p class="price">$59.00</p>
                                <p class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinc amet risus consectetur, non consectetur nisl finibus. Ut ac eros quis mi volutpat cursus vel non risus.</p>
                                
                                <div class="product-details-content">
                                    <div class="input-group">
                                        <label>PICK A DATE : </label>
                                        <input type="text" size="7" class="form-control datepicker" id="packagedatepicker" name="date">
                                    </div>
                                    <br/>
                                </div>
                                <div class="alert alert-danger out-of-stock-alert">
                                    <p>Sorry, product is
                                        <strong>OUT OF STOCK</strong>
                                        <a href="<?php echo BASE_URL() . 'shop';?>">click here</a> to shop </p>
                                </div>
                                <ul class="inner-product-details-cart">
                                    <li><a href="javascript:void(0);" id="addToCartPackage">Add To Cart</a></li>
                                    <li>
                                        <div class="input-group quantity-holder" id="quantity-holder" style="display:none;">
                                            <input type="text" placeholder="1" value="1" class="form-control quantity-input" name="quantity">
                                            <div class="input-group-btn-vertical">
                                                <button type="button" class="btn btn-default quantity-plus"><i aria-hidden="true" class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-default quantity-minus"><i aria-hidden="true" class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn-services-shop-now" data-dismiss="modal">Close</a>
        </div>
    </div>
</div>