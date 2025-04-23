<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PermissionRepository;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserService;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Validators\UserValidator;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     * @param UserValidator $validator
     * @param PermissionRepository $permissionRepository
     * @param UserService $userService
     */
    public function __construct(UserRepository $userRepository, UserValidator $validator, PermissionRepository $permissionRepository, UserService $userService)
    {
        $this->middleware('permission:manage_users')->except(['editPassword', 'changePassword']);
        $this->middleware('except_super_admin')->only(['edit', 'update']);
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        dd(session()->getId());
        $this->userRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->userRepository
            ->with('permissions')
            ->where('id', '!=', SUPER_ADMIN_ID)
            ->orderBy('name')
            ->paginate(PAGINATE_RECORD);
        $rank = $users->firstItem();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }
        if (request()->ajax()) {
            return view('includes.users.table', compact('users', 'rank'))->render();
        }


        return view('pages.users.index', compact('users', 'rank'));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->all();
        return view('pages.users.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return Response
     *
     */
    public function store(UserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $this->userService->create($request->all());

            $response = [
                'error' => false,
                'message' => __('users.create_success'),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('users.index')->with(['response' => $response]);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->with('permissions')->find($id);
        $permissionsAssigned = $user->permissions->count() ? $user->permissions->pluck('id')->toArray() : [];
        $permissions = $this->permissionRepository->all();

        return view('pages.users.edit', compact('user', 'permissions', 'permissionsAssigned'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->userService->update($request->all(), $id);

            $response = [
                'error' => false,
                'message' => __('users.update_success'),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('users.index')->with(['response' => $response]);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function editPassword()
    {
        $user = Auth::user();
        return view('pages.users.changePass', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request) {

        try {
            if ($this->userService->changePass($request->all())) {
                $response = [
                    'error' => false,
                    'message' => __('passwords.update_success'),
                ];
            } else {
                $response = [
                    'error' => true,
                    'message' => __('passwords.update_error'),
                ];
            }

            return redirect()->route('dashboard')->with(['response' => $response]);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->userRepository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
    /**
     * Delete multiple users selected via checkboxes.
     *
     * @param \Illuminate\Http\Request $request  The request containing an array of user IDs to delete (ids[])
     * @return \Illuminate\Http\JsonResponse     JSON response indicating the result of the deletion
     */
    public function bulkDelete(Request $request)
    {
        $dataIds = $request->ids;
        $currentUserId = auth()->id();

        if (in_array($currentUserId, $dataIds) || in_array(SUPER_ADMIN_ID, $dataIds)) {
            return response()->json([
                'message' => 'Bạn không xoá được User này.',
                'deleted' => false,
            ], 403);
        }
        $deleted = $this->userService->bulkDelete($dataIds);

        if (!$deleted) {
            return response()->json([
                'message' => 'Xoá User thất bại .',
                'deleted' => false,
            ], 500);
        }

        if (request()->wantsJson()) {

            return response()->json([
                'message' => __('users.delete_success'),
                'deleted' => $deleted,
            ]);
        }
        $users = $this->userRepository
        ->with('permissions')
        ->where('id', '!=', SUPER_ADMIN_ID)
        ->orderBy('name')
        ->paginate(PAGINATE_RECORD)
        ->setPath(route('users.index'));
        $rank = $users->firstItem();
        $html = view('includes.users.table', compact('users', 'rank'))->render();

        return response()->json([
            'message' => 'Đã xoá User thành công!',
            'html' => $html
        ]);
    }
}
