<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
Route::get('/development', 'PagesController@development');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/addHousehold', 'PagesController@add_household_member');
Route::get('/viewHousehold', 'PagesController@viewAll');
Route::get('/view/{id}', 'PagesController@viewMember');
Route::get('/medicalRecords', 'PagesController@viewMed');
Route::get('/addMedrec/{id}', 'PagesController@create');
Route::get('/status', 'PagesController@statusView');
Route::get('/addAid', 'PagesController@addAid');
Route::get('/viewAid', 'PagesController@viewAid');
Route::get('/addAid', 'PagesController@addAid');
Route::get('/viewCenters', 'PagesController@viewCenters');
Route::get('/close/{id}', 'EvacuationController@close');
Route::get('/evacHistory', 'PagesController@evacHistory');
//Route::get('/downloadAidWorkers', 'ExcelController@aid_workers');
Route::get('/viewEvacuation/{id}', 'PagesController@viewHist');
Route::get('/downloadEvacs', 'ExcelController@evac_history');
// UPDATED BY CLEM on 10/25
Route::post('/dead/{id}', 'EvacuationController@dead'); 
Route::post('/missing/{id}', 'EvacuationController@missing'); 
Route::post('/found/{id}', 'EvacuationController@found'); // NEW!
Route::post('/sick/{id}', 'EvacuationController@sick'); 
Route::post('/fine/{id}', 'EvacuationController@fine'); 

/* 9-28-18 get */
Route::get('/addCenter', 'PagesController@createCenter');
Route::get('/editStat/{id}', 'PagesController@editStats');
/* 9-30-18 get */
Route::get('/viewInventory', 'PagesController@viewInventory');

Route::get('/viewRequest', 'PagesController@viewRequest'); ##kamandag 
Route::get('/viewCenters', 'PagesController@viewCenters'); ##kamandag 
Route::get('/requestItems', 'PagesController@requestItems'); ##kamandag 
Route::get('/viewAidHere', 'PagesController@viewAidHere'); ##kamandag 
Route::get('/requestAid', 'PagesController@requestAid'); ##kamandag
Route::get('/ViewRequestItemsForm/{id}', 'PagesController@ViewRequestItemsForm'); ## FRESH
Route::get('/deleteItemRequest/{id}', 'ReliefController@deleteRequestItemForm'); #the king
Route::get('/submitItemRequest/{id}', 'ReliefController@submitRequestItemForm');
Route::get('/accountSettings', 'PagesController@accountSettingsPage'); #UI based
Route::get('/editCurrentItem/{id}', 'PagesController@editCurrentItem'); #the king
Route::get('/deleteAnnouncement/{id}', 'AnnouncementController@deleteAnnouncement'); #the king
Route::get('/viewAnnouncement/{id}', 'PagesController@viewAnnouncement'); #the king
Route::get('/editAnnouncement/{id}', 'PagesController@editAnnouncement'); #the king
Route::get('/viewEvacuation/{id}', 'PagesController@viewEvac'); // scott codes
Route::get('/viewpop/{id}', 'PagesController@viewPop'); // scott codes


Route::get('/incomingAid', 'PagesController@incomingAid');
Route::get('/confirmaidArrival/{id}', 'AidController@confirmaidArrival');

//newcodes
Route::get('/writesms', 'PagesController@writesms'); // scott codes
Route::get('/sendsms', 'smsController@itexmo'); // scott codes
Route::post('/sendCSms', 'smsController@customsms'); // scott codes
Route::get('/viewcenters', 'PagesController@map'); // scott 

Route::get('/reactivate', 'PagesController@reactivate');
Route::get('/reactivateAcc/{id}', 'AccountSettingsController@reactivateAccount');

Route::get('/denyAid/{id}', 'AidController@denyAid');
Route::post('/denyAid/{id}', 'AidController@denyAid');

/* 10-4-18 get */ 
Route::get('/createAnnouncement', 'PagesController@createAnnouncement');

Route::get('/cancelAssignment/{assign_id}', 'AidController@cancelAssignment');
/* 10-8-18 get, updated 10/19/18 by fresh */
Route::get('/viewAllRelief', 'PagesController@viewAllRelief'); // fresh 10/19/18
Route::get('/viewReliefOperation/{op_id}', 'PagesController@viewReliefOperation'); //fresh 10/19/18
Route::get('/removeItemReliefPackage/{package_id}/{op_id}', 'ReliefController@removeItemReliefPackage'); //fresh 10/19/18
Route::get('/removeItemDonationPackage/{package_id}/{op_id}', 'InventoryController@removeItemDonationPackage'); //fresh 10/19/18
Route::get('/viewDonations', 'PagesController@viewDonations'); // fresh 10/19/18
Route::get('/viewSelectedDonation/{id}', 'PagesController@viewSelectedDonation'); // fresh 10/19/18
Route::get('/addPackageItemsToInventory/{op_id}', 'InventoryController@addPackageItemsToInventory'); // fresh 10/19/18
Route::get('/cancelReliefOperation/{op_id}', 'ReliefController@cancelReliefOperation'); // fresh 10/19/18
Route::get('/deployReliefOperation/{op_id}', 'ReliefController@deployReliefOperation'); // fresh 10/20/18 7:30 AM
Route::get('/cancelReliefOpDeployment/{op_id}', 'ReliefController@cancelReliefOpDeployment'); // fresh 10/20/18 7:51
Route::get('/cmdViewItemRequests', 'PagesController@cmdViewItemRequests'); // fresh 10/23
Route::get('/cmdOpenRequest/{request_id}', 'PagesController@cmdOpenRequest'); // fresh 10/23
Route::get('/viewSelecetedAidWorker/{worker_id}', 'PagesController@viewSelecetedAidWorker'); // fresh 10/24
Route::get('/declareInactiveAid/{worker_id}', 'AidController@declareInactiveAid'); // fresh 11/04
Route::get('/declareActiveAid/{worker_id}', 'AidController@declareActiveAid'); // fresh 11/04
/* romeo  */
Route::get('/peopleEvacuated', 'PagesController@peopleEvacuated');
Route::get('/peopleMissing', 'PagesController@peopleMissing');
Route::get('/peopleSick', 'PagesController@peopleSick');
Route::get('/peopleDeceased', 'PagesController@peopleDeceased');
/* end of romeo */

