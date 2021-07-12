<!-- Name Field -->
<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  <div style="padding-bottom: 4px">
    <span class="btn btn-success btn-sm select-all">Select All</span>
    <span class="btn btn-danger btn-sm deselect-all">Deselect All</span>
  </div>
  <select class="custom-select select2" size="10" name="permissions[]" id="permissions" placeholder="Choose Permissions"
    multiple>
    @foreach ($permissions as $permission)
      <option value="{{ $permission->id }}"
        {{ isset($role) && $role->hasPermissionTo($permission) ? 'selected' : '' }}>
        {{ $permission->name }}
      </option>
    @endforeach
  </select>
</div>
