@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="card">
            @if(count($today_month_get)>0 or count($today_week_get)>0)
                <div class="card-header"><b>Bugun olinishi kerak</b></div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Nomi</th>
                            <th>Mulk</th>
                            <th>Ostatka</th>
                            <th></th>
                        </tr>

                        @foreach($today_month_get as $tmg)
                            @if(!$tmg->Check($tmg->id))
                                <tr>
                                    <td>{{ $tmg->get_name }}</td>
                                    <td>{{ $tmg->product_name }}</td>
                                    <td>{{ number_format(($tmg->overpayment+$tmg->get_price)-$tmg->total_price) }} @if($tmg->money_type == 1) $ @else so'm @endif</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$tmg->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <div class="modal fade" id="modalPayment{{$tmg->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('homePayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $tmg->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="get_id" value="{{ $tmg->id }}">
                                                                <input type="hidden" name="get_money_type" value="{{ $tmg->money_type }}">
                                                                <label>Narxi</label>
                                                                <input type="number" name="get_price" class="form-control" placeholder="Olingan narx" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('get_date') }}" name="get_date" class="form-control datetimepicker-input @error('get_date') is-invalid @enderror" data-target="#reservationdate"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>]
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @foreach($today_week_get as $twg)
                            @if(!$tmg->Check($twg->id))
                                <tr>
                                    <td>{{ $twg->get_name }}</td>
                                    <td>{{ $twg->product_name }}</td>
                                    <td>{{ number_format(($twg->overpayment+$twg->get_price)-$twg->total_price) }} @if($twg->money_type == 1) $ @else so'm @endif</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$twg->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <div class="modal fade" id="modalPayment{{$twg->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('homePayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $twg->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="get_id" value="{{ $twg->id }}">
                                                                <input type="hidden" name="get_money_type" value="{{ $twg->money_type }}">
                                                                <label>Narxi</label>
                                                                <input type="number" name="get_price" class="form-control" placeholder="Olingan narx" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('get_date') }}" name="get_date" class="form-control datetimepicker-input @error('get_date') is-invalid @enderror" data-target="#reservationdate"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>]
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endif

            @if(count($today_month_give)>0 or count($today_week_give)>0)
                <div class="card-header"><b>Bugun berilishi kerak</b></div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Nomi</th>
                            <th>Mulk</th>
                            <th>Ostatka</th>
                            <th></th>
                        </tr>

                        @foreach($today_month_give as $tmg)
                            @if(!$tmg->Check($tmg->id))
                                <tr>
                                    <td>{{ $tmg->give_name }}</td>
                                    <td>{{ $tmg->product_name }}</td>
                                    <td>{{ number_format(($tmg->overpayment+$tmg->give_price)-$tmg->total_price) }} @if($tmg->money_type == 1) $ @else so'm @endif</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$tmg->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <div class="modal fade" id="modalPayment{{$tmg->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('homePayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $tmg->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="give_id" value="{{ $tmg->id }}">
                                                                <input type="hidden" name="give_money_type" value="{{ $tmg->money_type }}">
                                                                <label>Narxi</label>
                                                                <input type="number" name="give_price" class="form-control" placeholder="Olingan narx" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('give_date') }}" name="give_date" class="form-control datetimepicker-input @error('get_date') is-invalid @enderror" data-target="#reservationdate"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>]
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @foreach($today_week_give as $twg)
                            @if(!$twg->Check($twg->id))
                                <tr>
                                    <td>{{ $twg->give_name }}</td>
                                    <td>{{ $twg->product_name }}</td>
                                    <td>{{ number_format(($twg->overpayment+$twg->give_price)-$twg->total_price) }} @if($twg->money_type == 1) $ @else so'm @endif</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$twg->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <div class="modal fade" id="modalPayment{{$twg->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('homePayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $twg->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="give_id" value="{{ $twg->id }}">
                                                                <input type="hidden" name="give_money_type" value="{{ $twg->money_type }}">
                                                                <label>Narxi</label>
                                                                <input type="number" name="give_price" class="form-control" placeholder="Olingan narx" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('give_date') }}" name="give_date" class="form-control datetimepicker-input @error('get_date') is-invalid @enderror" data-target="#reservationdate"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>]
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        //Date picker
        $('.reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endsection
