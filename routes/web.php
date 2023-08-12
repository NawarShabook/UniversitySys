<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\GraduatedController;
use App\Http\Controllers\Student\PromotionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Models\College;

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




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::get('/', function () {
            $ppp=Hash::make(1);
            echo  $ppp;
            return view('auth.login');
        });
        Route::get('/asd', function () {
            
            return view('auth.register');
        });



        Route::get('/dashboard', function () {
            $colleges= College::all();
            return view('dashboard', compact('colleges'));
        })->middleware(['auth'])->name('dashboard');

        Route::resource('/college',CollegeController::class);
        Route::resource('/classroom',ClassroomController::class);
        Route::resource('/sections',SectionController::class);
        Route::get('/classes/{id}', [SectionController::class,'getclasses'])->name('classes');

        Route::get('test', function(){
            $colleges= College::all();
           
            return view('pages.teacher.test');
        });

    Route::view('my-parent', 'livewire.show_Form')->name('my-parent');

    Route::resource('/teacher', TeacherController::class);

        // Students

    Route::resource('/student',StudentController::class);
    Route::get('/student/Get_classrooms/{id}',[StudentController::class,'Get_classrooms']);
    Route::post('Upload_attachment', [StudentController::class ,'Upload_attachment'])->name('Upload_attachment');
    Route::post('Delete_attachment', [StudentController::class ,'Delete_attachment'])->name('Delete_attachment');
    Route::get('Download_attachment/{studentname}/{filename}',[StudentController::class ,'Download_attachment'])->name('Download_attachment');
    Route::resource('/Graduateds',GraduatedController::class);



    Route::get('/Get_classrooms/{id}', [AjaxController::class,'getClassrooms'])->name('Get_classrooms');
    Route::get('/Get_Sections/{id}', [AjaxController::class,'Get_Sections'])->name('Get_Sections');


    // Promotion Student
        Route::resource('/promotion', PromotionController::class);
});

require __DIR__.'/auth.php';
