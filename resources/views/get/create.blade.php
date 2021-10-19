@extends('layouts.create')
@section('content')

    <div class="card container-fluid">
            <form action="{{ route('getStore') }}" method="POST" enctype="">
            {{ csrf_field() }}
            @csrf

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Sotib olganning ismi</label>
                        <input type="text" value="{{ old('get_name') }}" name="get_name" class="form-control cc @error('get_name') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('get_name')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label>Berilgan vaqti</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" value="{{ old('get_time') }}" name="get_time" class="form-control datetimepicker-input @error('get_time') is-invalid @enderror" data-target="#reservationdate"/>
                        </div>
                        @error('get_time')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Telefon</label>
                        <input type="text" value="{{ old('phone') }}" name="phone" class="form-control @error('phone') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('phone')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Sotilgan mulk</label>
                        <input type="text" value="{{ old('product_name') }}" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('product_name')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-3 col-md-3 col-3 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">To'lash turi</label>
                        <select id="tolash_turi" name="lifetime_type" class="form-control">
                            <option value="1">Oy</option>
                            <option value="2">Hafta</option>
                        </select>
                        @error('lifetime_type')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>

                <div class="col-xl-5 col-md-5 col-5 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Sotilgan muddati</label>
                        <input type="text" value="{{ old('product_lifetime') }}" name="product_lifetime" class="form-control @error('product_lifetime') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('product_lifetime')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>

                <div class="col-xl-4 col-md-4 col-4 mb-1">
                    <fieldset class="form-group" id="tolash_kuni">
                        <label for="basicInput">To'lash kuni</label>
                        <input type="text" value="{{ old('day') }}" name="day" class="form-control @error('day') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('day')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Pul birligi</label>
                        <select name="money_type" class="form-control">
                            <option value="1">$$$$</option>
                            <option value="2">So'm</option>
                        </select>
                        @error('lifetime_type')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Tannarxi</label>
                        <input type="text" value="{{ old('price') }}" name="price" class="form-control @error('price') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('price')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Umumiy narx</label>
                        <input type="text" value="{{ old('total_price') }}" name="total_price" class="form-control @error('total_price') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('total_price')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Peredoplata</label>
                        <input type="text" value="{{ old('overpayment') }}" name="overpayment" class="form-control @error('overpayment') is-invalid @enderror" id="basicInput" placeholder="">
                        @error('overpayment')
                        <p style="color: red" class="error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <fieldset class="form-group">
                        <label for="basicInput">Comment</label>
                        <textarea class="form-control" rows="4"></textarea>
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-success form-control">Save</button>
            </div>
        </form>

    </div>

@endsection

@section('scripts')
    <script>
        $("#tolash_turi").on("change",function (){
            var tur = $(this).val();
            //alert($tur);
            if(tur == 1){
                var t = '<label for="basicInput">To\'lash kuni</label><input type="text" value="" name="day" class="form-control" id="basicInput" placeholder="">';
                $("#tolash_kuni").html(t);
            }else{
                var t ='<label for="basicInput">To\'lash kuni</label>'+
                    '<select name="day" class="form-control">'+
                    '<option value="1">Dushanba</option>'+
                    '<option value="2">Seshanba</option>'+
                    '<option value="3">Chorshanba</option>'+
                    '<option value="4">Payshanba</option>'+
                    '<option value="5">Juma</option>'+
                    '<option value="6">Shanba</option>'+
                    '<option value="7">Yakshanba</option>'+
                    '</select>';
                $("#tolash_kuni").html(t);
            }
        });

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

    </script>
@endsection
