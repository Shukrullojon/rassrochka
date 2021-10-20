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
                @foreach($gets as $get)
                    <tr>
                        <td>{{ $get->get_name }}</td>
                        <td>{{ $get->product_name }}</td>
                        <td>
                            <a href="{{ route('archieveGetView',$get->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $gets->links() }}
    </div>
@endsection
