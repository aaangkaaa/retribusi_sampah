<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $table = 'user_menu';
    
    protected $fillable = [
        'user_id',
        'menu_id',
        'can_view',
        'can_add',
        'can_edit',
        'can_delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
} 