<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Wajib 'array'
    protected $allowedFields    = ['username', 'email', 'password', 'role', 'is_active'];
    protected $useTimestamps    = true;
}
