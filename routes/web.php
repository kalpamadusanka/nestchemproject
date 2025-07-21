<?php

use App\Livewire\Admin\Dashboard\Dep\Accounts\Accountsdashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Assest\Assestdashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Customeraccdashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Paymentmanage\Paymentmanagedashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Viewpaymentdashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Schedulepayment\Schedulepaymentdashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Doreceivedashboard;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Fulldoview;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Fund\Dofund;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Accountbook\Paymenthistory;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Paymentaccount;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Type\Accounttype;
use App\Livewire\Admin\Dashboard\Dep\Accounts\Trialbalance\Trialsheet;
use App\Livewire\Admin\Dashboard\Dep\Humanresource;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Assettype\Assetstypes;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Companyassets;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Department\Adddepartment;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Attendencedashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Monitorattendence\Attendencemonitordashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Collection\Collectiondashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Datadashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Addemployee;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee\Empdoc\Documentview;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee\Emplist;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Profile;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Expensecategory\Expensecategorydashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Expensesdashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Paymentmethods\Paymentmethoddashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Loanadvance\Loanadvancedashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Overtime\Overtimedashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets\Alltickets;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets\Viewallticket\Viewtickets;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Holiday\Holidaydashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Workdashboard;
use App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Workingdays\Workdaydashboard;
use App\Livewire\Admin\Dashboard\Dep\Manufacture\Creating\Creatingdashboard;

use App\Livewire\Admin\Dashboard\Dep\Manufacture\Creating\Order\Createmanufactureorder;
use App\Livewire\Admin\Dashboard\Dep\Manufacture\Manufacturedashboard;
use App\Livewire\Admin\Dashboard\Dep\Manufacture\Material\Add\Addmaterialrequest;
use App\Livewire\Admin\Dashboard\Dep\Manufacture\Material\Requestdashboard;
use App\Livewire\Admin\Dashboard\Dep\Product\Adjustment\Productadjustment;
use App\Livewire\Admin\Dashboard\Dep\Product\Productdashboard;
use App\Livewire\Admin\Dashboard\Dep\Product\Productgroup\Productgroupdashboard;
use App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Addproduct;
use App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Productshowdashboard;
use App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Shelf\Shelfdashboard;
use App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Viewproductstockdashboard;
use App\Livewire\Admin\Dashboard\Dep\Production;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment\Adjustmentdashboard;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment\Type\Adjustmenttypedashboard;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Category\Mcategorydashboard;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Materialdashboard;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Request\Materialrequest;
use App\Livewire\Admin\Dashboard\Dep\Production\Material\Warehouse\Warehousedashboard;

use App\Livewire\Admin\Dashboard\Dep\Production\Po\Create\Addpurchaseorder;
use App\Livewire\Admin\Dashboard\Dep\Production\Po\Podashboard;
use App\Livewire\Admin\Dashboard\Dep\Production\Record\Materialhistory;
use App\Livewire\Admin\Dashboard\Dep\Production\Supplier\Supplierdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Customer\Add\Customeradd;
use App\Livewire\Admin\Dashboard\Dep\Sales\Customer\Customerlistdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Distributedashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Add\Addorder;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Doordersdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Expenses\Expensesdashboard as ExpensesExpensesdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Payment\Paymentdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Track\Trackingorder;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Vehicleinfodashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Track\Trackdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Do\Dodashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Load\Loadingdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Load\Loadproduct\Ongoingloading;
use App\Livewire\Admin\Dashboard\Dep\Sales\Salesdashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Unload\Ongoingunload;
use App\Livewire\Admin\Dashboard\Dep\Sales\Unload\Unloaddashboard;
use App\Livewire\Admin\Dashboard\Dep\Sales\Unload\Unloadproduct\Ongoingunloading;
use App\Livewire\Admin\Dashboard\Home\Index;
use App\Livewire\Admin\Dashboard\Systemuser\Adminmanagement;
use App\Livewire\Admin\Login\Logingadmin;

use Illuminate\Support\Facades\Route;

