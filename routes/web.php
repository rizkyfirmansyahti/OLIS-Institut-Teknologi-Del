<?php

use Illuminate\Support\Facades\Route;

Route::prefix('backend')
    ->name('backend.')
    ->namespace('App\Http\Controllers\Backend')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        $pref = 'categories';
        $ctrl = 'CategoryController';
        Route::resource($pref, $ctrl);

        $pref = 'books';
        $ctrl = 'BookController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::post('/import', $ctrl . '@import')->name('books.import');
            Route::post('/export', $ctrl . '@export')->name('books.export');
            Route::get('/list/{slug}', $ctrl . '@list')->name('books.list');
        });
        Route::resource($pref, $ctrl);

        $pref = 'compact-disks';
        $ctrl = 'CompactDiskController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::post('/import', $ctrl . '@import')->name('compact-disks.import');
            Route::post('/export', $ctrl . '@export')->name('compact-disks.export');
        });
        Route::resource($pref, $ctrl);

        $pref = 'articles';
        $ctrl = 'ArticleController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::post('/import', $ctrl . '@import')->name('articles.import');
            Route::get('/export', $ctrl . '@export')->name('articles.export');
        });
        Route::resource($pref, $ctrl);

        $pref = 'announcements';
        $ctrl = 'AnnouncementController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::put('/{announcement}/change-status', $ctrl . '@changeStatus')->name('announcements.change-status');
        });
        Route::resource($pref, $ctrl);

        $ctrl = 'LendingController';
        Route::prefix('lendings')->group(function () {
            Route::get('/{type}', 'LendingController@index')->name('lendings.index');
            Route::get('/{type}/list/{status}', 'LendingController@list')->name('lendings.list');
            Route::get('/{type}/data/{status}', 'LendingController@data')->name('lendings.data');
            Route::get('/{type}/create', 'LendingController@create')->name('lendings.create');
            Route::post('/{type}', 'LendingController@store')->name('lendings.store');
            Route::get('/{type}/{lending}', 'LendingController@show')->name('lendings.show');
            Route::get('/{type}/{lending}/edit', 'LendingController@edit')->name('lendings.edit');
            Route::put('/{type}/{lending}', 'LendingController@update')->name('lendings.update');
            Route::delete('/{type}/{lending}', 'LendingController@destroy')->name('lendings.destroy');
            Route::put('/{type}/{lending}/approve', 'LendingController@approve')->name('lendings.approve');
            Route::put('/{type}/{lending}/reject', 'LendingController@reject')->name('lendings.reject');
            Route::put('/{type}/{lending}/return', 'LendingController@return')->name('lendings.return');
            Route::match(['get', 'post'], '/{type}/{lending}/extend', 'LendingController@extend')->name('lendings.extend');
        });

        $pref = 'reports';
        $ctrl = 'ReportController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/index', $ctrl . '@index')->name('reports.index');
            Route::post('/export-lending-book/{status}', $ctrl . '@exportLendingBook')->name('reports.export-lending-book');
            Route::post('/export-lending-cd-dvd/{status}', $ctrl . '@exportLendingCD')->name('reports.export-lending-cd-dvd');
            Route::post('/export-visitor', $ctrl . '@exportVisitor')->name('reports.export-visitor');
            Route::get('/view-lending-book/{status}', $ctrl . '@viewLendingBook')->name('reports.view-lending-book');
            Route::get('/view-lending-cd-dvd/{status}', $ctrl . '@viewLendingCD')->name('reports.view-lending-cd');
            Route::get('/view-visitor', $ctrl . '@viewVisitor')->name('reports.view-visitor');
        });

        $pref = 'users';
        $ctrl = 'UserController';
        Route::resource($pref, $ctrl);

        $ctrl = 'LibraryArchiveController';
        Route::prefix('library-archives')->group(function () {
            Route::get('/{type}', 'LibraryArchiveController@index')->name('library-archives.index');
            Route::get('/{type}/create', 'LibraryArchiveController@create')->name('library-archives.create');
            Route::post('/{type}', 'LibraryArchiveController@store')->name('library-archives.store');
            Route::get('/{type}/{libraryArchive}', 'LibraryArchiveController@show')->name('library-archives.show');
            Route::get('/{type}/{libraryArchive}/edit', 'LibraryArchiveController@edit')->name('library-archives.edit');
            Route::put('/{type}/{libraryArchive}', 'LibraryArchiveController@update')->name('library-archives.update');
            Route::delete('/{type}/{libraryArchive}', 'LibraryArchiveController@destroy')->name('library-archives.destroy');
            Route::put('/{type}/{libraryArchive}/activate', 'LibraryArchiveController@toggleActive')->name('library-archives.toggle-active');
        });

        $pref = 'site-links';
        $ctrl = 'SiteLinkController';
        Route::resource($pref, $ctrl);

        $pref = 'profile';
        $ctrl = 'ProfileController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('profile.index');
            Route::get('/edit', $ctrl . '@edit')->name('profile.edit');
            Route::put('/', $ctrl . '@update')->name('profile.update');
            Route::get('/change-password', $ctrl . '@changePassword')->name('profile.change-password');
            Route::put('/change-password', $ctrl . '@updatePassword')->name('profile.update-password');
        });

        // log visitor
        $pref = 'log-visitors';
        $ctrl = 'LogVisitorController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('log-visitors.index');
            Route::get('/data', $ctrl . '@data')->name('log-visitors.data');
            Route::post('/', $ctrl . '@store')->name('log-visitors.store');
        });
    });

