@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><b>Bugun olinishi kerak</b></div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Nomi</th>
                        <th>Mulk</th>
                    </tr>

                    @foreach($today_month_get as $tmg)
                        <tr>
                            <td>{{ $tmg->get_name }}</td>
                            <td>{{ $tmg->product_name }}</td>
                        </tr>
                    @endforeach

                    @foreach($today_week_get as $twg)
                        <tr>
                            <td>{{ $twg->get_name }}</td>
                            <td>{{ $twg->product_name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="card-header"><b>Bugun berilishi kerak</b></div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Nomi</th>
                        <th>Mulk</th>
                    </tr>

                    @foreach($today_month_give as $tmg)
                        <tr>
                            <td>{{ $tmg->give_name }}</td>
                            <td>{{ $tmg->product_name }}</td>
                        </tr>
                    @endforeach

                    @foreach($today_week_give as $twg)
                        <tr>
                            <td>{{ $twg->give_name }}</td>
                            <td>{{ $twg->product_name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