Route::post('/cmdRequestApproval/{id}', 'ReliefController@cmdRequestApproval'); // fresh 10/23
Route::post('/assignAidWorker/{worker_id}', 'AidController@assignAidWorker'); // fresh 10/24

/* 10-10-18 by kamandag */ 
Route::get('/evacuateHere','PagesController@evacHere');
Route::get('/assignEvac/{id}', 'EvacuationController@assignThis');
/* 10-10-18 end of kamandag */

Route::get('/deactivateAccount/{house_id}', 'AccountSettingsController@deactivate'); //clem codes as of 11-7-18
/* 10-14-18 kamandag */

Route::get('/manageAid', 'PagesController@manageAid'); //kamandag
Route::get('/assignThis/{id}/{centerid}/{worker_id}/', 'AidController@assignThis'); //kamandag
Route::post('/assignThis/{id}/{centerid}/{worker_id}/', 'AidController@assignThis'); //kamandag
Route::get('/pendingItems', 'PagesController@viewPending'); //kamandag
/* 10-16 kamandag */
Route::get('/lists/{id}', 'PagesController@lists'); //kamandag
Route::get('/approveaid/{id}', 'AidController@approveaid'); //kamandag
Route::post('/approveaid/{id}', 'AidController@approveaid'); //kamandag
Route::get('/denyAid/{id}', 'AidController@denyAid');  //kamandag new
Route::get('/recallaid/{id}', 'AidController@recallaid'); //kamandag new
/* 10-19-18 kamandag */
Route::post('/updateAccountSettings/{id}', 'AccountSettingsController@updateAccountSettings');
Route::get('/incomingRelief', 'PagesController@incoming');
Route::get('/confirmArrive/{id}', 'ReliefController@confirmArrival');

Route::get('/aa/{id}', 'AidController@redirectaid');
Route::get('/evacueeEdit/{id}', 'PagesController@evacueeEdit');
Route::post('/evacueeEdit/{id}', 'EvacuationController@evacueeUpdate');
Route::post('/editevacueeMed/{id}', 'EvacuationController@updateMed');
Route::post('/addevacMed/{id}', 'EvacuationController@evacueemedAdd');
Route::get('/updateDonationPackagePage/{id}', 'PagesController@updateDonationPackagePage'); // Fresh 10/23
Route::get('/deleteDonation/{id}', 'InventoryController@deleteDonation');
Route::post('/updateDonationPackage/{id}', 'InventoryController@updateDonationPackage'); // Fresh 10/23
Route::post('/addItemReliefPackage/{op_id}', 'ReliefController@addItemReliefPackage'); //fresh
Route::post('/newReliefOperation', 'ReliefController@newReliefOperation'); // fresh
Route::post('/newDonation', 'InventoryController@newDonation'); // fresh
Route::post('/addItemToInventory', 'InventoryController@addItemToInventory'); // fresh 10/28
Route::post('/addItemPackage/{op_id}', 'InventoryController@addItemDonation'); //fresh
Route::post('/editItemPackage/{package_id}', 'ReliefController@editItemPackage'); // fresh 10/20/18 22:12

/* 10-4-18 post */ 
Route::post('/AnnounceCreate', 'AnnouncementController@store');

/* 9-30-18 post */
Route::post('/updateInventory/{id}', 'InventoryController@update');
Route::post('/createCenter', 'CenterController@store');
Route::post('/updateStat/{id}', 'StatusController@update');

Route::post('/requestAid', 'AidController@requestAid'); ##kamandag 
Route::post('/requestItems', 'ReliefController@requestForm'); ##kamandag -> edit by Fresh
Route::post('/requestSelectNewItem/{request_form_id}', 'ReliefController@requestSelectNewItem'); ## FRESH
Route::post('/updateCurrentItem/{id}', 'ReliefController@updateCurrentItem'); #the king
Route::post('/updateAnnouncement/{id}', 'AnnouncementController@update'); #the king

Route::post('/addAid', 'AidController@addaid');
Route::post('/updateAid/{id}', 'AidController@update');
Route::post('/createMedrec','MedicalRecordController@store'); 
Route::post('/updateMedRec/{id}', 'MedicalRecordController@update');
Route::post('/updateHousehold/{id}', 'HouseholdController@update');
Route::post('/openEvac', 'EvacuationController@open'); //I made this - Clem
Route::post('/createHousehold', 'HouseholdController@store');
Route::post('/pages', 'RegistrationController@store');
Route::post('/', 'PagesController@index');

Auth::routes();

//for chat feature
Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');