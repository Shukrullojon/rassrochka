@extends('layouts.app')

@section('content')

    <a href="" class="form-control btn btn-success">Mendan olganlar <i class="fa fa-plus"></i></a>
    <div class="row" style="margin-top: 7px">
        @foreach($gets as $get)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{ $get->get_name }}

                        <button class="float-right btn btn-success">
                            <a href="{{ $get->phone }}"><i class="fas fa-phone-alt" style="color: green"></i></a>
                        </button>
                    </div>
                    <div class="card-body">
                        <p>Berilgan vaqt: {{ date("Y.m.d",strtotime($get->get_time)) }}</p>
                        <p>Sotilgan mulk: {{ $get->product_name }}</p>
                        <p>Sotilgan muddat: {{ $get->product_lifetime }} @if($get->lifetime_type == 1) oy @else hafta @endif</p>
                        <p>Tannarx: {{ number_format($get->price,'2') }} @if($get->money_type == 1) $ @else so'm @endif</p>
                        <p>Umumiy narx: {{ number_format($get->total_price,'2') }} @if($get->money_type == 1) $ @else so'm @endif</p>
                        <p>Peredoplata: {{ number_format($get->overpayment,'2') }} @if($get->money_type == 1) $ @else so'm @endif</p>
                    </div>
                    <div class="card-footer">
                        To'lovlar
                        <div class="float-right">
                            <button class="btn btn-primary"><i class="fa fa-plus-square"></i></button>
                            <button class="btn btn-danger"><i class="fa fa-archive"></i></button>
                        </div>
                        @if(!empty($get->money))
                            @foreach($get->money as $m)
                                <p>{{ date("d/m/y",strtotime($m->get_date)) }} - {{ number_format($m->price,'2') }} @if($m->money_type == 1) $ @else so'm @endif</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection
