<!-- Id Field -->
<div class="col-sm-12">
  {!! Form::label('id', 'Id:') !!}
  <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
  {!! Form::label('email', 'Email:') !!}
  <p>{{ $user->email }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{{ $user->created_at }}</p>
</div>
