@extends('master')
@section('title')
    Berechtigungen|{{$user->name}}
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto">
                <h1>Bearbeiten Sie die Berechtigungen für {{$user->name}}.</h1>

                @if($roles->count())
                    <form action="{{route('assign_role',[$user->slug])}}" method="post">
                        <div class="form-group">
                            <select class="form-control" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->label}}</option>
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

                    @include('layouts.errors')
                @else
                    <p class="text-muted">
                        Hat Bereits alle Berechtigungen
                    </p>
                @endif



                <table class="table">
                    <thead>
                        <tr>
                            <th>Berechtigung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->roles as $role)
                            <tr>
                                <td scope="row">{{$role->label}}</td>
                                <td class="d-flex">
                                    <form action="{{route('remove_role', [$user->slug, $role->id])}}" method="post" class="ml-auto">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        {{method_field('DELETE')}}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
