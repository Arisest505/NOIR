    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('request_detail', function (Blueprint $table) {
                $table->increments('id_request_detail');
                $table->unsignedInteger('id_request');
                $table->unsignedInteger('quantity_request');
                $table->unsignedInteger('product_request');
                $table->unsignedInteger('id_farm_request');
                $table->unsignedInteger('id_shed_request');
                $table->string('description_request', 255);
                $table->date('time_request');
                $table->integer('balance_request')->nullable();
                $table->foreign('id_request')->references('id_request')->on('request');
                $table->foreign('id_farm_request')->references('farm_id')->on('farm');
                $table->foreign('id_shed_request')->references('shed_id')->on('shed');
                $table->foreign('product_request')->references('product_id')->on('product');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('request_detail');
        }
    };
