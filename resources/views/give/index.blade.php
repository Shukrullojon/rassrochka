@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <a href="{{ route('giveCreate') }}" class="form-control btn btn-success">Men olganlar <i class="fa fa-plus"></i></a>
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
                        <form action="{{ route("giveIndex") }}" method="GET">
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
                                    <a class="btn btn-danger form-control" href="{{ route("giveIndex") }}">
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
            @foreach($gives as $give)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8">
                                    <p>{{ $give->give_name }}</p>
                                    <p>Ostatka: {{ number_format(($give->overpayment+$give->give_price)-$give->total_price) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                                </div>
                                <div class="col-4">
                                    <button class="float-right btn btn-success">
                                        <a href="tel:{{ $give->phone }}">
                                            <i style="color: white" class="fas fa-phone-alt"></i>
                                        </a>
                                    </button>

                                    <button type="button" style="margin-left: 17px" class="btn btn-primary" data-toggle="modal" data-target="#modalChangePhone{{$give->id}}">
                                        <i style="color: white" class="fas fa-edit"></i>
                                    </button>

                                    <div class="modal fade" id="modalChangePhone{{$give->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                        <div class="modal-dialog">
                                            <div class="modal-body">
                                                <form action="{{ route('giveChangePhone') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                <p>{{ $give->phone }}</p>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="give_id" value="{{ $give->id }}">
                                                            <label>Yangi nomer</label>
                                                            <input type="number" name="give_phone" class="form-control" placeholder="Yangi nomer" required>
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
                            <p>Olingan vaqt: {{ date("d.m.Y",strtotime($give->give_time)) }}</p>
                            <p>Olingan mulk: {{ $give->product_name }}</p>
                            <p>Muddat: {{ $give->product_lifetime }} @if($give->lifetime_type == 1) oy @else hafta @endif</p>
                            <p>Tannarx: {{ number_format($give->price) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Umumiy narx: {{ number_format($give->total_price) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Peredoplata: {{ number_format($give->overpayment) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Oylik to'lov: {{ number_format($give->month_pay) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    To'lovlar
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo{{$give->id}}">
                                        <i class="fa fa-caret-down"></i>
                                    </button>

                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_comment{{$give->id}}">
                                        <i class="fa fa-comment"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$give->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>

                                        <div class="modal fade" id="modalPayment{{$give->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('givePayment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    <p>{{ $give->product_name }}</p>
                                                                    <p>Oylik to'lov: {{ number_format($give->month_pay) }} @if($give->money_type == 1) $ @else so'm @endif</p>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="give_id" value="{{ $give->id }}">
                                                                <input type="hidden" name="give_money_type" value="{{ $give->money_type }}">
                                                                <label>Berilgan pul</label>
                                                                <input type="number" name="give_price" class="form-control" placeholder="Berilgan pul" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date reservationdate" id="" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                    <input required type="text" value="{{ old('give_date') }}" name="give_date" class="form-control datetimepicker-input @error('give_date') is-invalid @enderror" data-target=".reservationdate"/>
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

                                        <a href="{{ route("giveArchieve",$give->id) }}" onclick="return confirm('Arxiv bo\'limiga o\'tkazmoqchimisiz?')" class="btn btn-danger"><i class="fa fa-archive"></i></a>

                                        <button id="smsChange" give_id="{{ $give->id }}" class="sms_change_{{$give->id}} btn @if($give->notification ==1) btn-success @else btn-dark @endif"><i class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 7px">
                                <div class="col-12">
                                    <div id="demo{{$give->id}}" class="collapse">
                                        <ul class="list-group">
                                            @php $true = 1; @endphp
                                            @if(isset($give->money))
                                                @foreach($give->money as $m)
                                                    @php $true = 0; @endphp
                                                    <li class="list-group-item">
                                                        {{ date("d/m/y",strtotime($m->give_date)) }} - {{ number_format($m->price) }} @if($m->money_type == 1) $ @else so'm @endif

                                                        <a href="{{ route('givePaymentDelete',$m->id) }}" onclick="return confirm('To\'lovni o\'chirmoqchimisiz?')" class="btn btn-danger">
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
                                    <div id="demo_comment{{$give->id}}" class="collapse">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalComment{{$give->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        @foreach($give->com as $c)
                                            <p>{{ $c->comment }}</p>
                                        @endforeach
                                        <p>{{ $give->comment }}</p>

                                        <div class="modal fade" id="modalComment{{$give->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                            <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form action="{{ route('giveComment') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $give->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="give_id" value="{{ $give->id }}">
                                                                <label>Comment</label>
                                                                <textarea name="comment" required class="form-control" rows="3"></textarea>
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $gives->links() }}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on("click","#smsChange",function (){
            var give_id = $(this).attr("give_id");
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url:'{{ route('giveChangeSms') }}',
                data:{give_id:give_id},
                success:function(data){
                    if(data){
                        $(".sms_change_"+give_id).removeClass("btn-dark");
                        $(".sms_change_"+give_id).addClass("btn-success");
                    }else{
                        $(".sms_change_"+give_id).removeClass("btn-success");
                        $(".sms_change_"+give_id).addClass("btn-dark");
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
