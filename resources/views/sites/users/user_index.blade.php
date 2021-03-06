@extends('master')
@section('title')
    Benutzer
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto row">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">
                                    <a href="{{route('user_show', $user->slug)}}">{{$user->name}}</a>
                                    @foreach ($user->roles as $role)
                                        <span class="badge badge-pill badge-dark">{{$role->label}}</span>
                                    @endforeach
                                </th>
                                @can('superadmin', Auth::user())
                                    <td class="d-flex justify-content-end">
                                        <a class="mr-2 btn btn-warning" href="{{route('roles_user', $user->slug)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{-- <form action="{{route('delete_user', $user->slug)}}" method="post">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form> --}}
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
