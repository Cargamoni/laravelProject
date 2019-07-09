<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Migration yaptığımız zaman eklenecek olan sütunu burada belirtiyoruz.
            //database/migrations/2019_07_08_074019_add_user_id_to_posts.php olduğunun dışında
            //integer yerine string koyacağız.
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Rollback yaptığımız zaman silinecek bölümü buraya belirtiyoruz.
            $table->dropColumn('cover_image');
        });
    }
}
