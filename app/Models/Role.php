<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'nama', 'keterangan', 'is_active'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu')->withPivot('can_view', 'can_add', 'can_edit', 'can_delete');
    }
} 