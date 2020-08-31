<?php

namespace App\Repositories;

use App\Models\ArticleCategory;
use App\Repositories\BaseRepository;

/**
 * Class ArticleCategoryRepository
 * @package App\Repositories
 * @version August 31, 2020, 7:33 am UTC
*/

class ArticleCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_name',
        // 'slug'
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
        return ArticleCategory::class;
    }
}
