@extends('layouts.admin')
@section('content')
    <div class="container-fluid" style="margin-top: 7px">
        <div class="card card-body">
            <table class="table table-hover">
                <tr>
                    <th>Ism</th>
                    <th>{{ $get->get_name }}</th>
                </tr>

                <tr>
                    <th>Telefon</th>
                    <th>{{ $get->phone }}</th>
                </tr>

                <tr>
                    <th>Berilgan vaqt</th>
                    <th>{{ date("Y.m.d",strtotime($get->get_time)) }}</th>
                </tr>

                <tr>
                    <th>Sotilgan mulk</th>
                    <th>{{ $get->product_name }}</th>
                </tr>

                <tr>
                    <th>Sotilgan muddat</th>
                    <th>{{ $get->product_lifetime }} @if($get->lifetime_type == 1) oy @else hafta @endif</th>
                </tr>

                <tr>
                    <th><p>Tannarx</th>
                    <th><p>{{ number_format($get->price) }} @if($get->money_type == 1) $ @else so'm @endif</p></th>
                </tr>

                <tr>
                    <th>Umumiy narx</th>
                    <th>{{ number_format($get->total_price) }} @if($get->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Peredoplata</th>
                    <th>{{ number_format($get->overpayment) }} @if($get->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Oylik to'lov</th>
                    <th>{{ number_format($get->month_pay) }} @if($get->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Ostatka</th>
                    <th>
                        {{ number_format(($get->overpayment+$get->get_price)-$get->total_price) }}
                    </th>
                </tr>

                <tr>
                    <th>Comment</th>
                    <th>
                        {{ $get->comment }} <br>
                        @foreach($get->com as $c)
                                {{ $c->comment }}
                                <br>
                        @endforeach
                    </th>
                </tr>

                <tr>
                    <th>To'lovlar</th>
                    <th>
                        @foreach($get->money as $m)
                            <li class="list-group-item">
                                {{ date("d/m/y",strtotime($m->get_date)) }} - {{ number_format($m->price) }} @if($m->money_type == 1) $ @else so'm @endif
                            </li>
                        @endforeach
                    </th>
                </tr>
            </table>
        </div>
    </div>
@endsection
