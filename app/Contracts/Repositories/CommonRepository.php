<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface CommonRepository extends RepositoryInterface
{
    /**
     * Get data by value of column
     *
     * @param $column
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function where($column, $operator, $value);

}
