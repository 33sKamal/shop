<?php


// upload data first time 
Route::get('fake-data','FakeController@dumpData');


// get the Main Page
Route::get('/', 'ShopController@getMain');

// get the Preferred Page
Route::get('/preferred', 'ShopController@getPreffered');


// Like a shop (with an ajax request using axios)
Route::post('/like', 'ShopController@likeShop');


// Dislike a shop (with an ajax request using axios)
Route::post('/dislike', 'ShopController@dislikeShop');


// Remove a shop from preferred list (with an ajax request using axios)
Route::post('/remove-preferred', 'ShopController@removePreferred');