//User
Route::
        namespace('App\Http\Controllers\Frontend')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        $pref = 'books';
        $ctrl = 'BookController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('books.index');
            Route::get('/{book}', $ctrl . '@show')->name('books.show');
            Route::post('/{book}/review', $ctrl . '@review')->name('books.review');
        });

        $pref = 'compact-disks';
        $ctrl = 'CompactDiskController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('compact-disks.index');
            Route::get('/{compactDisk}', $ctrl . '@show')->name('compact-disks.show');
        });

        $pref = 'articles';
        $ctrl = 'ArticleController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('articles.index');
            Route::get('/{article}', $ctrl . '@show')->name('articles.show');
        });

        $pref = 'lendings';
        $ctrl = 'LendingController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('lendings.index');
            Route::post('/', $ctrl . '@store')->name('lendings.store');
            Route::get('/{lending}', $ctrl . '@show')->name('lendings.show');
        });

        $pref = 'announcements';
        $ctrl = 'AnnouncementController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('announcements.index');
            Route::get('/{announcement}', $ctrl . '@show')->name('announcements.show');
        });

        $pref = 'library-archives';
        $ctrl = 'LibraryArchiveController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/rules', $ctrl . '@rules')->name('library-archives.rules');
            Route::get('/guidelines', $ctrl . '@guidelines')->name('library-archives.guidelines');
            Route::get('/achievements', $ctrl . '@achievements')->name('library-archives.achievements');
            Route::get('/achievements/{slug}', $ctrl . '@show')->name('library-archives.achievements.show');
        });

        $pref = 'profile';
        $ctrl = 'ProfileController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('profile.index');
            Route::get('/edit', $ctrl . '@edit')->name('profile.edit');
            Route::put('/', $ctrl . '@update')->name('profile.update');
            Route::get('/change-password', $ctrl . '@changePassword')->name('profile.change-password');
            Route::put('/change-password', $ctrl . '@updatePassword')->name('profile.update-password');
        });

        $pref = 'site-links';
        $ctrl = 'SiteLinkController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/', $ctrl . '@index')->name('site-links.index');
        });

        $pref = 'notifications';
        $ctrl = 'NotificationController';
        Route::prefix($pref)->group(function () use ($ctrl) {
            Route::get('/articles', $ctrl . '@articles')->name('notifications.articles');
            Route::get('/books', $ctrl . '@books')->name('notifications.books');
            Route::get('/compact-disks', $ctrl . '@compactDisks')->name('notifications.compact-disks');
        });
    });

// login
Route::get('/login', '\App\Http\Controllers\AuthController@index')->name('login');
Route::post('/login', '\App\Http\Controllers\AuthController@login')->name('login');
Route::get('/logout', '\App\Http\Controllers\AuthController@logout')->name('logout');
