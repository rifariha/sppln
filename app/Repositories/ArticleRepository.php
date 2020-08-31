<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\BaseRepository;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version August 31, 2020, 7:59 am UTC
*/

class ArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'contains',
        'image',
        'photo',
        'article_category_id',
        'created_by',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article::class;
    }
}
