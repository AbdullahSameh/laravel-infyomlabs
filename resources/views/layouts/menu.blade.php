<li class="nav-item menu-open">
  <a href=""
    class="nav-link {{ Request::is('admin/users*') || Request::is('admin/roles*') || Request::is('admin/permissions*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Manage Users
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>Users</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
        <i class="nav-icon far fa-address-card"></i>
        <p>Roles</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.permissions.index') }}"
        class="nav-link {{ Request::is('admin/permissions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-key"></i>
        <p>Permissions</p>
      </a>
    </li>
  </ul>
</li>
