<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

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



  $routes->get('/kilpailulista', function() {
  	HelloWorldController::kilpailulista();
  });

  $routes->get('/kilpailulista_edit', function() {
  	HelloWorldController::kilpailulista_edit();
  });

  $routes->get('/kilpailu', function() {
  	HelloWorldController::kilpailu();
  });

  $routes->get('/kilpailu_edit', function() {
  	HelloWorldController::kilpailu_edit();
  });

  $routes->get('/rasti', function() {
  	HelloWorldController::rasti();
  });

  $routes->get('/rasti_edit', function() {
  	HelloWorldController::rasti_edit();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });


