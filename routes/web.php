<?php


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

Route::get('/', function () {
    return view('index');
});

Auth::routes();


Route::middleware(['CheckRole:admin,pruefer'])->group(function(){
    // Route::delete('article/test/{id}', 'articleController@destroy'); 
    
  
});

Route::group(['middleware' => ['auth']], function() 
    {

        Route::resource('artikel', 'articleController');
        Route::resource('Tbl_article', 'articleController');
        Route::resource('stammdaten', 'stammdatenController');
        Route::resource('Tbl_articletyp', 'articleController');
        Route::resource('/kunden', 'kundenController');
        Route::resource('mkz_events', 'MkzEventsController');
        
        
        Route::get('mkz_events/create/{id?}', 'MkzEventsController@create');
        Route::get('searchBar/{id?}', 'searchBarController@show')->name('searchBar.show');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('report1/{jahr?}', 'ReportController@report1')->name('report.report1');
        Route::get('report2/{jahr?}', 'ReportController@report2')->name('report.report2');
        Route::get('report3/{jahr?}', 'ReportController@report3')->name('report.report3');
        


        Route::view('/pdf', 'pdf');
        Route::get('/PdfDemo', ['as'=>'PdfDemo','uses'=>'PdfController@index']);
        Route::get('/sample-pdf', ['as'=>'SamplePDF','uses'=>'PdfController@samplePDF']);
        Route::get('/save-pdf', ['as'=>'SavePDF','uses'=>'PdfController@savePDF']);
        Route::get('/download-pdf', ['as'=>'DownloadPDF','uses'=>'PdfController@downloadPDF']);
        Route::get('/html-to-pdf', ['as'=>'HtmlToPDF','uses'=>'PdfController@htmlToPDF']);
        Route::view('/pdfMkzUvv', 'pdf.pdfMkzUvv')->name('pdfMkzUvv'); //nur zu Testzwecken
        


        Route::get('articlelist', 'articleController@index')->name('articleIndex');
        Route::get('dashboard', 'dashboardController@index')->name('dashboard');

        Route::view('/menue/reports', 'menue.reports');
        Route::view('/menue/stammdaten', 'menue.stammdaten');
        Route::view('/search', 'search');


        // Route::get('mkz/history/search', 'searchController@index');
        // // Route::get('show', 'articleController@show');
        // Route::post('history', 'searchController@index');
        // // Route::delete('article/destroy/{id}', 'articleController@destroy')->name('article.destroy');
        // Route::resource('dashboard', 'DashboardController');
            // your routes
    });






