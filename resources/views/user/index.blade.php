@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Users
                <a href="{{ route('userCreate')  }}" class="btn btn-success" style="float: right">
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Ism</th>
                        <th>Phone</th>
                        <th>Sms</th>
                        <th></th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if($user->sms)
                                    <i style="color: green" class="fa fa-power-off"></i>
                                @else
                                    <i style="color: red" class="fa fa-power-off"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route("userEdit",$user->id) }}" class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route("userDelete",$user->id) }}" onclick="return confirm('User o\'chirmoqchimisiz?')" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
