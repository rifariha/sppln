<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Article
 * @package App\Models
 * @version August 31, 2020, 7:59 am UTC
 *
 * @property string $title
 * @property string $contains
 * @property string $image
 * @property string $photo
 * @property integer $article_category_id
 * @property string $created_by
 * @property boolean $status
 */
class Article extends Model
{

    public $table = 'article';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'title',
        'contains',
        'image',
        'thumbnail',
        'article_category_id',
        'created_by',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'contains' => 'string',
        'image' => 'string',
        'thumbail' => 'string',
        'article_category_id' => 'integer',
        'created_by' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'contains' => 'required|string',
        'image' => 'required',
        // 'photo' => 'required|string|max:255',
        // 'article_category_id' => 'required|integer',
        // 'created_by' => 'required|string|max:255',
        // 'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id','id');
    }
    
}
