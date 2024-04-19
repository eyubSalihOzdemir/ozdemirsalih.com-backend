<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ArticlesFilter extends ApiFilter {
  // fields that are allowed to be filtered on.
  protected $safeParms = [
    'title' => ['eq'],
    'body' => ['eq'],
    'categoryId' => ['eq'],
    'createdAt' => ['eq', 'gt', 'lt'],
    'updatedAt' => ['eq', 'gt', 'lt'],
  ];

  protected $columnMap = [
    'categoryId' => 'category_id',
    'createdAt' => 'created_at',
    'updatedAt' => 'updated_at'
  ];

  protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>=',
  ];
}