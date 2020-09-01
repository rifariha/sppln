<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class DppDocument
 * @package App\Models
 * @version September 1, 2020, 5:01 am UTC
 *
 * @property string $name
 * @property string $file
 * @property string $inputted_by
 * @property string $category
 */
class DppDocument extends Model
{

    public $table = 'dpp_document';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'file',
        'inputted_by',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'file' => 'string',
        'inputted_by' => 'string',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'file' => 'required|mimes:pdf',
        'category' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $editrules = [
        'name' => 'required|string|max:255',
        'file' => 'mimes:pdf',
        'category' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
