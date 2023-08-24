<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\GraduatedController;
use App\Http\Controllers\Student\PromotionController;
use App\Http\Controllers\SubjectController;
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


        //user
        Route::resource('/users',UserController::class)->middleware(['auth','role:admin']);

        Route::get('/dashboard', function () {
            $colleges= College::all();
            return view('dashboard', compact('colleges'));
        })->middleware(['auth'])->name('dashboard');

        Route::resource('/college',CollegeController::class)->middleware(['auth']);
        Route::resource('/classroom',ClassroomController::class)->middleware(['auth']);
        Route::resource('/sections',SectionController::class)->middleware(['auth']);
        Route::get('/classes/{id}', [SectionController::class,'getclasses'])->middleware(['auth'])->name('classes');

    
        //teachers
        Route::resource('/teacher', TeacherController::class)->middleware(['auth']);
        Route::get('/teacher/create/{user_id}',[TeacherController::class,'create_teacher_user'])->middleware(['auth','role:admin'])->name('teacher_create');

        // Students

    Route::resource('/student',StudentController::class)->middleware(['auth']);
    Route::get('/student/create/{user_id}',[StudentController::class,'create_stu_user'])->middleware(['auth','role:admin'])->name('student_create');
    Route::get('/student/Get_classrooms/{id}',[StudentController::class,'Get_classrooms']);
    Route::post('Upload_attachment', [StudentController::class ,'Upload_attachment'])->name('Upload_attachment');
    Route::post('Delete_attachment', [StudentController::class ,'Delete_attachment'])->name('Delete_attachment');
    Route::get('Download_attachment/{studentname}/{filename}',[StudentController::class ,'Download_attachment'])->name('Download_attachment');
    
    Route::resource('/Graduateds',GraduatedController::class)->middleware(['auth']);
    Route::get('/Graduateds/create/{id}', [GraduatedController::class,'create'])->middleware(['auth','role:admin']);

    // ajax routes
    Route::get('/Get_classrooms/{id}', [AjaxController::class,'getClassrooms'])->name('Get_classrooms');
    Route::get('/Get_Sections/{id}', [AjaxController::class,'Get_Sections'])->name('Get_Sections');
    Route::get('/Get_College/{id}', [AjaxController::class,'Get_College'])->name('Get_College');
    Route::get('/Get_Teachers/{id}', [AjaxController::class,'Get_Teachers'])->name('Get_Teachers');


    // Promotion Student
        Route::resource('/promotion', PromotionController::class)->middleware(['auth','role:admin']);
        Route::get('/promotion/create/{id}', [PromotionController::class,'create'])->middleware(['auth','role:admin']);

    //subject
    Route::resource('/subject',SubjectController::class)->middleware(['auth']);
    Route::get('/subject/{for_type}/{id}', [SubjectController::class,'show'])->name('get_subjects_for');
});

require __DIR__.'/auth.php';
