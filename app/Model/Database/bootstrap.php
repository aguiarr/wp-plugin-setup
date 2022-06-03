<?php

namespace WPT\Model\Database;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Name: Bootstrap
 * @package Model\Database
 * @since 1.0.0
 */
class Bootstrap
{
   public function __construct()
   {
      $this->setConnection();
   }

   private function setConnection()
   {
      $capsule = new Capsule;

      $capsule->addConnection([
         "driver"   => "mysql",
         "host"     => DB_HOST,
         "database" => DB_NAME,
         "username" => DB_USER,
         "password" => DB_PASSWORD
      ]);
      
      $capsule->setAsGlobal();
      $capsule->bootEloquent();
   }
}

