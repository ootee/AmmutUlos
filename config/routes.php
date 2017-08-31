<?php

  $routes->get('/', function() {
    EtusivuController::index();
  });

  $routes->get('/login', function(){
    UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  //Kilpailija

  $routes->get('/kilpailija', function(){
    KilpailijaController::index();
  });

  $routes->post('/kilpailija', function(){
    KilpailijaController::store();
  });

  $routes->get('/kilpailija/add', function(){
    KilpailijaController::add();
  });

  $routes->get('/kilpailija/:id/osallistu', function($id){
    OsallistuminenController::add($id);
  });

   $routes->post('/kilpailija/osallistuminen', function(){
    OsallistuminenController::store();
  });

  $routes->get('/kilpailija/:id', function($id){
    KilpailijaController::show($id);
  });

  $routes->get('/kilpailija/:id/edit', function($id){
    KilpailijaController::edit($id);
  });

  $routes->post('/kilpailija/:id/edit', function($id){
    KilpailijaController::update($id);
  });

  $routes->post('/kilpailija/:id/delete', function($id){
    KilpailijaController::delete($id);
  });

  //Kilpailu

  $routes->get('/kilpailu', function() {
  	KilpailuController::index();
  });

  
  $routes->post('/kilpailu', function() {
  	KilpailuController::store();
  });

  $routes->get('/kilpailu/add', function() {
  	KilpailuController::add();
  });

  $routes->get('/kilpailu/:id', function($id) {
  	KilpailuController::show($id);
  });

  $routes->get('/kilpailu/:id/edit', function($id){
    KilpailuController::edit($id);
  });

  $routes->post('/kilpailu/:id/edit', function($id){
    KilpailuController::update($id);
  });

   $routes->post('/kilpailu/:id/delete', function($id){
    KilpailuController::delete($id);
  });

  //Rasti

  $routes->get('/rasti', function(){
    RastiController::index();
  });

  $routes->post('/rasti', function(){
    RastiController::store();
  });

  $routes->get('/rasti/add/:id', function($id){
    RastiController::add($id);
  });

  $routes->get('/rasti/:id', function($id){
    RastiController::show($id);
  });

  $routes->get('/rasti/:id/edit', function($id) {
    RastiController::edit($id);
  });

  $routes->post('/rasti/:id/edit', function($id) {
    RastiController::update($id);
  });

   $routes->post('/rasti/:id/delete', function($id){
    RastiController::delete($id);
  });




  $routes->get('/hiekkalaatikko', function() {
    EtusivuController::sandbox();
  });


