<?php

namespace App\Repositories;

use App\Models\DppDocument;
use App\Repositories\BaseRepository;

/**
 * Class DppDocumentRepository
 * @package App\Repositories
 * @version September 1, 2020, 5:01 am UTC
*/

class DppDocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'file',
        'inputted_by',
        'category'
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
        return DppDocument::class;
    }
}
