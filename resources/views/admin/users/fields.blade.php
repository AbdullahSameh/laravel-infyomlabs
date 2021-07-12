<!-- Name Field -->
<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
  {!! Form::label('email', 'Email') !!}
  {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
  {!! Form::label('password', 'Password') !!}
  {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
  {!! Form::label('password', 'Password Confirmation') !!}
  {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-12">
  {!! Form::label('roles', 'Roles:') !!}
  <div style="padding-bottom: 4px">
    <span class="btn btn-success btn-sm select-all">Select All</span>
    <span class="btn btn-danger btn-sm deselect-all">Deselect All</span>
  </div>
  <select class="custom-select select2" size="10" name="roles[]" id="roles" placeholder="Choose Roles" multiple>
    @foreach ($roles as $role)
      <option value="{{ $role->id }}" {{ isset($user) && $user->hasRole($role) ? 'selected' : '' }}>
        {{ $role->name }}
      </option>
    @endforeach
  </select>
</div>
