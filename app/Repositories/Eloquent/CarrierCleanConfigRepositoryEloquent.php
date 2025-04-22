<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\CarrierCleanConfigRepository;
use App\Entities\CarrierCleanConfig;
use App\Validators\CarrierCleanConfigValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CarrierRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CarrierCleanConfigRepositoryEloquent extends BaseRepository implements CarrierCleanConfigRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CarrierCleanConfig::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CarrierCleanConfigValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
