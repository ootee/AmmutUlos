<?php

  $routes->get('/', function() {
    EtusivuController::index();
  });

  $routes->get('/login', function(){
    EtusivuController::login();
  });

  $routes->post('/login', function(){
    EtusivuController::handle_login();
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

  $routes->get('/rasti/add', function() {
  	RastiController::add();
  });

  $routes->get('/rasti_edit', function() {
  	HelloWorldController::rasti_edit();
  });

  $routes->get('/hiekkalaatikko', function() {
    EtusivuController::sandbox();
  });


