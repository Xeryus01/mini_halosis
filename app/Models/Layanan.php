<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'permintaan_layanan';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function get_all() {}
}
