<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午10:47
 */

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateRefersTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('refers', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->index();
				$table->text('why');
				$table->text('description');
				$table->text('story');
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
			Schema::drop('refers');
		}
	}
