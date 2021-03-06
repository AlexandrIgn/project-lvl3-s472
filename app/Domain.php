<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model 
{

    protected $fillable = ['name',
                          'content_length',
                          'status_code',
                          'body',
                          'header',
                          'keywords',
                          'description'
                ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];
}
