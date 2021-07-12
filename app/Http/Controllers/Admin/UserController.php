<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Flash;
use Hash;

class UserController extends AppBaseController
{
  /** @var $userRepository UserRepository */
  private $userRepository;

  public function __construct(UserRepository $userRepo)
  {
    $this->userRepository = $userRepo;
  }

  /**
   * Display a listing of the User.
   *
   * @param UserDataTable $userDataTable
   * @return Response
   */
  public function index(UserDataTable $userDataTable)
  {
    abort_if(Gate::denies('access users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    return $userDataTable->render('admin.users.index');
  }

  /**
   * Show the form for creating a new User.
   *
   * @return Response
   */
  public function create()
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $roles = Role::all();
    return view('admin.users.create', compact('roles'));
  }

  /**
   * Store a newly created User in storage.
   *
   * @param CreateUserRequest $request
   *
   * @return Response
   */
  public function store(CreateUserRequest $request)
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $input = $request->except('roles');
    $input['password'] = Hash::make($input['password']);
    $user = $this->userRepository->create($input);

    if ($request->roles) {
      $user->syncRoles($request->roles);
      $user->syncPermissions($user->getPermissionsViaRoles($request->roles));
    }

    Flash::success('User saved successfully.');
    return redirect(route('admin.users.index'));
  }

  /**
   * Display the specified User.
   *
   * @param int $id
   *
   * @return Response
   */
  public function show($id)
  {
    abort_if(Gate::denies('show users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = $this->userRepository->find($id);

    if (empty($user)) {
      Flash::error('User not found');

      return redirect(route('admin.users.index'));
    }

    return view('admin.users.show')->with('user', $user);
  }

  /**
   * Show the form for editing the specified User.
   *
   * @param int $id
   *
   * @return Response
   */
  public function edit($id)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = $this->userRepository->find($id);
    $roles = Role::all();

    if (empty($user)) {
      Flash::error('User not found');

      return redirect(route('admin.users.index'));
    }

    return view('admin.users.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified User in storage.
   *
   * @param int $id
   * @param UpdateUserRequest $request
   *
   * @return Response
   */
  public function update($id, UpdateUserRequest $request)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = $this->userRepository->find($id);

    if (empty($user)) {
      Flash::error('User not found');

      return redirect(route('admin.users.index'));
    }
    $input =  $request->all();
    if (!empty($input['password'])) {
      $input['password'] = Hash::make($input['password']);
    } else {
      unset($input['password']);
    }
    $user = $this->userRepository->update($input, $id);
    $user->syncRoles($request->roles);
    $user->syncPermissions($user->getPermissionsViaRoles($request->roles));

    Flash::success('User updated successfully.');
    return redirect(route('admin.users.index'));
  }

  /**
   * Remove the specified User from storage.
   *
   * @param int $id

   * @throws \Exception
   *
   * @return Response
   */
  public function destroy($id)
  {
    abort_if(Gate::denies('delete users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = $this->userRepository->find($id);

    if (empty($user)) {
      Flash::error('User not found');

      return redirect(route('admin.users.index'));
    }

    $this->userRepository->delete($id);

    Flash::success('User deleted successfully.');
    return redirect(route('admin.users.index'));
  }
}
