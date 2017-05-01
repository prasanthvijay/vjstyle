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
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'Frontend';
$route['Sales_controller'] = 'sales';
$route['Product_controller'] = 'Product';
$route['dashboard'] = 'Frontend/dashboard';
$route['checkLogin'] = 'Frontend/checkLogin';
$route['logout'] = 'Frontend/logout';
//User Masters
$route['adminMaster'] = 'Frontend/adminMaster';
$route['retailerShowRoomMaster'] = 'Frontend/retailerShowRoomMaster';
$route['salesHeadMaster'] = 'Frontend/salesHeadMaster';
$route['salesExecutiveMaster'] = 'Frontend/salesExecutiveMaster';
$route['supplierMaster'] = 'Frontend/supplierMaster';
$route['addUserMaster'] = 'Frontend/addUserMaster';
$route['getUserListDetails'] = 'Frontend/getUserListDetails';
$route['getRetailerShowRoomDetails'] = 'Frontend/getRetailerShowRoomDetails';
$route['getAddOrEditUserMasterContent'] = 'Frontend/getAddOrEditUserMasterContent';
$route['deleteUsersFromMaster'] = 'Frontend/deleteUsersFromMaster';
$route['editProfile'] = 'Frontend/editProfile';
$route['forgotPassword'] = 'Frontend/forgotPassword';
$route['productSearch'] = 'Product/productSearch';
$route['ViewRetailerCostDetails'] = 'Product/ViewRetailerCostDetails';
$route['mapRetailerProductCostAndQuantityUrl'] = 'Product/mapRetailerProductCostAndQuantityUrl';

//Product
$route['EditProduct'] = 'Product/EditProduct';
$route['addProductMaster'] = 'Product/addProductMaster';
$route['AddBrand'] = 'Product/AddBrand';
$route['BrandList'] = 'Product/BrandList';
$route['ProductMaster'] = 'Product/ProductMaster';
$route['BrandMaster'] = 'Product/BrandMaster';
$route['CategoryTypeMaster'] = 'Product/CategoryTypeMaster';
$route['SubCategoryMaster'] = 'Product/SubCategoryMaster';
$route['AddOrEditSubCategory'] = 'Product/AddOrEditSubCategory';
$route['AddOrEditMasterContent'] = 'Product/AddOrEditMasterContent';
$route['SizeMaster'] = 'Product/SizeMaster';
$route['AddSize'] = 'Product/AddSize';
$route['MapProduct'] = 'Product/MapProduct';
$route['assignMapProduct'] = 'Product/assignMapProduct';
$route['getContent'] = 'Product/getContent';
$route['migrationProduct'] = 'Product/migrationProduct';
$route['generateBarcdeExcel'] = 'Product/generateBarcdeExcel';
$route['Attendance'] = 'Product/Attendance';
$route['dailyexpenses'] = 'Product/dailyexpenses';
$route['AddExpenses'] = 'Product/AddExpenses';
$route['Maintenance'] = 'Product/Maintenance';
$route['MaintenanceMaster'] = 'Product/MaintenanceMaster';
$route['mobilePage'] = 'Product/mobilePage';
$route['Migration'] = 'Product/Migration';
$route['dailyPayment'] = 'Product/dailyPayment';

//Sales
$route['pos'] = 'sales/pos';
$route['posajax'] = 'sales/posajax';
$route['receipt'] = 'sales/receipt/$1';
$route['returnpos'] = 'sales/returnpos';
$route['returnposajax'] = 'sales/returnposajax';
$route['reports'] = 'sales/reports/$1';
$route['reportsajax']='sales/reportsajax';
$route['lowstockReport']='sales/lowstockReport';
$route['getReportInLowStock']='sales/getReportInLowStock';
$route['returnList']='sales/returnList';
$route['generateLowstockReport']='sales/generateLowstockReport';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'Frontend';
