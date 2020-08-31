<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ArticleCategory
 * @package App\Models
 * @version August 31, 2020, 7:33 am UTC
 *
 * @property string $category_name
 * @property string $slug
 */
class ArticleCategory extends Model
{

    public $table = 'article_category';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'category_name',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_name' => 'string',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_name' => 'required|string|max:255',
        // 'slug' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function article()
    {
        return $this->hasMany(Article::class, 'article_category_id','id');
    }
    
}
