<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table            = 'articles';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'slug', 'category', 'image', 'content', 'status', 'views'];
    protected $useTimestamps    = true; // Otomatis mengisi created_at dan updated_at
}
