<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

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

// PRODUCTS
$route['products']['GET'] = 'products';
$route['products/datatable']['GET'] = 'products/datatable';
$route['products/save']['POST'] = 'products/save';
$route['products/edit']['GET'] = 'products/edit';
$route['products/update']['POST'] = 'products/update';

// PACKAGES
$route['packages']['GET'] = 'packages';
$route['packages/datatable']['GET'] = 'packages/datatable';
$route['packages/save']['POST'] = 'packages/save';
$route['packages/edit']['GET'] = 'packages/edit';
$route['packages/update']['POST'] = 'packages/update';


// FRONTEND
$route['shop/contact']['GET'] = 'contact';
$route['shop/about']['GET'] = 'about';
$route['shop/cart']['GET'] = 'shop/cart';
$route['shop/order']['GET'] = 'shop/order';
$route['shop/orderhistory']['GET'] = 'shop/orderhistory';
$route['shop/checkout']['GET'] = 'shop/checkout';
$route['shop/product/(:num)']['GET'] = 'shop/product/$1';
$route['shop']['GET'] = 'shop';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
