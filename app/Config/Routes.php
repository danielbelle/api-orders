<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
/*
$routes->group("api", ["namespace" => "App\Controllers\Api"], function($routes){

	$routes->post("register", "ApiController::userRegister");
	$routes->post("login", "ApiController::userLogin");
	$routes->get("profile", "ApiController::userProfile");

	$routes->post("create-product", "ApiController::createProduct");
	$routes->get("list-products", "ApiController::listProducts");
	$routes->get("single-product/(:num)", "ApiController::singleProductDetail/$1");
	$routes->put("update-product/(:num)", "ApiController::updateProduct/$1");
	$routes->delete("delete-product/(:num)", "ApiController::deleteProduct/$1");

	$routes->post("create-customer", "ApiController::createCustomer");
	$routes->get("list-customers", "ApiController::listCustomers");
	$routes->get("single-customer/(:num)", "ApiController::singleCustomerDetail/$1");
	$routes->put("update-customer/(:num)", "ApiController::updateCustomer/$1");
	$routes->delete("delete-customer/(:num)", "ApiController::deleteCustomer/$1");

	$routes->post("create-order", "ApiController::createOrder");
	$routes->get("list-orders", "ApiController::listOrders");
	$routes->get("single-order/(:num)", "ApiController::singleOrderDetail/$1");
	$routes->put("update-order/(:num)", "ApiController::updateOrder/$1");
	$routes->delete("delete-order/(:num)", "ApiController::deleteOrder/$1");
});*/

// CRUD Routes Student

$routes->group("student", ["namespace" => "App\Controllers"], function($routes){
	$routes->get('', 'Student::index');
	$routes->post('store', 'Student::store');
	$routes->get('edit/(:num)', 'Student::edit/$1');
	$routes->get('/delete/(:num)', 'Student::delete/$1');
	$routes->post('update', 'Student::update');
});

// CRUD Routes Customer
$routes->group("customer", ["namespace" => "App\Controllers"], function($routes){
	$routes->get('', 'Customer::index');
	$routes->post('store', 'Customer::store');
	$routes->get('edit/(:num)', 'Customer::edit/$1');
	$routes->get('delete/(:num)', 'Customer::delete/$1');
	$routes->post('update', 'Customer::update');
});

// CRUD Routes Product
$routes->group("product", ["namespace" => "App\Controllers"], function($routes){
	$routes->get('', 'Product::index');
	$routes->post('store', 'Product::store');
	$routes->get('edit/(:num)', 'Product::edit/$1');
	$routes->get('delete/(:num)', 'Product::delete/$1');
	$routes->post('update', 'Product::update');
});
// CRUD Routes Order
$routes->group("order", ["namespace" => "App\Controllers"], function($routes){
	$routes->get('order', 'Order::index');
	$routes->post('store', 'Order::store');
	$routes->get('edit/(:num)', 'Order::edit/$1');
	$routes->get('delete/(:num)', 'Order::delete/$1');
	$routes->post('update', 'Order::update');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
