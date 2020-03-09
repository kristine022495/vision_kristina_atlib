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

Route::get('/', 'PageController@login');
Route::get('/logout', 'PageController@logout');

Route::get('/dashboard', 'PageController@dashboard');

// ACCOUNTS - GET
Route::get('/accounts/add', 'AccountsController@addUser');
Route::get('/accounts/add/superuser', 'AccountsController@enterSuperuser');
Route::get('/accounts/logs', 'AccountsController@getUserLogs');
Route::get('/accounts/list', 'PageController@accountsList');
Route::get('/accounts/view/{username}', 'PageController@viewProfile');

// ACCOUNTS - POST
Route::post('/login', 'PageController@attempt');
Route::post('/accounts/add', 'AccountsController@create');
Route::post('/accounts/add/createsuperuser', 'AccountsController@createSuperuser');

// FILES - GET
Route::get('/files/upload', 'FilesController@setUpload');
Route::get('/files/folders', 'FoldersController@getFoldersList');
Route::get('/files/folders/view/{folder_id}', 'FoldersController@getSubFolders');
Route::get('/files/folders/getlist', 'FoldersController@getSubFoldersList');
Route::get('/files/folders/manage', 'FoldersController@manageFolders');
Route::get('/files/folders/getSubFolderDetails', 'FoldersController@getSubFolderDetails');
Route::get('/files/search', 'FilesController@getSearchPage');
Route::get('/files/view/{fileset}', 'FilesController@viewFileSet');
Route::get('/files/program/list/{college}/{program}', 'FoldersController@getFilesList');
Route::get('/files/generate/token', 'FilesController@getTokenGenerator');
Route::get('/files/generate/token/{fileset_id}', 'FilesController@getTokenGeneratorPre');
Route::get('/files/view/tokens/all', 'FilesController@viewAllTokens');

// FILES - POST
Route::post('/files/upload', 'FilesController@uploadFiles');
Route::post('/files/search', 'FilesController@runSearch');
Route::post('/files/wildsearch', 'FilesController@wildSearch');
Route::post('/files/folders/manage/update_name', 'FoldersController@updateName');
Route::post('/files/folders/manage/toggle_archive', 'FoldersController@toggleArchive');
Route::post('/files/folders/manage/add', 'FoldersController@addFolder');
Route::post('/files/generate/token', 'FilesController@generateToken');

// PUBLIC - GET
Route::get('/thesis/', 'FilesController@getPublicThesis');
Route::get('/thesis/search', 'PublicAccessController@publicSearch');
Route::post('/thesis/', 'FilesController@retrievePublicThesis');
Route::get('/thesis/retrieve/{fileset}', 'FilesController@retrievePublicThesisApproved');
Route::get('/thesis/retrieve-restricted/{fileset}', 'FilesController@retrieveRestrictedPublicThesisApproved');

// PUBLIC - BROWSE
Route::get('thesis/browse', 'PublicAccessController@browse');
Route::get('thesis/files/folders/view/{folder_id}', 'PublicAccessController@browsePrograms');
Route::get('thesis/files/program/list/{college}/{program}', 'PublicAccessController@browseThesisFiles');

// JSON
Route::get('/check-thesis-record', 'FilesController@checkThesisRecord');
Route::post('/update-description', 'FilesController@updateDescription');