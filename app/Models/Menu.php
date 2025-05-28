<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = [
        'nama',
        'icon',
        'url',
        'parent_id',
        'urutan',
        'is_active'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function userPermissions()
    {
        return $this->hasMany(UserMenu::class);
    }
} 