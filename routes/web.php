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

//le tout
Auth::routes();

Route::get('/','HomeController@index')->name('accueil');
Route::get('/home','HomeController@index')->name('home');
Route::get('/produit/','HomeController@produitHome')->name('produitHome');


Route::get('/profile','UserController@profile')->name('profile');
Route::get('/password/update','UserController@update_password')->name('updatePassword');
Route::post('/password/update','UserController@UpdatePassword');
Route::get('/profile/update_photo','UserController@update_photo')->name('update_photo');
Route::post('/profile/update_photo','UserController@UpdatePhoto')->name('UpdatePhoto');
Route::post('/profile/uploadImage','UserController@uploadImage')->name('uploadImage');
Route::post('/profile/upload_image','UserController@upload_image')->name('upload_image');


Route::get('/showpiecejointe/{id}','MediaController@ShowPieceJointe')->name('ShowPieceJointe');


Route::get('commandes','ParametresController@commandes')->name('commandes');
Route::get('commande/{commande_id}','ParametresController@DetailsCommande')->name('DetailsCommande');

//
Route::get('produits','ParametresController@produits')->name('produits');
Route::post('produits','ParametresController@SaveProduit')->name('SaveProduit');
Route::get('produit/{produit_id}','ParametresController@DetailsProduit')->name('DetailsProduit');
Route::post('supprimer_produit','ParametresController@SupprimerProduit')->name('SupprimerProduit');

Route::post('update_photo_produit/{produit_id}','ParametresController@UpdateProduitPhoto')->name('UpdateProduitPhoto');
Route::post('upload_fichiers/{courrier_id}','ParametresController@UpdateFichiers')->name('UpdateFichiers');


Route::get('categories','ParametresController@categories')->name('categories');
Route::post('categories','ParametresController@SaveCategorie')->name('SaveCategorie');
Route::post('supprimer_categorie','ParametresController@SupprimerCategorie')->name('SupprimerCategorie');



Route::get('frais_livraison','ParametresController@FraisLivraison')->name('frais_livraison');
Route::post('frais_livraison','ParametresController@SaveFraisLivraison')->name('SaveFraisLivraison');
Route::post('supprimer_frais_livraison','ParametresController@SupprimerFraisLivraison')->name('SupprimerFraisLivraison');


Route::get('banniere','ParametresController@banniere')->name('banniere');
Route::post('banniere','ParametresController@SaveBanniere')->name('SaveBanniere');
Route::post('supprimer_banniere','ParametresController@SupprimerBanniere')->name('SupprimerBanniere');



//
Route::get('courses','ParametresController@courses')->name('courses');
Route::post('courses','ParametresController@SaveCourse')->name('SaveCourse');
Route::get('course/{course_id}','ParametresController@DetailsCourse')->name('DetailsCourse');
Route::post('supprimer_course','ParametresController@SupprimerCourse')->name('SupprimerCourse');



//sécurité
Route::any('{catchall}', 'SecurityController@SaveRoutes')->where('catchall', '.*');


