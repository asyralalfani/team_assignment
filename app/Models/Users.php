<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public $timestamps = false;

    public $fillable = ['id', 'role_id', 'name', 'email', 'password', 'address', 'phone'];

    public function role() {
        return $this->belongsTo(Roles::class);
    }
}
