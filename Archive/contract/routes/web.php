<?php

use Illuminate\Support\Facades\Route;
use App\Models\CmsPage;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('clear_cache', function () {
//     //\Artisan::call('cache:clear');
//     \Artisan::call('config:cache');
//     dd("Cache is cleared");
// });

Route::get('forget-password', [ App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [App\Http\Controllers\Front\HomeController::class,'index'])->name('home');

Route::get('/signin', [App\Http\Controllers\Front\HomeController::class,'login_page'])->name('loginPage');
Route::post('front/login', [App\Http\Controllers\Front\HomeController::class,'frontLogin'])->name('front/login');
Route::get('/signup', [App\Http\Controllers\Front\RegisterController::class,'signup'])->name('frontSignup');
Route::post('front/store-user', [App\Http\Controllers\Front\RegisterController::class,'saveUser'])->name('saveUserData');
Route::post('front/store-subscriber', [App\Http\Controllers\Front\SubsController::class,'storeSubscriber'])->name('saveSubscriberData');
Route::get('/pricing', [App\Http\Controllers\Front\HomeController::class,'pricing'])->name('pricing');
Route::post('front/store-contact', [App\Http\Controllers\Front\ContactUsController::class,'saveContact'])->name('saveContactData');
Route::get('/contract-sub-categorie-data/{id}', [App\Http\Controllers\Front\ContractController::class,'getsubCategorie'])->name('contract.subCategorieTypeData');




// Route::get('/', 'Front\HomeController@index')->name('home');

Route::get('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class,'login'])->name('login');
Route::post('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class,'adminLogin'])->name('adminLogin');


Auth::routes();
$cms_pages = CmsPage::where('status', 1)->get();
foreach ($cms_pages as $cms) {
	Route::get($cms->page_slug, [App\Http\Controllers\Front\CmsController::class,'index']);
}
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('/dashboard', [App\Http\Controllers\Admin\AdminHomeController::class, 'homeAdmin'])->name('dashboard');
    // Route::post('logout', [App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name('logout');
Route::group(['prefix' => 'front'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Front\ClientController::class,'index'])->name('client.dashboard');
    Route::get('/newsletter', [App\Http\Controllers\Front\NewsLetterController::class,'newsletter'])->name('client.newsletter');
    Route::get('/change-password', [App\Http\Controllers\Front\ClientController::class, 'changePassword'])->name('clientChangePassword');
    Route::post('/change-password', [App\Http\Controllers\Front\ClientController::class, 'updatePassword'])->name('client-update-password');
    Route::get('/logout', [App\Http\Controllers\Front\HomeController::class,'frontLogout']);    
    Route::get('/contract-list', [App\Http\Controllers\Front\ContractController::class,'index']);    
    Route::get('/contract-type/{id}', [App\Http\Controllers\Front\ContractController::class,'contractType'])->name('contract.type');    
    Route::get('/contract-sub-categorie/{id}', [App\Http\Controllers\Front\ContractController::class,'getsubCategorie'])->name('contract.subCategorieType');
    Route::get('/contract/{id}', [App\Http\Controllers\Front\ContractController::class, 'contractData'])->name('contract');
    Route::post('/store/template', [App\Http\Controllers\Front\ContractController::class, 'saveTemplateDetail'])->name('contract.saveTemplate');
    Route::post('/notstore/template', [App\Http\Controllers\Front\ContractController::class, 'backWithNotsaveTemplateDetail'])->name('contract.notSaveTemplate');
    Route::post('/preview', [App\Http\Controllers\Front\ContractController::class, 'preview'])->name('contract.preview');
    Route::get('/previewContract/{id}/{contract_data_id}', [App\Http\Controllers\Front\ContractController::class,'previewContract']);  
    

    Route::post('/update/template', [App\Http\Controllers\Front\ContractController::class, 'updateTemplate'])->name('contract.updateTemplate');

    Route::post('/product_checkout', [App\Http\Controllers\Front\StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::get('/success_payment/{pay_id}', [App\Http\Controllers\Front\StripePaymentController::class, 'success_payment']);
    Route::get('/user/success_payment/{pay_id}', [App\Http\Controllers\Front\StripePaymentController::class, 'user_success_payment']);

    Route::get('/profile', [App\Http\Controllers\Front\ClientController::class, 'profile']);
    Route::post('/profile/update', [App\Http\Controllers\Front\ClientController::class, 'profileUpdate'])->name('profile.update');
    
    Route::get('/viewContract/{id}', [App\Http\Controllers\Front\ContractController::class,'viewContract']);  
    Route::get('/user_contract_list', [App\Http\Controllers\Front\ContractController::class,'createdContractList']);  
    
    Route::get('/edit_contract/{id}', [App\Http\Controllers\Front\ContractController::class, 'editContract'])->name('contract.edit');

    Route::post('/review/contract', [App\Http\Controllers\Front\ContractController::class, 'reviewContract'])->name('contract.review');
    Route::post('/edit/contract/review', [App\Http\Controllers\Front\ContractController::class, 'editContractReview'])->name('edit.contract.review');
    Route::post('/submit-contract', [App\Http\Controllers\Front\ContractController::class, 'submitContract'])->name('submit.contract');

    
    
    
    Route::post('/send-contract', [App\Http\Controllers\Front\SendContractController::class,'sendContract'])->name('send.contract');
    Route::get('/send-contract-page/{id}', [App\Http\Controllers\Front\SendContractController::class, 'sendContractPage'])->name('send.contract.page');
    Route::get('/manage_document', [App\Http\Controllers\Front\SendContractController::class, 'index'])->name('manage_document');

    
    Route::get('/download_contract/{id}', [App\Http\Controllers\Front\SendContractController::class, 'downloadContract'])->name('download_contract');
    Route::post('/store/contract_type', [App\Http\Controllers\Front\ContractController::class, 'saveContractTypeDetail'])->name('contract.saveContractType');
    
});
Route::group(['middleware' => ['auth', 'admin','revalidate'], 'prefix' => 'admin'], function () {

    // Route::get('/dashboard', [App\Http\Controllers\Admin\AdminHomeController::class, 'homeAdmin'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\Admin\ClientManagementController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name('logout');
    
    //CMS Page
    Route::get('/cms_pages', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('cms_pages');
    Route::get('/add_cms', [App\Http\Controllers\Admin\CmsController::class, 'create'])->name('add_cms');
	Route::post('/store_cms_page', [App\Http\Controllers\Admin\CmsController::class, 'store'])->name('store_cms_page');
    Route::post('/cms_page_check_slug', [App\Http\Controllers\Admin\CmsController::class, 'checkSlug'])->name('cms_page_check_slug');
    Route::get('/edit_cms_page/{id}', [App\Http\Controllers\Admin\CmsController::class, 'edit'])->name('edit_cms_page');
    Route::get('/delete_cms_page/{id}', [App\Http\Controllers\Admin\CmsController::class, 'destroy'])->name('delete_cms_page');
    Route::post('/update_cms_page/{id}', [App\Http\Controllers\Admin\CmsController::class, 'update'])->name('update_cms_page');
   
    //Client Management
    Route::get('/client_management', [App\Http\Controllers\Admin\ClientManagementController::class, 'index'])->name('client_management');
    Route::get('/add_client', [App\Http\Controllers\Admin\ClientManagementController::class, 'create'])->name('add_client');
    Route::post('/store_client', [App\Http\Controllers\Admin\ClientManagementController::class, 'store'])->name('store_client');
    Route::get('/edit_client/{id}', [App\Http\Controllers\Admin\ClientManagementController::class, 'edit'])->name('edit_client');
    Route::post('/update_client/{id}', [App\Http\Controllers\Admin\ClientManagementController::class, 'update'])->name('update_client');
    Route::get('/delete_client/{id}', [App\Http\Controllers\Admin\ClientManagementController::class, 'destroy'])->name('delete_client');
    Route::get('/profile', [App\Http\Controllers\Admin\ClientManagementController::class, 'profile'])->name('profile');
    Route::get('/change-password', [App\Http\Controllers\Admin\ClientManagementController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [App\Http\Controllers\Admin\ClientManagementController::class, 'updatePassword'])->name('update-password');
    Route::post('/profile-update/{id}', [App\Http\Controllers\Admin\ClientManagementController::class, 'profileUpdate'])->name('profile-update');

    //Client Management
    Route::get('/transaction_management', [App\Http\Controllers\Admin\TransactionManagementController::class, 'index'])->name('transaction_management');
    Route::get('/view_transaction/{id}', [App\Http\Controllers\Admin\TransactionManagementController::class, 'show'])->name('view_transaction');
    
    
    //Testimonials Management
    Route::get('/testimonial_management', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'index'])->name('testimonial_management');
    Route::get('/add_testimonial', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'create'])->name('add_testimonial');
    Route::post('/store_testimonial', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'store'])->name('store_testimonial');
    Route::get('/edit_testimonial/{id}', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'edit'])->name('edit_testimonial');
    Route::post('/update_testimonial/{id}', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'update'])->name('update_testimonial');
    Route::get('/delete_testimonial/{id}', [App\Http\Controllers\Admin\TestimonialsManagementController::class, 'destroy'])->name('delete_testimonial');

    //Testimonials Management
    Route::get('/team_management', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'index'])->name('team_management');
    Route::get('/add_team', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'create'])->name('add_team');
    Route::post('/store_team', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'store'])->name('store_team');
    Route::get('/edit_team/{id}', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'edit'])->name('edit_team');
    Route::post('/update_team/{id}', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'update'])->name('update_team');
    Route::get('/delete_team/{id}', [App\Http\Controllers\Admin\TeamMemberManagementController::class, 'destroy'])->name('delete_team');
    
    //Contract Management
    Route::get('/contract_management', [App\Http\Controllers\Admin\ContractManagementController::class, 'index'])->name('contract_management');
    Route::get('/add_contract', [App\Http\Controllers\Admin\ContractManagementController::class, 'create'])->name('add_contract');
    Route::post('/store_contract', [App\Http\Controllers\Admin\ContractManagementController::class, 'store'])->name('store_contract');
    Route::get('/edit_contract/{id}', [App\Http\Controllers\Admin\ContractManagementController::class, 'edit'])->name('edit_contract');
    Route::post('/update_contract/{id}', [App\Http\Controllers\Admin\ContractManagementController::class, 'update'])->name('update_contract');
    Route::get('/delete_contract/{id}', [App\Http\Controllers\Admin\ContractManagementController::class, 'destroy'])->name('delete_contract');
	Route::get('/getSubCategoryFromParent', [App\Http\Controllers\Admin\ContractManagementController::class, 'getSubCategoryFromParent'])->name('get_child_category');

    Route::get('/change_doc_data/{id}', [App\Http\Controllers\Admin\ContractManagementController::class, 'changeDocData'])->name('contractDataChange');

    Route::get('/template_management', [App\Http\Controllers\Admin\TemplateManagementController::class, 'index'])->name('template_management');
    Route::get('/template/create', [App\Http\Controllers\Admin\TemplateManagementController::class, 'templatePageCreate'])->name('template_create');
    Route::post('/store_template', [App\Http\Controllers\Admin\TemplateManagementController::class, 'store'])->name('store_template');
    Route::get('/edit_template/{id}', [App\Http\Controllers\Admin\TemplateManagementController::class, 'edit'])->name('edit_template');
    Route::post('/update_template', [App\Http\Controllers\Admin\TemplateManagementController::class, 'update'])->name('update_template');
    Route::get('/view_template/{id}', [App\Http\Controllers\Admin\TemplateManagementController::class, 'view'])->name('view_template');

	Route::get('/template/getSubCategory', [App\Http\Controllers\Admin\TemplateManagementController::class, 'getSubCategoryFromParent'])->name('template.get_subCategory');
	Route::get('/template/getContract', [App\Http\Controllers\Admin\TemplateManagementController::class, 'getContactFromCatAndSubCat'])->name('template.get_contract');

    //Contract Categories
    Route::get('/categories_management', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'index'])->name('categories_management');
    Route::get('/add_categories', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'create'])->name('add_categories');
    Route::post('/store_categories', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'store'])->name('store_categories');
    Route::get('/edit_categories/{id}', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'edit'])->name('edit_categories');
    Route::post('/update_categories/{id}', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'update'])->name('update_categories');
    Route::get('/delete_categories/{id}', [App\Http\Controllers\Admin\ContractCategoriesController::class, 'destroy'])->name('delete_categories');


    //Sub Categories
    Route::get('/sub_categories_management', [App\Http\Controllers\Admin\SubCategoriesController::class, 'index'])->name('sub_categories_management');
    Route::get('/add_sub_categories', [App\Http\Controllers\Admin\SubCategoriesController::class, 'create'])->name('add_sub_categories');
    Route::post('/store_sub_categories', [App\Http\Controllers\Admin\SubCategoriesController::class, 'store'])->name('store_sub_categories');
    Route::get('/edit_sub_categories/{id}', [App\Http\Controllers\Admin\SubCategoriesController::class, 'edit'])->name('edit_sub_categories');
    Route::post('/update_sub_categories/{id}', [App\Http\Controllers\Admin\SubCategoriesController::class, 'update'])->name('update_sub_categories');
    Route::get('/delete_sub_categories/{id}', [App\Http\Controllers\Admin\SubCategoriesController::class, 'destroy'])->name('delete_sub_categories');
    
