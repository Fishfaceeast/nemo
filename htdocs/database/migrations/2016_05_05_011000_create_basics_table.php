<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/4
 * Time: 下午9:13
 */

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateBasicsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('basics', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->index();
				$table->string('gender');
				$table->string('city');
				$table->string('birth_year');
				$table->timestamps();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('basics');
		}
	}

