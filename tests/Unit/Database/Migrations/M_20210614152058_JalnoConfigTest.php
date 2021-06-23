<?php
namespace Jalno\Lumen\Tests\PrimaryPackage\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class M_20210614152058_JalnoConfigTest extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jalno_config_test', function (Blueprint $table) {
			$table->string("name", 255);
			$table->text("value");
			$table->primary(["name"]);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('jalno_config_test');
	}
}