//Frequently Questions
    Route::get('/frequently_questions', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'index'])->name('frequently_questions');
    Route::get('/questions/create', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'questionsCreate'])->name('questions_create');
    Route::post('/store_questions', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'store'])->name('store_questions');
    Route::get('/edit_questions/{id}', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'edit'])->name('edit_questions');
    Route::post('/update_questions', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'update'])->name('update_questions');
    Route::get('/delete_questions/{id}', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'destroy'])->name('delete_questions');
    Route::get('/get_template_list', [App\Http\Controllers\Admin\FrequentlyAskedQuestionsController::class, 'getTemplate'])->name('template.get_template');


    //Content Management
    Route::get('/content_management', [App\Http\Controllers\Admin\ContentManagementController::class, 'index'])->name('content_management');
    Route::get('/add_content', [App\Http\Controllers\Admin\ContentManagementController::class, 'create'])->name('add_content');
    Route::post('/store_content', [App\Http\Controllers\Admin\ContentManagementController::class, 'store'])->name('store_content');
    Route::get('/edit_content/{id}', [App\Http\Controllers\Admin\ContentManagementController::class, 'edit'])->name('edit_content');
    Route::post('/update_content/{id}', [App\Http\Controllers\Admin\ContentManagementController::class, 'update'])->name('update_content');
    Route::post('/cms_content_check_slug', [App\Http\Controllers\Admin\ContentManagementController::class, 'checkSlug'])->name('cms_content_check_slug');

     //price Management
     Route::get('/price_management', [App\Http\Controllers\Admin\PricingController::class, 'index'])->name('price_management');
     Route::get('/add_price', [App\Http\Controllers\Admin\PricingController::class, 'create'])->name('add_price');
     Route::post('/store_price', [App\Http\Controllers\Admin\PricingController::class, 'store'])->name('store_price');
     Route::get('/edit_price/{id}', [App\Http\Controllers\Admin\PricingController::class, 'edit'])->name('edit_price');
     Route::post('/update_price/{id}', [App\Http\Controllers\Admin\PricingController::class, 'update'])->name('update_price');
     Route::get('/delete_price/{id}', [App\Http\Controllers\Admin\PricingController::class, 'destroy'])->name('delete_price');

    // news Management
     Route::get('/news_management', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news_management');
     Route::get('/add_news', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('add_news');
     Route::post('/store_news', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('store_news');
     Route::get('/edit_news/{id}', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('edit_news');
     Route::post('/update_news/{id}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('update_news');
     Route::get('/delete_news/{id}', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('delete_news');
   
      // Subscriber Management
      Route::get('/subs_management', [App\Http\Controllers\Admin\SubsController::class, 'index'])->name('subs_management');
      Route::get('/add_subs', [App\Http\Controllers\Admin\SubsController::class, 'create'])->name('add_subs');
      Route::post('/store_subs', [App\Http\Controllers\Admin\SubsController::class, 'store'])->name('store_subs');
      Route::get('/edit_subs/{id}', [App\Http\Controllers\Admin\SubsController::class, 'edit'])->name('edit_subs');
      Route::post('/update_subs/{id}', [App\Http\Controllers\Admin\SubsController::class, 'update'])->name('update_subs');
      Route::get('/delete_subs/{id}', [App\Http\Controllers\Admin\SubsController::class, 'destroy'])->name('delete_subs');
    
});





























































