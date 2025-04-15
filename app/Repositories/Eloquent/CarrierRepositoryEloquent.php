<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CarrierRepository;
use App\Entities\Carrier;
use App\Validators\CarrierValidator;

/**
 * Class CarrierRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CarrierRepositoryEloquent extends BaseRepository implements CarrierRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Carrier::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CarrierValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
