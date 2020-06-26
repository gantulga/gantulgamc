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
/*
Route::get('/', function () {
    return view('home');
});
*/
Route::feeds();
Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect']
], function()
{
    Route::get('sitemap', 'SitemapController@index')->name('sitemap');

    Route::get('search', 'SearchController@index')->name('search');

    Route::get('forms/{idOrSlug}', 'FormsController@show')->name('form.show');
    Route::post('forms/{form}', 'FormsController@post')->name('form');

    Route::get('news', 'PostsController@index')->name('post');
    Route::get('news/search', 'PostsController@search')->name('post.search');
    Route::get('news/cat/{category}', 'PostsController@category')->name('post.category');
    Route::get('news/{id}', 'PostsController@show')->name('post.show');
    Route::post('news/{post}/comment', 'CommentsController@post')->name('comment');

    Route::get('procurement', 'ProcurementController@index')->name('procurement');
    Route::get('procurement/result', 'ProcurementController@results')->name('procurement.result');
    Route::get('procurement/result/{result}', 'ProcurementController@results')->name('procurement.result.show');
    Route::get('procurement/company/home', 'CompanyController@index')->name('company.home');
    Route::get('procurement/company/register', 'Auth\Company\RegisterController@showRegistrationForm')->name('company.register');
    Route::post('procurement/company/register', 'Auth\Company\RegisterController@register');
    Route::get('procurement/company/email/verify', 'Auth\Company\VerificationController@show')->name('company.verification.notice');
    Route::get('procurement/company/email/verify/{id}', 'Auth\Company\VerificationController@verify')->name('company.verification.verify');
    Route::get('procurement/company/email/resend', 'Auth\Company\VerificationController@resend')->name('company.verification.resend');

    Route::get('human-resource/job-vacancy', 'JobsController@index')->name('job.index');
    Route::get('human-resource/job-vacancy/{job}', 'JobsController@show')->name('job.show');
    Route::get('human-resource/job-application', 'JobApplicationController@show')->name('job-application.show');
    Route::post('human-resource/job-application', 'JobApplicationController@post')->name('job-application');

    Route::get('legal', 'LegalDocumentsController@index')->name('legal-document.index');
    Route::get('legal/cat/{category}', 'LegalDocumentsController@category')->name('legal-document.category');
    Route::get('legal/{legalDocument}', 'LegalDocumentsController@show')->name('legal-document.show');

    //Route::get('{slug}', 'PagesController@show')->where('slug', '.*');
    Route::get('/','PagesController@show')->where('slugPath', '/');
    Route::fallback('PagesController@show')->name('page');
});
