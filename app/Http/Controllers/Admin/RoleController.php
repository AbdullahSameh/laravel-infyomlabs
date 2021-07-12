<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RoleDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Repositories\Admin\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Flash;

class RoleController extends AppBaseController
{
  /** @var  RoleRepository */
  private $roleRepository;

  public function __construct(RoleRepository $roleRepo)
  {
    $this->roleRepository = $roleRepo;
  }

  /**
   * Display a listing of the Role.
   *
   * @param RoleDataTable $roleDataTable
   * @return Response
   */
  public function index(RoleDataTable $roleDataTable)
  {
    abort_if(Gate::denies('access users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return $roleDataTable->render('admin.roles.index');
  }

  /**
   * Show the form for creating a new Role.
   *
   * @return Response
   */
  public function create()
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $permissions = Permission::all();
    return view('admin.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created Role in storage.
   *
   * @param CreateRoleRequest $request
   *
   * @return Response
   */
  public function store(CreateRoleRequest $request)
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $input = $request->except('permissions');

    $role = $this->roleRepository->create($input);
    $role->syncPermissions($request->input('permissions', []));

    Flash::success('Role saved successfully.');
    return redirect(route('admin.roles.index'));
  }

  /**
   * Display the specified Role.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function show($id)
  {
    abort_if(Gate::denies('show users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $role = $this->roleRepository->find($id);

    if (empty($role)) {
      Flash::error('Role not found');

      return redirect(route('admin.roles.index'));
    }

    return view('admin.roles.show')->with('role', $role);
  }

  /**
   * Show the form for editing the specified Role.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function edit($id)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $role = $this->roleRepository->find($id);
    $permissions = Permission::all();

    if (empty($role)) {
      Flash::error('Role not found');

      return redirect(route('admin.roles.index'));
    }
    return view('admin.roles.edit', compact('role', 'permissions'));
  }

  /**
   * Update the specified Role in storage.
   *
   * @param  int              $id
   * @param UpdateRoleRequest $request
   *
   * @return Response
   */
  public function update($id, UpdateRoleRequest $request)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $role = $this->roleRepository->find($id);

    if (empty($role)) {
      Flash::error('Role not found');

      return redirect(route('admin.roles.index'));
    }

    $role = $this->roleRepository->update($request->all(), $id);
    $role->syncPermissions($request->input('permissions', []));

    Flash::success('Role updated successfully.');
    return redirect(route('admin.roles.index'));
  }

  /**
   * Remove the specified Role from storage.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function destroy($id)
  {
    abort_if(Gate::denies('delete users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $role = $this->roleRepository->find($id);

    if (empty($role)) {
      Flash::error('Role not found');

      return redirect(route('admin.roles.index'));
    }

    $this->roleRepository->delete($id);

    Flash::success('Role deleted successfully.');
    return redirect(route('admin.roles.index'));
  }
}
