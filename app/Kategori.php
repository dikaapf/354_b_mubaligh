<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kategoris';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'flag_status',
        ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
