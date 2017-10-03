@extends('master')
@section('title')
    Berechtigungen
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto">
                <h1>Berechtigungen</h1>

                <form action="{{route('store_role')}}" method="post">
                    <div class="form-group">
                        <label for="role_name">Name:</label>
                        <input type="text" name="name" id="role_name" class="form-control" value="{{old('name')}}">
                        @if($errors->has('name'))
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ucfirst($errors->first('name'))}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="role_label">Label:</label>
                        <input type="text" name="label" id="role_label" class="form-control" value="{{old('label')}}">
                        @if($errors->has('label'))
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ucfirst($errors->first('label'))}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">
                            <i class="fa fa-plus"></i> Hinzufügen
                        </button>
                    </div>

                    {{ csrf_field() }}
                </form>
                @foreach ($roles as $role)
                    <div class="card mb-4">
                        <div class="card-header d-flex">
                            {{ucfirst($role->name)}}

                            <form action="{{route('delete_role', $role->id)}}" class="ml-auto" method="post">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="card-body">
                            @if($role->name != 'superadmin' && $permissions->diff($role->permissions)->count())
                                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#permissions{{$role->id}}" aria-expanded="false" aria-controls="permissions">
                                    <i class="fa fa-plus"></i> Rechte
                                </button>
                                <div class="collapse" id="permissions{{$role->id}}">
                                    <div class="card card-body mt-2">
                                        <form action="{{route('roles_store_permission', $role->id)}}" method="post">
                                            <div class="form-group">
                                                <select class="form-control" name="permission">
                                                    @foreach($permissions->diff($role->permissions) as $permission)
                                                        <option value="{{$permission->id}}">{{$permission->label}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success form-control">
                                                    <i class="fa fa-plus"></i> Hinzufügen
                                                </button>
                                            </div>
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">
                                    Darf alles...
                                </p>
                            @endif
                            @foreach ($role->permissions as $permission)
                                <table class="table">
                                    <tr>
                                        <td>{{$permission->label}}</td>
                                        <td class="d-flex">
                                            <form action="{{route('roles_remove_permission', [$role->id, $permission->id])}}" class="ml-auto" method="post">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                {{method_field('DELETE')}}
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
