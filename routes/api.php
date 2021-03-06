<?php

use App\Forum;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware'=>['cors','myauth'],'prefix' => 'v1'], function(){
    Route::post('/login','api\UserController@login');
    Route::post('/register','api\UserController@register');
    Route::get('course/top/{offset}','api\CourseController@getCoursePopular');
    Route::get('course/category', 'api\CategoryController@getCategories');
    Route::get('/forum','api\ForumController@getAllForum');
    Route::get('/category','api\ThreadController@getAllThread');
    Route::get('/comment','api\CommentController@getAllComment');
    Route::get('/course','api\CourseController@getCourse');
    Route::get('course/{course_id}','api\CourseController@getCourseById');
    Route::get('course/category/{category_id}','api\CourseController@getCourseByCategory');
    Route::get('forum/{forum_id}','api\ForumController@getForumById');
    Route::get('thread/forum/{forum_id}','api\ThreadController@getThreadByForumId');
    Route::get('comment/{thread_id}','api\CommentController@getAllCommentByThreadId');
});

Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'v1'], function(){
    Route::get('/user', 'api\UserController@getCurrentUser');
    Route::get('/alluser','api\UserController@getUser');
    Route::get('/user/{email}','api\UserController@getUserByEmail');

    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'course'], function(){
        Route::post('/','api\CourseController@register');
        Route::post('/material','api\CourseController@registerMaterial');
        Route::get('/detail/{course_id}','api\CourseController@getCourseDetailbyId');
        Route::get('/detail','api\CourseController@getCourseDetail');
        Route::post('/update','api\CourseController@updateCourse');
        Route::post('/material/update','api\CourseController@updateMaterial');
        Route::get('/material/delete/{material_id}','api\CourseController@deleteMaterial');
    });
    
    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'forum'], function(){
        Route::post('/','api\ForumController@register');
        Route::get('/course/{course_id}','api\ForumController@getForumByCourse');
        });
    
    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'thread'], function(){
        Route::post('/','api\ThreadController@register');
        Route::get('/{thread_id}','api\ThreadController@getAllThreadById');
        Route::post('/update','api\ThreadController@updateIsCorrect');
        });
    
    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'comment'], function(){
        Route::post('/','api\CommentController@register');
        });

    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'enroll'], function(){
        Route::get('/{user_id}','api\CourseEnrollController@getCourse');
        Route::get('/progress/{user_id}','api\CourseEnrollController@getProgress');
        Route::post('/','api\CourseEnrollController@register');
        });

    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'assignment'], function(){
        Route::get('/','api\AssignmentController@getAssignment');
        Route::get('/{assignment_id}','api\AssignmentController@getAssingmentById');
        Route::post('/','api\AssignmentController@register');
        });

    Route::group(['middleware'=>['cors','myauth','auth:api'],'prefix' => 'answer'], function(){
        Route::get('/','api\AssignmentDetailController@getAnswer');
        Route::get('/{assignment_id}','api\AssignmentDetailController@getAnswerByAssignmentId');
        Route::get('/user/{user_id}','api\AssignmentDetailController@getAnswerByUser');
        Route::post('/','api\AssignmentDetailController@register');
        });

});    