Route::get('neo/dashboard',Index::class)->name('admin.dashboard');
Route::get('neo/admin/manage',Adminmanagement::class)->name('admin.systemuser.manage');
Route::get('neo/admin/login',Logingadmin::class)->name('admin.login');

Route::get('neo/admin/dashboard/dep/production',Production::class)->name('admin.dashboard.dep.production');
Route::get('neo/admin/dashboard/dep/hr',Humanresource::class)->name('admin.dashboard.dep.human.resource');

///////employee///////////
Route::get('neo/admin/dashboard/dep/hr/employee/add-employee',Addemployee::class)->name('admin.dashboard.dep.human.resource.employee.addemployee');
Route::get('neo/admin/dashboard/dep/hr/employee/view-employee',Emplist::class)->name('neo.existing.employee.view');
Route::get('neo/admin/dashboard/dep/hr/employee/view-employee-doc',Documentview::class)->name('neo.existing.employee.view.document');
Route::get('neo/admin/dashboard/dep/hr/employee/view-employee-profile',Profile::class)->name('neo.existing.employee.view.profile');

///////employee///////////

Route::get('neo/admin/dashboard/dep/hr/tickets/alltickets',Alltickets::class)->name('admin.dashboard.dep.human.resource.tickets.alltickets');
Route::get('neo/admin/dashboard/dep/hr/tickets/view/alltickets',Viewtickets::class)->name('admin.dashboard.dep.human.resource.tickets.view.alltickets');

////////attendence////////
Route::get('neo/admin/dashboard/dep/hr/attendence',Attendencedashboard::class)->name('admin.dashboard.dep.human.resource.employee.attendence');
Route::get('neo/admin/dashboard/dep/hr/attendence/monitor',Attendencemonitordashboard::class)->name('admin.dashboard.humanresource.attendence.attendencemonitor');


////////worksheet///////
Route::get('neo/admin/dashboard/dep/hr/worksheet',Workdashboard::class)->name('admin.dashboard.dep.human.resource.employee.worksheet');
Route::get('neo/admin/dashboard/dep/hr/worksheet/holiday',Holidaydashboard::class)->name('admin.dashboard.dep.human.resource.worksheet.holiday');
Route::get('neo/admin/dashboard/dep/hr/worksheet/workday',Workdaydashboard::class)->name('admin.dashboard.dep.human.resource.worksheet.workday');


////////company assets///////
Route::get('neo/admin/dashboard/dep/hr/assets',Companyassets::class)->name('admin.dashboard.dep.human.resource.company.assets');
Route::get('neo/admin/dashboard/dep/hr/assets/assets-type',Assetstypes::class)->name('admin.dashboard.dep.human.resource.company.assets.add.types');
Route::get('neo/admin/dashboard/dep/hr/assets/department',Adddepartment::class)->name('admin.dashboard.dep.human.resource.company.assets.add.department');




/////////expenses//////////////
Route::get('neo/admin/dashboard/dep/hr/expenses',Expensesdashboard::class)->name('admin.dashboard.dep.human.resource.company.expenses');

///////expensecategory///////
Route::get('neo/admin/dashboard/dep/hr/expenses/expensescategory',Expensecategorydashboard::class)->name('admin.dashboard.humanresource.expenses.expensecategory.dashboard');

///////payment methods///////
Route::get('neo/admin/dashboard/dep/hr/expenses/payment-methods',Paymentmethoddashboard::class)->name('admin.dashboard.humanresource.expenses.payment.methods.dashboard');


///////expenses///////////////


/////data collection/////////
Route::get('neo/admin/dashboard/dep/hr/data/collection',Datadashboard::class)->name('admin.dashboard.dep.human.resource.data.collection');
Route::get('neo/admin/dashboard/dep/hr/data/collection/collection-dashboard',Collectiondashboard::class)->name('admin.dashboard.dep.human.resource.datacollection.collection');


///////overtime////////////

Route::get('neo/admin/dashboard/dep/hr/overtime',Overtimedashboard::class)->name('admin.dashboard.dep.human.resource.overtime');

