<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\DB;
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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $homeservice = DB::table('home_services')->get();
    $images = DB::table('multipics')->get();
    return view('home',compact('brands','abouts','homeservice','images'));
});
Route::get('/home', function () {
   echo "This is Home page";
});

Route::get('/about', function () {
   return view('about');
});
Route::get('/contact',[ContactController::class,'index']);
//category controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('category/restore/{id}',[CategoryController::class,'Restore']);
Route::get('pdelete/category/{id}',[CategoryController::class,'pdelete']);


//Brand Route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);


//multi image route

Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');
Route::post('/multi/add',[BrandController::class,'StoreImg'])->name('store.image');



//admin all route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');

//Slider Delete Update
Route::get('/slider/delete/{id}',[HomeController::class,'Delete']);
Route::get('/slider/edit/{id}',[HomeController::class,'Edit']);
Route::post('/slider/update/{id}',[HomeController::class,'Update']);

//Home about page route
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'EditAbout']);
Route::post('/update/homeabout/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'DeleteAbout']);
//Portfolio 
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');
//Admin Contact Route
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AddContact'])->name('add.contact');
Route::post('/admin/store/contact',[ContactController::class,'StoreContact'])->name('store.contact');
Route::get('/contact/edit/{id}',[ContactController::class,'EditContact']);
Route::post('/update/contact/{id}',[ContactController::class,'UpdateContact']);
Route::get('/contact/delete/{id}',[ContactController::class,'DeleteContact']);
Route::get('/contact/message',[ContactController::class,'ContactMessage'])->name('contact.message');
Route::get('/contact/message/delete/{id}',[ContactController::class,'ContactMessageDelete']);
//Home Contact Page Route
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');



//Home Services route
Route::get('/home/service',[ServicesController::class,'HomeService'])->name('home.services');
Route::get('/add/service',[ServicesController::class,'AddService'])->name('add.service');
Route::post('/store/service',[ServicesController::class,'StoreService'])->name('store.service');
Route::get('/service/edit/{id}',[ServicesController::class,'EditService']);
Route::post('/update/service/{id}',[ServicesController::class,'UpdateService']);
Route::get('/service/delete/{id}',[ServicesController::class,'DeleteService']);






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
       // $users = User::all();
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');
