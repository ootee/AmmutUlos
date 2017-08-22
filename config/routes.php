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


  //Rasti

  $routes->get('/rasti', function(){
    RastiController::index();
  });

  $routes->post('/rasti', function(){
    RastiController::store();
  });

  $routes->get('/rasti/:id', function($id){
    RastiController::show($id);
  });

  $routes->get('/rasti/add', function() {
  	RastiController::add();
  });

  $routes->get('/rasti/:id/edit', function($id) {
    RastiController::edit($id);
  });

  $routes->post('/rasti/:id/edit', function($id) {
    RastiController::update($id);
  });

  $routes->get('/hiekkalaatikko', function() {
    EtusivuController::sandbox();
  });


