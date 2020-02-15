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

Route::get('/', function () {
    echo date("Y-m-d H:i:s");
    return view('welcome');
});

//phpinfo
Route::get('/phpinfo', function () {
    phpinfo();
});

/**测试路由分组*/
Route::prefix('/test')->group(function () {
    //curl测试 form-data
    Route::get('/curl/curlPost1','TestController@curlPost1');
    //curl测试x-www-form-urlencoded
    Route::get('/curl/curlPost2','TestController@curlPost2');
    //curl测试raw(json字符串)
    Route::get('/curl/curlPost3','TestController@curlPost3');
    //curl测试 上传文件
    Route::get('/curl/curlUpload','TestController@curlUpload');

});

/**Guzzle路由分组*/
Route::prefix('/guzzle')->group(function () {
    //Guzzle(GET请求)
    Route::get('/guzzleGet1','TestController@guzzleGet1');
    //Guzzle(POST请求)
    Route::get('/guzzlePost1','TestController@guzzlePost1');
    //Guzzle(POST请求----上传文件)
    Route::get('/guzzleUpload','TestController@guzzleUpload');

});