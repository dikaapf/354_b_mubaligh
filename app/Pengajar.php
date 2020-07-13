<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengajar extends Authenticatable {

    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pengajars';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
        'email',
        'job_desc',
        'google_id',
        'status_pengajar',
        'no_ktp',
        'no_hp',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'email_ferified_at',
        'link_foto',
        'avatar',
        'avatar_original',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
