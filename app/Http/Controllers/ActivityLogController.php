<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActivityLogRepository;

class ActivityLogController extends Controller
{

    protected $activityLogRepository;

    /**
     * CarriersController constructor.
     *
     * @param ActivityLogService $activityLogRepository
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->middleware('only_superadmin');
        $this->activityLogRepository = $activityLogRepository;
    }
    public function index()
    {
        session_start();
        session_unset();
        $this->activityLogRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $activityLogs = $this->activityLogRepository->paginate();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $activityLogs,
            ]);
        }
        if (request()->ajax()) {
            return view('includes.activityLogs.table', compact('activityLogs'))->render();
        }

        return view('pages.users.activityLog', compact('activityLogs'));
    }
}
