<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\CategoryFactory;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 't_categories';

    protected $primaryKey = 'category_id';

    protected $guarded = [];

    protected function newFactory() {
        return new CategoryFactory();
    }
}
