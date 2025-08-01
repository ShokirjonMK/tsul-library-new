<?php

use App\Http\Controllers\AbstractController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\BookAccessTypeController;
use App\Http\Controllers\BookActController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookFileTypeController;
use App\Http\Controllers\BookLanguageController;
use App\Http\Controllers\BooksTypeController;
use App\Http\Controllers\BookSubjectController;
use App\Http\Controllers\BookTextController;
use App\Http\Controllers\BookTextTypeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepositoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EducationTypeController;
use App\Http\Controllers\ExtraAuthorController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GenTypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\JournalArticlesController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MagazineIssueController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReferenceGenderController;
use App\Http\Controllers\ResAbstractController;
use App\Http\Controllers\ResDissertationsController;
use App\Http\Controllers\ResFieldController;
use App\Http\Controllers\ResLangController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\ResTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScientificPublicationController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectGroupController;
use App\Http\Controllers\UdcController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\WhereController;
use App\Http\Controllers\WhoController;
use App\Http\Livewire\Admin\Books\AddBookInventor;
use Illuminate\Support\Facades\Route;

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
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::redirect('/', '/uz');

Route::group(['prefix' => '{langugae}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function () {


    Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('welcome');
    Route::get('/categories', [App\Http\Controllers\SiteController::class, 'categories'])->name('site.categories');
    Route::get('/categories/{slug}', [App\Http\Controllers\SiteController::class, 'category'])->name('site.category');

    Route::get('/udcs', [App\Http\Controllers\SiteController::class, 'udcs'])->name('site.udcs');
    Route::get('/unilibrary', [App\Http\Controllers\SiteController::class, 'unilibrary'])->name('site.unilibrary');
    Route::get('/andqxai', [App\Http\Controllers\SiteController::class, 'andqxai'])->name('site.andqxai');

    Route::get('/books', [App\Http\Controllers\SiteController::class, 'books'])->name('site.books');
    Route::get('/books/{slug}', [App\Http\Controllers\SiteController::class, 'book'])->name('site.book');
    Route::get('/journals', [App\Http\Controllers\SiteController::class, 'journals'])->name('site.journals');
    Route::get('/journals/{slug}', [App\Http\Controllers\SiteController::class, 'journal'])->name('site.journal');
    Route::get('/journals/{slug}/{subslug}', [App\Http\Controllers\SiteController::class, 'magazine'])->name('site.magazine');

    Route::get('/books/{slug}/pdf', [App\Http\Controllers\SiteController::class, 'bookpdf'])->name('site.bookpdf');

    // Route::get('/product', 'App\Http\Controllers\SiteController@products')->name('site.products');
    // Route::get('/product/{slug}', 'App\Http\Controllers\SiteController@product')->name('site.product');
    // Route::get('/product/{slug}', ShowProduct::class)->name('site.product');
    // Route::get('/product/{slug}/{color}', ShowProduct::class)->name('site.productcolor');
    // Route::get('/cart', 'App\Http\Controllers\SiteController@cart')->name('site.cart');
    // Route::get('/cart/{slug}', 'App\Http\Controllers\SiteController@cartProduct')->name('site.cartProduct');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();
    Route::get('/register', function() {
        return redirect(app()->getLocale() .'/login');
    });


    Route::post('/register', function() {
        return redirect(app()->getLocale() .'/login');
    });
    Route::post('loginHemis', 'App\Http\Controllers\Auth\LoginController@loginHemis')->name('loginHemis');

    // Route::prefix('admin')->middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::prefix('admin')->middleware(['auth', 'role:SuperAdmin|Admin|Manager|Accountant'])->group(function () {
        Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

        Route::post('files', 'App\Http\Controllers\FileController@store')->name('file.store');
        Route::post('files/remove', 'App\Http\Controllers\FileController@remvoeFile')->name('file.remove');

        Route::get('debtors/export',[DebtorController::class,'export'])->name('debtors.export');
        Route::resource('debtors', DebtorController::class);
        Route::get('take-give', [App\Http\Controllers\DebtorsController::class, 'takegive'])->name('debtors.takegive');
        Route::get('take-give-rfid', [App\Http\Controllers\DebtorsController::class, 'takegiverfid'])->name('debtors.takegiverfid');
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');

        Route::get('book-types/export',[BooksTypeController::class,'export'])->name('book-types.export');
        Route::resource('book-types', BooksTypeController::class);
        Route::post('book-types/{id}', [BooksTypeController::class, 'delete'])->name('book-types.delete');

        Route::get('book-languages/export',[BookLanguageController::class,'export'])->name('book-languages.export');
        Route::resource('book-languages', BookLanguageController::class);
        Route::post('book-languages/{id}', [BookLanguageController::class, 'delete'])->name('book-languages.delete');

        Route::get('book-texts/export',[BookTextController::class,'export'])->name('book-texts.export');
        Route::resource('book-texts', BookTextController::class);
        Route::post('book-texts/{id}', [BookTextController::class, 'delete'])->name('book-texts.delete');


        Route::get('book-text-types/export',[BookTextTypeController::class,'export'])->name('book-text-types.export');
        Route::resource('book-text-types', BookTextTypeController::class);
        Route::post('book-text-types/{id}', [BookTextTypeController::class, 'delete'])->name('book-text-types.delete');

        Route::get('book-file-types/export',[BookFileTypeController::class,'export'])->name('book-file-types.export');
        Route::resource('book-file-types', BookFileTypeController::class);
        Route::post('book-file-types/{id}', [BookFileTypeController::class, 'delete'])->name('book-file-types.delete');

        Route::resource('subject-groups', SubjectGroupController::class);
        Route::post('subject-groups/{id}', [SubjectGroupController::class, 'delete'])->name('subject-groups.delete');

        Route::resource('education-types', EducationTypeController::class);
        Route::post('education-types/{id}', [EducationTypeController::class, 'delete'])->name('education-types.delete');

        Route::resource('book-subjects', BookSubjectController::class);
        Route::post('book-subjects/{id}', [BookSubjectController::class, 'delete'])->name('book-subjects.delete');

        Route::get('books/inventar', 'App\Http\Controllers\BookController@inventar')->name('admin.inventar');
        Route::get('books/inventarone/{id}', 'App\Http\Controllers\BookController@printinventar')->name('books.inventarone');
        Route::get('books/inventarByBookId/{id}', 'App\Http\Controllers\BookController@inventarByBookId')->name('books.inventarByBookId');
        Route::get('books/rfidshow/{rfid}', 'App\Http\Controllers\BookController@rfidshow')->name('books.rfidshow');
        Route::get('books/rfidshow/{rfid}/{id}', 'App\Http\Controllers\BookController@rfidgive')->name('books.rfidgive');

        Route::get('books/inventaronebarcode/{id}', 'App\Http\Controllers\BookController@inventaronebarcode')->name('books.inventaronebarcode');

        Route::post('books/inventarstorage', 'App\Http\Controllers\BookController@inventarstorage')->name('admin.inventarstorage');


        Route::get('books/inventarshow/{id}', 'App\Http\Controllers\BookController@inventarshow')->name('books.inventarshow');
        Route::get('books/inventarremove/{id}', 'App\Http\Controllers\BookController@inventarremove')->name('books.inventarremove');
        Route::post('books/addrfidinventar/{id}', 'App\Http\Controllers\BookController@addrfidinventar')->name('books.addrfidinventar');

        Route::get('books/exportInventarAllByFromTo', 'App\Http\Controllers\BookController@exportInventarAllByFromTo')->name('books.exportInventarAllByFromTo');

        Route::get('books/export',[BookController::class,'export'])->name('books.export');
        Route::get('books/export-with-inventars',[BookController::class,'exportWithInventars'])->name('books.export-with-inventars');

        Route::resource('books', BookController::class);

        Route::post('books/{id}', [BookController::class, 'delete'])->name('books.delete');
        Route::get('books/{id}/{infoid}', 'App\Http\Controllers\BookController@addinventar')->name('admin.add-book-inventar');

        Route::resource('organizations', OrganizationController::class);
        Route::post('organizations/{id}', [OrganizationController::class, 'delete'])->name('organizations.delete');

        Route::get('book-access-types/export',[BookAccessTypeController::class,'export'])->name('book-access-types.export');
        Route::resource('/book-access-types', BookAccessTypeController::class);
        Route::post('book-access-types/{id}', [BookAccessTypeController::class, 'delete'])->name('book-access-types.delete');
        Route::post('whos/{id}', [BookAccessTypeController::class, 'delete'])->name('whos.delete');

        Route::resource('/reference-genders', ReferenceGenderController::class);

        Route::get('users/export',[UserController::class,'export'])->name('users.export');
        Route::get('users/card', 'App\Http\Controllers\UserController@card')->name('users.card');
        Route::get('users/inventaroneuser/{id}', 'App\Http\Controllers\UserController@printinventar')->name('users.inventaroneuser');

        Route::get('users/rfid/{rfid}', 'App\Http\Controllers\UserController@rfidshow')->name('users.rfidshow');
        Route::get('users/rfid/{rfid}/{id}', 'App\Http\Controllers\UserController@rfidgive')->name('users.rfidgive');


        Route::resource('users', UserController::class);
        Route::post('users/{id}', [UserController::class, 'delete'])->name('users.delete');

        Route::resource('/user-types', UserTypeController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('branches', BranchController::class);
        Route::post('branches/{id}', [BranchController::class, 'delete'])->name('branches.delete');

        Route::get('findCityWithStateID/{id}', 'App\Http\Controllers\BranchController@findCityWithStateID');

        Route::resource('articles', ArticleController::class);
        Route::resource('departments', DepartmentController::class);
        Route::post('departments/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');

        Route::get('subjects/export',[SubjectController::class,'export'])->name('subjects.export');
        Route::resource('subjects', SubjectController::class);
        Route::post('subjects/{id}', [SubjectController::class, 'delete'])->name('subjects.delete');

        Route::get('wheres/export',[WhereController::class,'export'])->name('wheres.export');
        Route::resource('wheres', WhereController::class);
        Route::post('wheres/{id}', [WhereController::class, 'delete'])->name('wheres.delete');

        Route::get('whos/export',[WhoController::class,'export'])->name('whos.export');
        Route::resource('whos', WhoController::class);

        Route::post('whos/{id}', [WhoController::class, 'delete'])->name('whos.delete');

        Route::resource('imports', ImportController::class);
        Route::post('imports/{id}', [ImportController::class, 'delete'])->name('imports.delete');

        Route::get('journals/export',[JournalController::class,'export'])->name('journals.export');
        Route::resource('journals', JournalController::class);

        Route::resource('magazine-issues', MagazineIssueController::class);
        Route::resource('udcs', UdcController::class);

        Route::resource('orders', OrderController::class);
        Route::post('orders/{id}/change', [OrderController::class, 'change'])->name('orders.change');


        Route::resource('faculties', FacultyController::class);
        Route::post('faculties/{id}', [FacultyController::class, 'delete'])->name('faculties.delete');

        Route::resource('chairs', ChairController::class);
        Route::post('chairs/{id}', [ChairController::class, 'delete'])->name('chairs.delete');

        Route::resource('groups', GroupController::class);
        Route::post('groups/{id}', [GroupController::class, 'delete'])->name('groups.delete');

        Route::get('book-acts/export',[BookActController::class,'export'])->name('book-acts.export');
        Route::resource('book-acts', BookActController::class);

        Route::resource('resource-types', ResourceTypeController::class);
        Route::resource('res-type', ResTypeController::class);
        Route::resource('res-lang', ResLangController::class);
        Route::resource('res-field', ResFieldController::class);
        Route::resource('scientific-publications', ScientificPublicationController::class);
        Route::resource('res-dissertations', ResDissertationsController::class);
        Route::resource('res-abstracts', ResAbstractController::class);

        Route::resource('journal-articles', JournalArticlesController::class);

        Route::get('statdebtors', 'App\Http\Controllers\StatisticsController@statdebtors')->name('admin.statdebtors');
        Route::get('employeestat', 'App\Http\Controllers\StatisticsController@employeestat')->name('admin.employeestat');
        Route::get('statistics-by-month', 'App\Http\Controllers\StatisticsController@statisticsByMonth')->name('admin.statistics-by-month');

        Route::get('statdebtors/{id}', 'App\Http\Controllers\StatisticsController@debtorsshow')->name('statdebtors.show');

        Route::get('statbooks', 'App\Http\Controllers\StatisticsController@statbooks')->name('admin.statbooks');

        Route::get('statbooks/{id}', 'App\Http\Controllers\StatisticsController@booksshow')->name('booksshow.show');
        Route::get('statbooktypes', 'App\Http\Controllers\StatisticsController@statbooktypes')->name('admin.statbooktypes');
        Route::get('statbooktexts', 'App\Http\Controllers\StatisticsController@statbooktexts')->name('admin.statbooktexts');
        Route::get('statbooksubjects', 'App\Http\Controllers\StatisticsController@statbooksubjects')->name('admin.statbooksubjects');
        Route::get('statbookwhos', 'App\Http\Controllers\StatisticsController@statbookwhos')->name('admin.statbookwhos');
        Route::get('statbookwhere', 'App\Http\Controllers\StatisticsController@statbookwhere')->name('admin.statbookwhere');

        Route::get('statdebtorsbooktypes', 'App\Http\Controllers\StatisticsController@statdebtorsbooktypes')->name('admin.statdebtorsbooktypes');
        Route::get('statbooklangs', 'App\Http\Controllers\StatisticsController@statbooklangs')->name('admin.statbooklangs');

        Route::resource('depositories', DepositoryController::class);
        Route::resource('publishers', PublisherController::class);
        Route::resource('basics', BasicController::class);
        Route::resource('gen-types', GenTypeController::class);
        Route::resource('resources', ResourceController::class);
        Route::get('documents/export/{id}',[DocumentController::class,'word'])->name('documents.word');
        Route::get('documents/bymonth',[DocumentController::class,'bymonth'])->name('documents.bymonth');

        Route::resource('documents', DocumentController::class);



        Route::resource('extra-authors', ExtraAuthorController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('socials', SocialController::class);
        Route::resource('unilibrary', \App\Http\Controllers\UnilibraryController::class);
        Route::resource('andqxai', \App\Http\Controllers\AndqxaiController::class);

    });

    // , 'Author'
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('sisauthor', 'App\Http\Controllers\SisAuthorController@index')->name('admin.sisauthor');
        Route::get('my', 'App\Http\Controllers\UserProfileController@userProfile')->name('admin.my');

    });

    Route::prefix('admin')->middleware(['auth', 'Reader'])->group(function () {
        Route::get('order', [CartController::class, 'order'])->name('order');
        Route::get('myorders', [CartController::class, 'myorders'])->name('myorders');
        Route::get('cart', [CartController::class, 'cart'])->name('cart');
        Route::get('addtocart/{id}', [CartController::class, 'addToCart'])->name('addtocart');
        Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
        Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

        Route::get('reader', 'App\Http\Controllers\ReaderController@index')->name('admin.readerindex');
        Route::get('breader', 'App\Http\Controllers\ReaderController@book')->name('admin.readerbook');
        Route::get('breader/{id}', 'App\Http\Controllers\ReaderController@showbook')->name('admin.readershowbook');
        Route::get('dreader', 'App\Http\Controllers\ReaderController@dissertation')->name('admin.readerdis');
    });

    Route::prefix('admin')->middleware(['auth', 'User'])->group(function () {
        Route::get('usreader', 'App\Http\Controllers\ReaderController@user')->name('admin.userindex');
    });

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    });
    Route::prefix('admin')->middleware(['auth', 'User'])->group(function () {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    });
});
