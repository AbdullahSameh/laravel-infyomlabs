<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PermissionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Repositories\Admin\PermissionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Flash;

class PermissionController extends AppBaseController
{
  /** @var  PermissionRepository */
  private $permissionRepository;

  public function __construct(PermissionRepository $permissionRepo)
  {
    $this->permissionRepository = $permissionRepo;
  }

  /**
   * Display a listing of the Permission.
   *
   * @param PermissionDataTable $permissionDataTable
   * @return Response
   */
  public function index(PermissionDataTable $permissionDataTable)
  {
    abort_if(Gate::denies('access users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return $permissionDataTable->render('admin.permissions.index');
  }

  /**
   * Show the form for creating a new Permission.
   *
   * @return Response
   */
  public function create()
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return view('admin.permissions.create');
  }

  /**
   * Store a newly created Permission in storage.
   *
   * @param CreatePermissionRequest $request
   *
   * @return Response
   */
  public function store(CreatePermissionRequest $request)
  {
    abort_if(Gate::denies('create users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $input = $request->all();

    $permission = $this->permissionRepository->create($input);

    Flash::success('Permission saved successfully.');

    return redirect(route('admin.permissions.index'));
  }

  /**
   * Display the specified Permission.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function show($id)
  {
    abort_if(Gate::denies('show users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $permission = $this->permissionRepository->find($id);

    if (empty($permission)) {
      Flash::error('Permission not found');

      return redirect(route('admin.permissions.index'));
    }

    return view('admin.permissions.show')->with('permission', $permission);
  }

  /**
   * Show the form for editing the specified Permission.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function edit($id)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $permission = $this->permissionRepository->find($id);

    if (empty($permission)) {
      Flash::error('Permission not found');

      return redirect(route('admin.permissions.index'));
    }

    return view('admin.permissions.edit')->with('permission', $permission);
  }

  /**
   * Update the specified Permission in storage.
   *
   * @param  int              $id
   * @param UpdatePermissionRequest $request
   *
   * @return Response
   */
  public function update($id, UpdatePermissionRequest $request)
  {
    abort_if(Gate::denies('edit users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $permission = $this->permissionRepository->find($id);

    if (empty($permission)) {
      Flash::error('Permission not found');

      return redirect(route('admin.permissions.index'));
    }

    $permission = $this->permissionRepository->update($request->all(), $id);

    Flash::success('Permission updated successfully.');

    return redirect(route('admin.permissions.index'));
  }

  /**
   * Remove the specified Permission from storage.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function destroy($id)
  {
    abort_if(Gate::denies('delete users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $permission = $this->permissionRepository->find($id);

    if (empty($permission)) {
      Flash::error('Permission not found');

      return redirect(route('admin.permissions.index'));
    }

    $this->permissionRepository->delete($id);

    Flash::success('Permission deleted successfully.');

    return redirect(route('admin.permissions.index'));
  }
}
