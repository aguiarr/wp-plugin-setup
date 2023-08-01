<?php

namespace WPlugin\Model\Infrastructure;

use WPlugin\Model\Infrastructure\Tables\Settings;

class Bootstrap
{
   public $tables;

   public function __construct()
   {
      $this->tables = [
         Settings::class
      ];
   }


   public function initialize(): void
   {
      $this->tables();
   }


   public function uninstall(): void
   {
      foreach ($this->tables as $table) {
         if ( class_exists( $table ) ) {
            $t = new $table;
            $t->down();
         }
      }
   }

   private function tables() : void
   {
      foreach ($this->tables as $table) {
         if ( class_exists( $table ) ) {
            $t = new $table;
            $t->up();
         }
      }
   }
}

