<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';                         // İsterseniz buradan tablonuzun adını değiştireiblirsiniz.

    //Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

}
