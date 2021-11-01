@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <a href="{{ route('getCreate') }}" class="form-control btn btn-success">Mendan olganlar <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-2">
                <button type="button" class="form-control btn btn-info" data-toggle="collapse" data-target="#demoSearch">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="row" style="margin-top: 7px">
            <div class="col-12">
                <div id="demoSearch" class="collapse">
                    <div class="card">
                        <form action="{{ route("getIndex") }}" method="GET">
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" name="search" placeholder="Nomi">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="col-2">
                                    <a class="btn btn-danger form-control" href="{{ route("getIndex") }}">
                                        <i class="fa fa-broom"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 7px">
            @foreach($gets as $get)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8">
                                    <p>{{ $get->get_name }}</p>
                                        <p>Ostatka: {{ number_format(($get->overpayment+$get->get_price)-$get->total_price) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                                </div>
                                <div class="col-4">
                                    <button class="float-right btn btn-success">
                                        <a href="tel:{{ $get->phone }}">
                                            <i style="color: white" class="fas fa-phone-alt"></i>
                                        </a>
                                    </button>

                                    <button type="button" style="margin-left: 17px" class="btn btn-primary" data-toggle="modal" data-target="#modalChangePhone{{$get->id}}">
                                        <i style="color: white" class="fas fa-edit"></i>
                                    </button>

                                    <div class="modal fade" id="modalChangePhone{{$get->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                        <div class="modal-dialog">
                                            <div class="modal-body">
                                                <form action="{{ route('getChangePhone') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                <p>{{ $get->phone }}</p>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="get_id" value="{{ $get->id }}">
                                                            <label>Yangi nomer</label>
                                                            <input type="number" name="get_phone" class="form-control" placeholder="Yangi nomer" required>
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

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Berilgan vaqt: {{ date("d.m.Y",strtotime($get->get_time)) }}</p>
                            <p>Sotilgan mulk: {{ $get->product_name }}</p>
                            <p>Sotilgan muddat: {{ $get->product_lifetime }} @if($get->lifetime_type == 1) oy @else hafta @endif</p>
                            <p>Tannarx: {{ number_format($get->price) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                            <p>Umumiy narx: {{ number_format($get->total_price) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                            <p>Peredoplata: {{ number_format($get->overpayment) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                            <p>Oylik to'lov: {{ number_format($get->month_pay) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    To'lovlar
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo{{$get->id}}">
                                        <i class="fa fa-caret-down"></i>
                                    </button>

                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_comment{{$get->id}}">
                                        <i class="fa fa-comment"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$get->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>

                                        <div class="modal fade" id="modalPayment{{$get->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('getPayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    <p>{{ $get->product_name }}</p>
                                                                    <p>Oylik to'lov: {{ number_format($get->month_pay) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="get_id" value="{{ $get->id }}">
                                                                <input type="hidden" name="get_money_type" value="{{ $get->money_type }}">
                                                                <label>Olingan pul</label>
                                                                <input type="number" name="get_price" class="form-control" placeholder="Olingan pul" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('get_date') }}" name="get_date" class="form-control datetimepicker-input @error('get_date') is-invalid @enderror" data-target=".reservationdate"/>
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
                                        <!-- Modal -->
                                        <a href="{{ route("getArchieve",$get->id) }}" onclick="return confirm('Arxiv bo\'limiga o\'tkazmoqchimisiz?')" class="btn btn-danger"><i class="fa fa-archive"></i></a>
                                        <button id="smsChange" get_id="{{ $get->id }}" class="sms_change_{{$get->id}} btn @if($get->notification ==1) btn-success @else btn-dark @endif"><i class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 7px">
                                <div class="col-12">
                                    <div id="demo{{$get->id}}" class="collapse">
                                        <ul class="list-group">
                                            @php $true = 1; @endphp
                                            @if(isset($get->money))
                                                @foreach($get->money as $m)
                                                    @php $true = 0; @endphp
                                                    <li class="list-group-item">
                                                        {{ date("d/m/y",strtotime($m->get_date)) }} - {{ number_format($m->price) }} @if($m->money_type == 1) $ @else so'm @endif

                                                        <a href="{{ route('getPaymentDelete',$m->id) }}" onclick="return confirm('To\'lovni o\'chirmoqchimisiz?')" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif

                                            @if($true)
                                                <li class="list-group-item">To'lov bo'lmagan</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 7px">
                                <div class="col-12">
                                    <div id="demo_comment{{$get->id}}" class="collapse">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalComment{{$get->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        @foreach($get->com as $c)
                                            <p>{{ $c->comment }} {{ date("d/m/Y",strtotime($c->send_date)) }} @if($c->sms) <i style="color: green" class="fa fa-envelope"></i>  @else <i style="color: red" class="fa fa-envelope"></i>  @endif</p>
                                        @endforeach
                                        <p>{{ $get->comment }}</p>
                                        <div class="modal fade" id="modalComment{{$get->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('getComment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $get->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="get_id" value="{{ $get->id }}">
                                                                <label>Comment</label>
                                                                <textarea name="comment" required class="form-control" rows="3"></textarea>

                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('send_date') }}" name="send_date" class="form-control datetimepicker-input @error('send_date') is-invalid @enderror" data-target=".reservationdate"/>
                                                                </div>

                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Sms</label>
                                                                    <select name="sms" class="form-control">
                                                                        <option value="0">Sms yuborilmasin</option>
                                                                        <option value="1">Sms yuborilsin</option>
                                                                    </select>
                                                                    @error('sms')
                                                                    <p style="color: red" class="error">{{ $message }}</p>
                                                                    @enderror
                                                                </fieldset>

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
                                        <!-- Modal -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $gets->links() }}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on("click","#smsChange",function (){
            var get_id = $(this).attr("get_id");
            //$(this).attr('class', 'btn btn-dark');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url:'{{ route('getChangeSms') }}',
                data:{get_id:get_id},
                success:function(data){
                    if(data){
                        $(".sms_change_"+get_id).removeClass("btn-dark");
                        $(".sms_change_"+get_id).addClass("btn-success");
                    }else{
                        $(".sms_change_"+get_id).removeClass("btn-success");
                        $(".sms_change_"+get_id).addClass("btn-dark");
                    }
                }
            });
        });

        //Date picker
        $('.reservationdate').datetimepicker({
            format:'DD.MM.YYYY',
        });
    </script>
@endsection
