<?php
namespace App\Services;

use App\Entities\User;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create user and give permissions
     *
     * @param $data
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = $this->userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'active' => $data['active'],
                'password' => Hash::make($data['password']),
            ]);
            if(isset($data['permissions'])) {
                $user->givePermissionTo($data['permissions']);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Update user and sync permissions
     *
     * @param $data
     * @param $id
     */
    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'active' => $data['active'],
            ];
            if ($data['password']) {
                $userData['password'] = Hash::make($data['password']);
            }

            /** @var User $user */
            $user = $this->userRepository->update($userData, $id);

            $permissions = isset($data['permissions']) ? $data['permissions'] : [];
            $user->syncPermissions($permissions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function changePass($data) {
        $user = Auth::user();
        $credentials = [
            'email' => $user->email,
            'password' => $data['old_password']
        ];

        if (auth()->attempt($credentials)) {
            $data['new_password'] = Hash::make($data['new_password']);
            $this->userRepository->update(['password' => $data['new_password']], $user->id);
            return true;
        }

        return false;
    }



    /**
     * Delete multiple users by their IDs.
     *
     * @param $data
     */
    public function bulkDelete($data)
    {
        DB::beginTransaction();
        try {
            /** @var User $user */
            $this->userRepository->whereIn('id', $data)->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
