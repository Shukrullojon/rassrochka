@extends('layouts.admin')
@section('content')
    <div class="container-fluid" style="margin-top: 7px">
        <div class="card card-body">
            <table class="table table-hover">
                <tr>
                    <th>Ism</th>
                    <th>{{ $give->give_name }}</th>
                </tr>

                <tr>
                    <th>Telefon</th>
                    <th>{{ $give->phone }}</th>
                </tr>

                <tr>
                    <th>Berilgan vaqt</th>
                    <th>{{ date("Y.m.d",strtotime($give->give_time)) }}</th>
                </tr>

                <tr>
                    <th>Sotilgan mulk</th>
                    <th>{{ $give->product_name }}</th>
                </tr>

                <tr>
                    <th>Sotilgan muddat</th>
                    <th>{{ $give->product_lifetime }} @if($give->lifetime_type == 1) oy @else hafta @endif</th>
                </tr>

                <tr>
                    <th><p>Tannarx</th>
                    <th><p>{{ number_format($give->price) }} @if($give->money_type == 1) $ @else so'm @endif</p></th>
                </tr>

                <tr>
                    <th>Umumiy narx</th>
                    <th>{{ number_format($give->total_price) }} @if($give->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Peredoplata</th>
                    <th>{{ number_format($give->overpayment) }} @if($give->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Oylik to'lov</th>
                    <th>{{ number_format($give->month_pay) }} @if($give->money_type == 1) $ @else so'm @endif</th>
                </tr>

                <tr>
                    <th>Ostatka</th>
                    <th>
                        {{ number_format(($give->overpayment+$give->give_price)-$give->total_price) }}
                    </th>
                </tr>

                <tr>
                    <th>Comment</th>
                    <th>
                        {{ $give->comment }}<br>
                        @foreach($give->com as $c)
                            {{ $c->comment }}
                            <br>
                        @endforeach
                    </th>
                </tr>

                <tr>
                    <th>To'lovlar</th>
                    <th>
                        @foreach($give->money as $m)
                            <li class="list-group-item">
                                {{ date("d/m/y",strtotime($m->give_date)) }} - {{ number_format($m->price) }} @if($m->money_type == 1) $ @else so'm @endif
                            </li>
                        @endforeach
                    </th>
                </tr>
            </table>
        </div>
    </div>
@endsection
