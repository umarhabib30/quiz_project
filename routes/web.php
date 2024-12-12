<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\StudentAuthController;
use App\Http\Controllers\Student\StudentController;
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
Auth::routes();
        // Route::view('/', 'auth.login');
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', function () {
    return view('auth.login');
});
// Route::view('/login', 'auth.login')->name('login');
        /*
        Answer
        */
        Route::get('quiz/students/{id?}', [App\Http\Controllers\Teacher\AnswerController::class, 'showStudents']);
        Route::get('check/answers/{id?}/{student_id?}', [App\Http\Controllers\Teacher\AnswerController::class, 'showAnswer']);

        Route::get('answers', [App\Http\Controllers\Teacher\AnswerController::class, 'index']);

        //students
        Route::get('student/dashboard', [App\Http\Controllers\Student\StudentQuizController::class, 'dashboard']);
        Route::get('/student/quiz',[App\Http\Controllers\Student\StudentQuizController::class, 'list']);
        Route::get('/student/start-quiz/{id?}',[App\Http\Controllers\Student\StudentQuizController::class, 'start_quiz']);
        Route::post('/student/submit-answer/{quiz_id?}/{id?}',[App\Http\Controllers\Student\StudentQuizController::class, 'submitQuiz']);
        //end student
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('ad_dashboard');
        Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users');
        Route::get('/user/settings', [App\Http\Controllers\SettingController::class, 'showSettings'])->name('admin.settings');
        Route::post('/user/settings',  [App\Http\Controllers\SettingController::class, 'updateSettings'])->name('admin.settings.update');
        Route::get('/user/profile', [App\Http\Controllers\SettingController::class, 'showProfile'])->name('user.profile');
        Route::post('/user/profile',  [App\Http\Controllers\SettingController::class, 'updateProfile'])->name('user.profile.update');

        
        /*
        users
        */
        Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index']);
        Route::get('/admin/users/edit/{id?}', [App\Http\Controllers\Admin\UsersController::class, 'edit']);
        Route::post('/admin/users/edit/{id?}', [App\Http\Controllers\Admin\UsersController::class, 'edit']);
        Route::get('/admin/users/create', [App\Http\Controllers\Admin\UsersController::class, 'create']);
        Route::post('/admin/users/create', [App\Http\Controllers\Admin\UsersController::class, 'create']);
        Route::get('/admin/users/delete/{id}', [App\Http\Controllers\Admin\UsersController::class, 'delete']);
        /*
        teachers
        */
        Route::get('/admin/teachers', [App\Http\Controllers\Admin\TeacherController::class, 'index']);
        Route::get('/admin/teachers/edit/{id?}', [App\Http\Controllers\Admin\TeacherController::class, 'edit']);
        Route::post('/admin/teachers/edit/{id?}', [App\Http\Controllers\Admin\TeacherController::class, 'edit']);
        Route::get('/admin/teachers/create', [App\Http\Controllers\Admin\TeacherController::class, 'create']);
        Route::post('/admin/teachers/create', [App\Http\Controllers\Admin\TeacherController::class, 'create']);
        Route::get('/admin/teachers/delete/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'delete']);

         /*
        student
        */
        Route::get('/admin/students', [App\Http\Controllers\Student\StudentController::class, 'index']);
        Route::get('/admin/students/edit/{id?}', [App\Http\Controllers\Student\StudentController::class, 'edit']);
        Route::post('/admin/students/edit/{id?}', [App\Http\Controllers\Student\StudentController::class, 'edit']);
        Route::get('/admin/students/create', [App\Http\Controllers\Student\StudentController::class, 'create']);
        Route::post('/admin/students/create', [App\Http\Controllers\Student\StudentController::class, 'create']);
        Route::get('/admin/students/delete/{id}', [App\Http\Controllers\Student\StudentController::class, 'delete']);
        /*
        classes
        */
        Route::get('/admin/classes', [App\Http\Controllers\Admin\ClassesController::class, 'index']);
        Route::get('/admin/classes/edit/{id?}', [App\Http\Controllers\Admin\ClassesController::class, 'edit']);
        Route::post('/admin/classes/edit/{id?}', [App\Http\Controllers\Admin\ClassesController::class, 'edit']);
        Route::get('/admin/classes/create', [App\Http\Controllers\Admin\ClassesController::class, 'create']);
        Route::post('/admin/classes/create', [App\Http\Controllers\Admin\ClassesController::class, 'create']);
        Route::get('/admin/classes/delete/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'delete']);
         /*
        Enrollment
        */
        Route::get('/admin/enrollment', [App\Http\Controllers\Admin\EnrollmentController::class, 'index']);
        Route::get('/admin/enrollment/edit/{id?}', [App\Http\Controllers\Admin\EnrollmentController::class, 'edit']);
        Route::post('/admin/enrollment/edit/{id?}', [App\Http\Controllers\Admin\EnrollmentController::class, 'edit']);
        Route::get('/admin/enrollment/create', [App\Http\Controllers\Admin\EnrollmentController::class, 'create']);
        Route::post('/admin/enrollment/create', [App\Http\Controllers\Admin\EnrollmentController::class, 'create']);
        Route::get('/admin/enrollment/delete/{id}', [App\Http\Controllers\Admin\EnrollmentController::class, 'delete']);
        /*
        Courses
        */
        Route::get('/admin/course', [App\Http\Controllers\Admin\CourseController::class, 'index']);
        Route::get('/admin/course/edit/{id?}', [App\Http\Controllers\Admin\CourseController::class, 'edit']);
        Route::post('/admin/course/edit/{id?}', [App\Http\Controllers\Admin\CourseController::class, 'edit']);
        Route::get('/admin/course/create', [App\Http\Controllers\Admin\CourseController::class, 'create']);
        Route::post('/admin/course/create', [App\Http\Controllers\Admin\CourseController::class, 'create']);
        Route::get('/admin/course/delete/{id}', [App\Http\Controllers\Admin\CourseController::class, 'delete']);


    /*
        Answers
    */
        Route::get('/admin/answer/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'index']);
        Route::get('/admin/answer/{question_id}/edit/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'edit']);
        Route::post('/admin/answer/{question_id}/edit/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'edit']);
        Route::get('/admin/answer/{id?}/create', [App\Http\Controllers\Admin\AnswerController::class, 'create']);
        Route::post('/admin/answer/{id?}/create', [App\Http\Controllers\Admin\AnswerController::class, 'create']);
        Route::get('/admin/answer/delete/{id}', [App\Http\Controllers\Admin\AnswerController::class, 'delete']);

        /*
        quiz
    */

        Route::get('/teacher/quiz/', [App\Http\Controllers\Teacher\QuizController::class, 'index']);
        Route::get('/teacher/quiz/edit/{id?}', [App\Http\Controllers\Teacher\QuizController::class, 'edit']);
        Route::post('/teacher/quiz/edit/{id?}', [App\Http\Controllers\Teacher\QuizController::class, 'edit']);
        Route::get('/teacher/quiz/create', [App\Http\Controllers\Teacher\QuizController::class, 'create']);
        Route::post('/teacher/quiz/create', [App\Http\Controllers\Teacher\QuizController::class, 'create']);
        Route::get('/teacher/quiz/delete/{id}', [App\Http\Controllers\Teacher\QuizController::class, 'delete']);

        /*
        Question
        */
        Route::get('/teacher/questions/{quizid?}', [App\Http\Controllers\Teacher\QuestionController::class, 'index']);
        Route::get('/teacher/questions/{quizid}/edit/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'edit']);
        Route::post('/teacher/questions/{quizid}/edit/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'edit']);
        Route::get('/teacher/questions/{quizid}/delete/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'delete']);
        Route::get('/teacher/questions/{quizid}/create', [App\Http\Controllers\Teacher\QuestionController::class, 'create']);
        Route::post('/teacher/questions/{quizid}/create', [App\Http\Controllers\Teacher\QuestionController::class, 'create']);

        
        
        


