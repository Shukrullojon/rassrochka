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
                                <div class="col-10">
                                    <input type="text" class="form-control" name="search" placeholder="Nomi">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary form-control">Search</button>
                                </div>
                                <div class="col-1">
                                    <a class="btn btn-danger form-control" href="{{ route("getIndex") }}">Clear</a>
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
                                <div class="col-10">
                                    <p>{{ $get->get_name }}</p>
                                        <p>Ostatka: {{ number_format(($get->overpayment+$get->get_price)-$get->total_price) }} @if($get->money_type == 1) $ @else so'm @endif</p>
                                </div>
                                <div class="col-2">
                                    <button class="float-right btn btn-success">
                                        <a href="tel:{{ $get->phone }}">
                                            <i style="color: white" class="fas fa-phone-alt"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
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
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $get->product_name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="get_id" value="{{ $get->id }}">
                                                                <input type="hidden" name="get_money_type" value="{{ $get->money_type }}">
                                                                <label>Narxi</label>
                                                                <input type="number" name="get_price" class="form-control" placeholder="Olingan narx" required>
                                                                <label>Vaqti</label>
                                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
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
                                        <!-- Modal -->
                                        <a href="{{ route("getArchieve",$get->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-archive"></i></a>
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
                                                        {{ date("d/m/y",strtotime($m->get_date)) }} - {{ number_format($m->price,'2') }} @if($m->money_type == 1) $ @else so'm @endif
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
                                            <p>{{ $c->comment }}</p>
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
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endsection
