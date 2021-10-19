@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('getCreate') }}" class="form-control btn btn-success">Mendan olganlar <i class="fa fa-plus"></i></a>
        <div class="row" style="margin-top: 7px">
            @foreach($gets as $get)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-7">
                                    {{ $get->get_name }}
                                </div>
                                <div class="col-3">
                                    <div style="margin-top: 5px" class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                             aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                            40%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="float-right btn btn-success">
                                        <a href="{{ $get->phone }}"><i class="fas fa-phone-alt" style="color: green"></i></a>
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
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPayment{{$get->id}}">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalPayment{{$get->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                            <input type="text" name="get_price" class="form-control" placeholder="Olingan narx" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <a href="{{ route("getArchieve",$get->id) }}" class="btn btn-danger"><i class="fa fa-archive"></i></a>
                                        <button id="smsChange" get_id="{{ $get->id }}" class="sms_change_{{$get->id}} btn @if($get->notification ==1) btn-success @else btn-dark @endif"><i class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 7px">
                                <div class="col-12">
                                    <div id="demo{{$get->id}}" class="collapse">
                                        <ul class="list-group">
                                            @if(!empty($get->money))
                                                @foreach($get->money as $m)
                                                    <li class="list-group-item">{{ date("d/m/y",strtotime($m->get_date)) }} - {{ number_format($m->price,'2') }} @if($m->money_type == 1) $ @else so'm @endif</li>
                                                @endforeach
                                            @endif

                                            @if(empty($get->money))
                                                <li class="list-group-item">To'lov bo'lmagan</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
    </script>
@endsection
