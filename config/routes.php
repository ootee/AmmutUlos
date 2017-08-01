<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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


