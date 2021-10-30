@extends('layouts.admin')

@section('content')
    <div class="container-fluid" style="margin-top: 7px">
        <div class="card card-body">
            <table class="table table-hover">
                <tr>
                    <th>Ism</th>
                    <th>Mulk</th>
                    <th></th>
                </tr>
                @foreach($gives as $give)
                    <tr>
                        <td>{{ $give->give_name }}</td>
                        <td>{{ $give->product_name }}</td>
                        <td>
                            <a href="{{ route('archieveGiveView',$give->id) }}" class="btn btn-success">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="{{ route('givedelete',$give->id) }}" class="btn btn-danger" onclick="return confirm('O\'chirmoqchimisiz?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $gives->links() }}
    </div>
@endsection
