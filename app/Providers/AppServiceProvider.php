<?php

namespace App\Providers;

use App\Models\Adjustmenttype;
use App\Models\Assetstype;
use App\Models\Companyassets;
use App\Models\Customer;
use App\Models\Customerpayment;
use App\Models\Customerreceivepayment;
use App\Models\Damagerecord;
use App\Models\Datacollection;
use App\Models\Department;
use App\Models\Dodocument;
use App\Models\Doexpenses;
use App\Models\Dofinalize;
use App\Models\Dofundespenses;
use App\Models\Empasset;
use App\Models\Empattendence;
use App\Models\Empbankdetails;
use App\Models\Empedudetails;
use App\Models\Empfamilydetails;
use App\Models\Employee;
use App\Models\Employeedoc;
use App\Models\Empworkexperiencedetails;
use App\Models\Expenses;
use App\Models\Expensescategories;
use App\Models\Fuelrecord;
use App\Models\Holiday;
use App\Models\Hrdata;
use App\Models\Hrdatafiles;
use App\Models\Invoice;
use App\Models\Leave;
use App\Models\Loadingproduct;
use App\Models\Manufacturedom;
use App\Models\Manufactureline;
use App\Models\Manufactureproductgroup;
use App\Models\Material;
use App\Models\Materialadjustment;
use App\Models\Materialcategory;
use App\Models\Materialrequest;
use App\Models\Materialstock;
use App\Models\Momaterial;
use App\Models\Notifypaymentschedule;
use App\Models\Overtimecategory;
use App\Models\Overtimerequest;
use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use App\Models\Paymentaccounttype;
use App\Models\Paymentmethods;
use App\Models\Poitems;
use App\Models\Popayment;
use App\Models\Product;
use App\Models\Productstock;
use App\Models\Purchaseorder;
use App\Models\Saledispatch;
use App\Models\Salesorder;
use App\Models\Salesorderitem;
use App\Models\Schedulepayment;
use App\Models\Shelf;
use App\Models\ShelfData;
use App\Models\Stockadjustment;
use App\Models\Supplier;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\Trip;
use App\Models\Unloadingproduct;
use App\Models\Warehouse;
use App\Models\Workday;
use App\Models\Worksheet;
use App\Observers\AassetstypeObserver;
use App\Observers\AdjustmentObserver;
use App\Observers\CompanyassetsObserver;
use App\Observers\CustomerObserver;
use App\Observers\CustomerpaymentObserver;
use App\Observers\CustomerreceiveObserver;
use App\Observers\DamagerecordObserver;
use App\Observers\DatacollectionObserver;
use App\Observers\DepartmentObserver;
use App\Observers\DodocumentObserver;
use App\Observers\DoexpensesObserver;
use App\Observers\DofinalizeObserver;
use App\Observers\DofundexpensesObserver;
use App\Observers\EmpassetObserver;
use App\Observers\EmpattendenceObserver;
use App\Observers\EmpbankObserver;
use App\Observers\EmpeduObserver;
use App\Observers\EmpexperienceObserver;
use App\Observers\EmpfamilyObserver;
use App\Observers\EmployeedocObserver;
use App\Observers\EmployeeObserver;
use App\Observers\ExpensescategoriesObserver;
use App\Observers\ExpensesObserver;
use App\Observers\FuelrecordObserver;
use App\Observers\HolidayObserver;
use App\Observers\HrdatafilesObserver;
use App\Observers\HrdataObserver;
use App\Observers\InvoiceObserver;
use App\Observers\LeaveObserver;
use App\Observers\LoadingproductObserver;
use App\Observers\ManufacturedomObserver;
use App\Observers\ManufacturelineObserver;
use App\Observers\Manufactureproductgroupobserver;
use App\Observers\MaterialadjustmentObserver;
use App\Observers\MaterialcategoryObserver;
use App\Observers\MaterialObserver;
use App\Observers\MaterialrequestObserver;
use App\Observers\MaterialstockObserver;
use App\Observers\MomaterialObserver;
use App\Observers\NotifypaymentscheduleObserver;
use App\Observers\OvertimeObserver;
use App\Observers\OvertimerequestObserver;
use App\Observers\PaymentacchistoryObserver;
use App\Observers\PaymentaccounthistoryObserver;
use App\Observers\PaymentaccountObserver;
use App\Observers\PaymentaccounttypeObserver;
use App\Observers\PaymentmethodsObserver;
use App\Observers\PoitemsObserver;
use App\Observers\PopaymentObserver;
use App\Observers\ProductObserver;
use App\Observers\Productstockobserver;
use App\Observers\PurchaseorderObserver;
use App\Observers\SaledispatchObserver;
use App\Observers\SalesObserver;
use App\Observers\SalesorderitemObserver;
use App\Observers\SchedulepaymentObserver;
use App\Observers\Shelfdataobserver;
use App\Observers\Shelfobserver;
use App\Observers\StockadjustmentObserver;
use App\Observers\SupplierObserver;
use App\Observers\TicketcategoryObserver;
use App\Observers\TicketObserver;
use App\Observers\TripObserver;
use App\Observers\UnloadingObserver;
use App\Observers\WarehouseObserver;
use App\Observers\WorkdayObserver;
use App\Observers\WorksheetObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {


        Employeedoc::observe(EmployeedocObserver::class);
        Employee::observe(EmployeeObserver::class);
        TicketCategory::observe(TicketcategoryObserver::class);
        Empbankdetails::observe(EmpbankObserver::class);
        Empedudetails::observe(EmpeduObserver::class);
        Empfamilydetails::observe(EmpfamilyObserver::class);
        Empworkexperiencedetails::observe(EmpexperienceObserver::class);
        Empasset::observe(EmpassetObserver::class);
        Ticket::observe(TicketObserver::class);
        Leave::observe(LeaveObserver::class);
        Holiday::observe(HolidayObserver::class);
        Workday::observe(WorkdayObserver::class);
        Worksheet::observe(WorksheetObserver::class);
        Empattendence::observe(EmpattendenceObserver::class);
        Assetstype::observe(AassetstypeObserver::class);
        Department::observe(DepartmentObserver::class);
        Companyassets::observe(CompanyassetsObserver::class);
        Expensescategories::observe(ExpensescategoriesObserver::class);
        Paymentmethods::observe(PaymentmethodsObserver::class);
        Expenses::observe(ExpensesObserver::class);
        Datacollection::observe(DatacollectionObserver::class);
        Hrdata::observe(HrdataObserver::class);
        Hrdatafiles::observe(HrdatafilesObserver::class);
        Overtimecategory::observe(OvertimeObserver::class);
        Overtimerequest::observe(OvertimerequestObserver::class);
        Warehouse::observe(WarehouseObserver::class);
        Supplier::observe(SupplierObserver::class);
        Materialcategory::observe(MaterialcategoryObserver::class);
        Material::observe(MaterialObserver::class);
        Purchaseorder::observe(PurchaseorderObserver::class);
        Paymentaccounttype::observe(PaymentaccounttypeObserver::class);
        Paymentaccount::observe(PaymentaccountObserver::class);
        Paymentacchistory::observe(PaymentaccounthistoryObserver::class);
        Poitems::observe(PoitemsObserver::class);
        Popayment::observe(PopaymentObserver::class);
        Adjustmenttype::observe(AdjustmentObserver::class);
        Materialadjustment::observe(MaterialadjustmentObserver::class);
        Materialrequest::observe(MaterialrequestObserver::class);
        Materialstock::observe(MaterialstockObserver::class);
        Momaterial::observe(MomaterialObserver::class);
        Manufactureproductgroup::observe(Manufactureproductgroupobserver::class);
        Product::observe(ProductObserver::class);
        Manufactureline::observe(ManufacturelineObserver::class);
        Manufacturedom::observe(ManufacturedomObserver::class);
        Productstock::observe(Productstockobserver::class);
        Shelf::observe(Shelfobserver::class);
        ShelfData::observe(Shelfdataobserver::class);
        Stockadjustment::observe(StockadjustmentObserver::class);
        Saledispatch::observe(SaledispatchObserver::class);
        Loadingproduct::observe(LoadingproductObserver::class);
        Customer::observe(CustomerObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Salesorder::observe(SalesObserver::class);
        Salesorderitem::observe(SalesorderitemObserver::class);
        Unloadingproduct::observe(UnloadingObserver::class);
        Customerpayment::observe(CustomerpaymentObserver::class);
        Trip::observe(TripObserver::class);
        Fuelrecord::observe(FuelrecordObserver::class);
        Damagerecord::observe(DamagerecordObserver::class);
        Doexpenses::observe(DoexpensesObserver::class);
        Dodocument::observe(DodocumentObserver::class);
        Dofinalize::observe(DofinalizeObserver::class);
        Dofundespenses::observe(DofundexpensesObserver::class);
        Customerreceivepayment::observe(CustomerreceiveObserver::class);
        Schedulepayment::observe(SchedulepaymentObserver::class);
        Notifypaymentschedule::observe(NotifypaymentscheduleObserver::class);

        Paginator::useBootstrapFive();

        $schedule->command('app:receivedstockexp')->everyMinute();
        $schedule->command('app:currentstockcheck')->everyMinute();
        $schedule->command('app:currentproductstock')->everyMinute();
        $schedule->command('app:paymentschedulenotify')->everyMinute();


        \Livewire\Livewire::forceAssetInjection();
    }
}
