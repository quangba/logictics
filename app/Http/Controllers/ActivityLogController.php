<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActivityLogRepository;
use App\Entities\ActivityLog;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        session_start();
        session_unset();
        $this->activityLogRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $query = ActivityLog::query();

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('url')) {
            $query->where('url', 'like', '%' . $request->url . '%');
        }
        $activityLogs = $query->with('user')->orderByDesc('created_at')->paginate()
                            ->appends($request->query());;

        $rank = $activityLogs->firstItem();
        $values = $request->only(['name', 'email', 'url']);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $activityLogs,
            ]);
        }
        if (request()->ajax()) {
            return view('includes.activityLogs.table', compact('activityLogs', 'rank'))->render();
        }

        return view('pages.users.activityLog', compact('activityLogs', 'rank', 'values'));
    }
}
