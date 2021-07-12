<?php

namespace App\Repositories\Admin;

use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;

/**
 * Class RoleRepository
 * @package App\Repositories\Admin
 * @version July 10, 2021, 9:35 am UTC
 */

class RoleRepository extends BaseRepository
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
    return Role::class;
  }
}
