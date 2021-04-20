<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // Insert
      $procedure = "
      DROP PROCEDURE IF EXISTS insertDocumentType;
      CREATE PROCEDURE `insertDocumentType`(name varchar(100))
      BEGIN
      INSERT INTO document_types VALUES (null,name);
      END";
      DB::unprepared($procedure);

      // edit
      $procedure = "
      DROP PROCEDURE IF EXISTS updateDocumentType;
      CREATE PROCEDURE `updateDocumentType`(updateId INT,updateName varchar(100))
      BEGIN
      UPDATE document_types SET name = updateName WHERE id = updateId;
      END";
      DB::unprepared($procedure);

      // destroy
      $procedure = "
      DROP PROCEDURE IF EXISTS destroyDocumentType;
      CREATE PROCEDURE `destroyDocumentType`(destroyId INT)
      BEGIN
      DELETE FROM document_types WHERE id = destroyId;
      END";
      DB::unprepared($procedure);
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