////////////////HUMAN RESOURCE///////////////////////////////////////////////////////////



////////////////PRODUCTION///////////////////////////////////////////////////////////

Route::get('neo/admin/dashboard/dep/production/material/index',Materialdashboard::class)->name('admin.dashboard.dep.production.material.dashboard');

Route::get('neo/admin/dashboard/dep/production/warehouse/index',Warehousedashboard::class)->name('admin.dashboard.dep.production.warehouse.dashboard');

Route::get('neo/admin/dashboard/dep/production/supplier/index',Supplierdashboard::class)->name('admin.dashboard.dep.production.supplier.dashboard');

Route::get('neo/admin/dashboard/dep/production/material/category/category-dashboard',Mcategorydashboard::class)->name('admin.dashboard.dep.production.material.category');

Route::get('neo/admin/dashboard/dep/production/material/purchase/po-dashboard',Podashboard::class)->name('admin.dashboard.dep.production.po.dashboard');

Route::get('neo/admin/dashboard/dep/production/material/purchase/create-po',Addpurchaseorder::class)->name('admin.dashboard.dep.production.po.create.po');

Route::get('neo/admin/dashboard/dep/accounts/dashboard',Accountsdashboard::class)->name('admin.dashboard.dep.accounts.dashboard');
Route::get('neo/admin/dashboard/dep/customer/schedule/payment/dashboard',Schedulepaymentdashboard::class)->name('admin.dashboard.accounts.customer.schedule.payment.dashboard');


Route::get('neo/admin/dashboard/dep/accounts/payment-accounts',Paymentaccount::class)->name('admin.dashboard.dep.account.payment.account');

Route::get('neo/admin/dashboard/dep/accounts/account-type',Accounttype::class)->name('admin.dashboard.accounts.paymentaccount.type');

Route::get('neo/admin/dashboard/dep/accounts/account-book/{account_id}',Paymenthistory::class)->name('neo.payment.account.history');

Route::get('neo/admin/dashboard/dep/accounts/do/receive',Doreceivedashboard::class)->name('admin.dashboard.accounts.do.receiving');
Route::get('neo/do/view/{encryptedDoNo}', Fulldoview::class)->name('admin.dashboard.accounts.do.view');


Route::get('neo/admin/dashboard/production/material/{material_id}',Adjustmentdashboard::class)->name('neo.material.stock.adjustment');

Route::get('neo/admin/dashboard/production/material/adjustment/adjustment-type',Adjustmenttypedashboard::class)->name('admin.dashboard.material.adjustment.type');

Route::get('neo/admin/dashboard/production/history',Materialhistory::class)->name('admin.dashboard.dep.production.material.record.history');

Route::get('neo/admin/dashboard/production/material/request/list',Materialrequest::class)->name('admin.dashboard.dep.production.material.request.list');

/////////manufacture/////////

Route::get('neo/admin/dashboard/manufacture/dashboard',Manufacturedashboard::class)->name('admin.dashboard.dep.manufacture');

Route::get('neo/admin/dashboard/manufacture/material/request/dashboard',Requestdashboard::class)->name('admin.dashboard.dep.manufacture.material.request.dashboard');

Route::get('neo/admin/dashboard/manufacture/material/add/request',Addmaterialrequest::class)->name('admin.dashboard.material.add.request');

Route::get('neo/admin/dashboard/manufacture/creating/dashboard',Creatingdashboard::class)->name('admin.dashboard.dep.manufacture.creating.manufacture.dashboard');

Route::get('neo/admin/dashboard/manufacture/creating/manufacture/new-order',Createmanufactureorder::class)->name('admin.dashboard.creating.new.manufacture.order');

/////product//////
Route::get('neo/admin/dashboard/product/dashboard',Productdashboard::class)->name('admin.dashboard.dep.product');

Route::get('neo/admin/dashboard/product/group/dashboard',Productgroupdashboard::class)->name('admin.dashboard.dep.product.product.group.dashboard');

