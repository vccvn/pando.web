<?php

// controller
$c = 'TaskController@';
$r = 'api.tasks';
/*
|----------------------------------------------------------------------------------------------------------------------------
|                       URL                       |              CONTROLLER               |               NAME
|----------------------------------------------------------------------------------------------------------------------------
*/    
// url: /users                  
Route::get('/',                                    $c.'index'                             )->name($r); 
$r.='.'; // user.
// url: /users/role/{user_roie}             
Route::get('/crawl',                               $c.'crawl'                             )->name($r.'crawl');