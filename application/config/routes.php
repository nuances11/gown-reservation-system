<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['cmlogin']['GET'] = 'users/login';
$route['users/signin']['POST'] = 'users/user_login';
$route['users/logout']['POST'] = 'users/logout';

// USERS Routes
$route['users']['GET'] = 'users';
$route['users/datatable']['GET'] = 'users/datatable';
$route['users/save']['POST'] = 'users/save';
$route['users/delete/(:num)']['POST'] = 'users/delete/$1';
$route['users/edit']['GET'] = 'users/edit';
$route['users/update']['POST'] = 'users/update';

// CATEGORIES Routes
$route['categories']['GET'] = 'categories';
$route['categories/datatable']['GET'] = 'categories/datatable';
$route['categories/save']['POST'] = 'categories/save';
$route['categories/edit']['GET'] = 'categories/edit';
$route['categories/update']['POST'] = 'categories/update';
$route['categories/delete']['POST'] = 'categories/delete';

// PRODUCTS
$route['products']['GET'] = 'products';
$route['products/datatable']['GET'] = 'products/datatable';
$route['products/save']['POST'] = 'products/save';
$route['products/edit']['GET'] = 'products/edit';
$route['products/update']['POST'] = 'products/update';
$route['products/delete']['POST'] = 'products/delete';

// PACKAGES
$route['packages']['GET'] = 'packages';
$route['packages/datatable']['GET'] = 'packages/datatable';
$route['packages/save']['POST'] = 'packages/save';
$route['packages/edit']['GET'] = 'packages/edit';
$route['packages/update']['POST'] = 'packages/update';
$route['packages/delete']['POST'] = 'packages/delete';

// TRANSACTIONS
$route['transactions']['GET'] = 'transactions';
$route['transactions/datatable']['GET'] = 'transactions/datatable';
$route['transactions/order/(:any)']['GET'] = 'transactions/order/$1';
$route['transactions/order-print/(:any)']['GET'] = 'transactions/orderPrint/$1';
$route['transactions/set-order']['POST'] = 'transactions/set_order';


// FRONTEND
$route['shop/contact']['GET'] = 'contact';
$route['shop/about']['GET'] = 'about';
$route['shop/cart']['GET'] = 'shop/cart';
$route['shop/order/(:any)']['GET'] = 'shop/order/$1';
$route['shop/ordersearch']['GET'] = 'shop/orderSearch';
$route['shop/checkout']['GET'] = 'shop/checkout';
$route['shop/product/(:num)']['GET'] = 'shop/product/$1';
$route['shop']['GET'] = 'shop';
$route['shop/cat/(:num)']['GET'] = 'shop/category/$1';
$route['shop/add']['POST'] = 'shop/add';
$route['shop/cartount']['GET'] = 'shop/getCartItems';
$route['shop/removeItem']['POST'] = 'shop/removeItem';
$route['shop/updatecart']['POST'] = 'shop/updatecart';
$route['shop/checkout-cart']['POST'] = 'shop/checkoutCart';
$route['shop/search/order']['GET'] = 'shop/searchOrder';
$route['shop/getAvailableQty']['GET'] = 'shop/getAvailableQty';
$route['shop/packages']['GET'] = 'shop/packages';

$route['sample'] = 'shop/sample';

$route['default_controller'] = 'shop/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
