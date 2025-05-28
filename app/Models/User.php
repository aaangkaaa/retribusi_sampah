<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'kec_id',
        'kel_id',
        'role_id',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function menuPermissions()
    {
        return $this->hasMany(UserMenu::class);
    }

    public static function getDataKecamatan($kec_id, $search)
    {
        if ($kec_id == "") {
            return \DB::select("SELECT * FROM ms_kecamatan WHERE nama LIKE :search LIMIT 15", ['search' => '%' . $search . '%']);
        } else {
            return \DB::select("SELECT * FROM ms_kecamatan WHERE id = $kec_id");
        }
    }
}
