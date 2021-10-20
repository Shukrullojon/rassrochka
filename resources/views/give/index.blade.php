@extends('layouts.admin')

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
                                <div class="col-10">
                                    <input type="text" class="form-control" name="search" placeholder="Nomi">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary form-control">Search</button>
                                </div>
                                <div class="col-1">
                                    <a class="btn btn-danger form-control" href="{{ route("giveIndex") }}">Clear</a>
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
                                <div class="col-7">
                                    @if((($give->overpayment+$give->give_price)/$give->total_price)*100>100)
                                        <button class="btn btn-success"><i class="fa fa-check"></i></button>
                                    @endif
                                    {{ $give->give_name }}
                                </div>
                                <div class="col-3">
                                    <div style="margin-top: 5px" class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{(($give->overpayment+$give->give_price)/$give->total_price)*100}}%">
                                            {{ (($give->overpayment+$give->give_price)/$give->total_price)*100 }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="float-right btn btn-success">
                                        <a href="{{ $give->phone }}"><i class="fas fa-phone-alt" style="color: green"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Olingan vaqt: {{ date("Y.m.d",strtotime($give->give_time)) }}</p>
                            <p>Olingan mulk: {{ $give->product_name }}</p>
                            <p>Muddat: {{ $give->product_lifetime }} @if($give->lifetime_type == 1) oy @else hafta @endif</p>
                            <p>Tannarx: {{ number_format($give->price,'2') }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Umumiy narx: {{ number_format($give->total_price,'2') }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Peredoplata: {{ number_format($give->overpayment,'2') }} @if($give->money_type == 1) $ @else so'm @endif</p>
                            <p>Ostatka: {{ number_format(($give->overpayment+$give->give_price)-$give->total_price) }}</p>
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
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalPayment{{$give->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="{{ route('givePayment') }}" method="POST">
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
                                                            <input type="hidden" name="give_money_type" value="{{ $give->money_type }}">
                                                            <input type="text" name="give_price" class="form-control" placeholder="Narx" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <a href="{{ route("giveArchieve",$give->id) }}" class="btn btn-danger"><i class="fa fa-archive"></i></a>
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
                                                        {{ date("d/m/y",strtotime($m->give_date)) }} - {{ number_format($m->price,'2') }} @if($m->money_type == 1) $ @else so'm @endif
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
                                        Comment: {{ $give->comment }}
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
    </script>
@endsection
