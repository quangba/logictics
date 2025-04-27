<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\ActivityLogRepository;
use App\Entities\ActivityLog;
use App\Validators\ActivityLogValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CarrierRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ActivityLogRepositoryEloquent extends BaseRepository implements ActivityLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivityLog::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ActivityLogValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
