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
                                <th scope="row">{{$user->name}}</th>
                                <td class="d-flex justify-content-end">
                                    <a class="mr-2 btn btn-warning" href="{{route('roles_user', $user->slug)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