Route::get('neo/admin/dashboard/account/do/fund',Dofund::class)->name('admin.dashboard.accounts.do.funds');
Route::get('neo/admin/dashboard/account/customer/dashboard',Customeraccdashboard::class)->name('admin.dashboard.accounts.customer.account.dashboard');
Route::get('neo/admin/account/customer/payment/view/{encryptedcusId}', Viewpaymentdashboard::class)->name('admin.dashboard.accounts.customer.payments.view');



Route::get('neo/admin/dashboard/productdashboard',Productshowdashboard::class)->name('admin.dashboard.dep.manufacture.product.dashboard');
Route::get('neo/admin/dashboard/add/product',Addproduct::class)->name('admin.dashboard.dep.manufacture.add.product');
Route::get('neo/admin/dashboard/adjustment/product',Productadjustment::class)->name('admin.dashboard.dep.product.adjustment');


Route::get('neo/admin/dashboard/view/product/stock/{productid}',Viewproductstockdashboard::class)->name('admin.dashboard.stock.view');
Route::get('neo/admin/dashboard/shelf/manage',Shelfdashboard::class)->name('admin.dashboard.dep.product.shelf.dashboard');

Route::get('neo/admin/dashboard/sales',Salesdashboard::class)->name('admin.dashboard.dep.sale');
Route::get('neo/admin/dashboard/sales/do/dashboard',Dodashboard::class)->name('admin.dashboard.dep.sale.do');

Route::get('neo/admin/dashboard/sales/do/load',Loadingdashboard::class)->name('admin.dashboard.dep.sale.do.load');

Route::get('neo/admin/dashboard/sale/do/load/product/{do_no}',Ongoingloading::class)->name('admin.sale.do.load');

Route::get('neo/admin/dashboard/sale/customer/list',Customerlistdashboard::class)->name('admin.dashboard.dep.sale.customer.list.dashboard');
Route::get('neo/admin/dashboard/sale/customer/add',Customeradd::class)->name('admin.dashboard.sale.customer.register');

Route::get('neo/admin/dashboard/sale/distribute',Distributedashboard::class)->name('admin.dashboard.dep.sale.distribute');

Route::get('neo/admin/dashboard/sale/distribute/track',Trackdashboard::class)->name('admin.dashboard.dep.sale.track');
Route::get('/admin/sale/do/{do_no}/orders', Doordersdashboard::class)->name('admin.sale.do.orders');

Route::get('/admin/sale/do/{do_no}/vehicle/dashboard', Vehicleinfodashboard::class)->name('admin.sale.do.vehicle.dashboard');
Route::get('/admin/sale/do/{do_no}/expenses/dashboard', ExpensesExpensesdashboard::class)->name('admin.sale.do.expenses.dashboard');


Route::get('/admin/sale/do/{do_no}/add/orders', Addorder::class)->name('admin.sale.do.add.order');
Route::get('/admin/sale/do/{saleorder}/track/order', Trackingorder::class)->name('admin.sale.do.order.track');

Route::get('neo/admin/dashboard/sale/unload',Unloaddashboard::class)->name('admin.dashboard.dep.sale.unload');




Route::get('neo/admin/dashboard/sale/do/unload/product/{do_no}',Ongoingunloading::class)->name('admin.sale.do.unload');

Route::get('/admin/sale/do/{saleorder}/payment', Paymentdashboard::class)->name('admin.sale.do.order.payments');


Route::get('/admin/dep/account/paymentmanage/dashboard', Paymentmanagedashboard::class)->name('admin.dashboard.accounts.customer.unallocated.payments');

Route::get('/admin/dep/humanresource/dashboard', Loanadvancedashboard::class)->name('admin.dashboard.dep.human.resource.loan.advance.dashboard');

Route::get('/admin/dep/account/assets', Assestdashboard::class)->name('admin.dashboard.accounts.assest.dashboard');



Route::get('/admin/dep/account/trial-balance', Trialsheet::class)->name('admin.dashboard.accounts.trial.balance');
