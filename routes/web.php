<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Models\Document;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Test routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('phpspreadsheet', function () {
    return view('phpspreadsheet');
});


//Request to controllers

Route::post('upload-document', [DocumentController::class, 'Upload'])->name('upload-document');
Route::post('tiny', [DocumentController::class, 'DownloadDocumentFromTiny'])->name('download-document');
Route::post('show', [DocumentController::class, 'ShowDocument'])->name('show');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Pre Authentication Actions
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/signup', [SignupController::class, 'signup'])->name('signup');
Route::post('/signup',[SignupController::class, 'postRegister'])->name('postRegister');
Route::get('/login', [LoginController::class, 'getAuthLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postAuthLogin'])->name('postAuthLogin');
Route::get('/index', [HomeController::class, 'logout'])->name('logout');

//Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [MemberController::class, 'get_member'])->name('users');
    Route::post('/delete_user',[MemberController::class, 'delete_user'])->name('delete_user');
    Route::post('/edit_user',[MemberController::class, 'edit_user'])->name('edit_user');
    Route::post('/add_user',[MemberController::class, 'add_user'])->name('add_user');
    Route::get('/admin_documents',[DocumentController::class, 'GetAllFile'])->name('admin_documents');
    Route::get('/create_document', function () {
        return view('admin_create');})->name('create_document');

    Route::post('/edit_document', [ DocumentController::class, 'AdminEditDocument'])->name('edit_document');
    Route::post('/delete_document', [ DocumentController::class, 'AdminDeleteDocument'])->name('delete_document');
    Route::post('/preview', [ DocumentController::class, 'file_preview'])->name('preview');
    Route::get('/download_local', [ DocumentController::class, 'DownloadDocument'])->name('download_local');
    Route::post('/add_group', [ MemberController::class, 'add_group'])->name('add_group');
    //  Route::post('/addmember',[MemberController::class, 'add_member'])->name('add_member');
    //  Route::get('/member', [MemberController::class, 'get_member'])->name('get_member');
    //  Route::get('/storage', [StorageController::class, 'getfile'])->name('getfile');
    //  Route::get('/storage/{directory}', [StorageController::class, 'showDirectory'])->name('showDirectory');
    //  Route::get('users', function () {
    //      return view('userstable');
    //  })->name('users');
});
//User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/documents', [ DocumentController::class, 'GetFileData'])->name('GetFileData');
    Route::get('upload', function () {
        return view('upload');
    })->name('upload');
    Route::get('create_document', function () {
        return view('create_document');
    })->name('create_document');
    Route::post('/edit_document', [ DocumentController::class, 'EditDocument'])->name('edit_document');
    Route::post('/delete_document', [ DocumentController::class, 'DeleteDocument'])->name('delete_document');
    Route::post('/preview', [ DocumentController::class, 'file_preview'])->name('preview');
    Route::get('/download_local', [ DocumentController::class, 'DownloadDocument'])->name('download_local');
});

