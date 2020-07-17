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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
//RUTAS DE COMPANIES
Route::get('/companies', 'CompanyController@index')->name('companies');
Route::get('/company/create', 'CompanyController@create')->name('company.create');
Route::post('/company/save', 'CompanyController@store')->name('company.save');
Route::get('/company/edit/{id}', 'CompanyController@edit')->name('company.edit');
Route::post('/company/update', 'CompanyController@update')->name('company.update');
Route::get('/company/delete/{id}', 'CompanyController@delete')->name('company.delete');
Route::get('/company/show/{id}', 'CompanyController@showEmployeesFromCompany')->name('company.show');
//RUTAS DE EMPLOYEES
Route::get('/employees', 'EmployeeController@index')->name('employees');
Route::get('/employee/create', 'EmployeeController@create')->name('employee.create');
Route::post('/employee/save', 'EmployeeController@store')->name('employee.save');
Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
Route::post('/employee/update/{id}', 'EmployeeController@update')->name('employee.update');
Route::get('/employee/delete/{id}', 'EmployeeController@delete')->name('employee.delete');
//RUTA DE LAOCALIZATION
Route::get('lang/{locale}', 'LocalizationController@index');
