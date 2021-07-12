<?php

namespace App\Repositories\Admin;

use Spatie\Permission\Models\Permission;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository
 * @package App\Repositories\Admin
 * @version July 11, 2021, 9:28 pm UTC
 */

class PermissionRepository extends BaseRepository
{
  /**
   * @var array
   */
  protected $fieldSearchable = [
    'name'
  ];

  /**
   * Return searchable fields
   *
   * @return array
   */
  public function getFieldsSearchable()
  {
    return $this->fieldSearchable;
  }

  /**
   * Configure the Model
   **/
  public function model()
  {
    return Permission::class;
  }
}
