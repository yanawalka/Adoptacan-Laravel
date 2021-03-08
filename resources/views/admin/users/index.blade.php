@extends('admin')


@section('title','Lista de Usuarios')


@section('content')
  <a href="{{ route('admin.users.create')}}" class="btn btn-info">Nuevo Usuario</a> <hr>
  <table class="table table-striped">
    <thead>
      <th>ID</th>
      <th>USUARIO</th>
      <th>TIPO</th>
      <th>BAJA</th>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->tipo }} </td>
           <td>{{ $user->baja }} </td>
          <td>
            <a href="{{ route('admin.users.edit',$user->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span> </a>
            <a href="{{ route('admin.users.destroy',$user->id)}}" 
              onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a> </td>
        </tr>
      @endforeach

    </tbody>
    

  </table>

  {{ $users->appends(Request::all())->render() }}

@endsection 