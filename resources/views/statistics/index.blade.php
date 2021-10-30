@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Statistika</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="text-align:center; margin-top: 20px">Umumiy tannarx</th>
                        <th>{{ number_format($priceD->price) }} $</th>
                        <th>{{ number_format($priceS->price) }} so'm</th>
                    </tr>

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Umumiy sotilgan narx</th>
                        <th>{{ number_format($priceD->total_price) }} $</th>
                        <th>{{ number_format($priceS->total_price) }} so'm</th>
                    </tr>

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Umumiy foyda</th>
                        <th>{{ number_format($priceD->total_price - $priceD->price) }} $</th>
                        <th>{{ number_format($priceS->total_price - $priceS->price) }} so'm</th>
                    </tr>

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Arxiv foyda</th>
                        <th>{{ number_format($arxiv_d->useful_price) }} $</th>
                        <th>{{ number_format($arxiv_s->useful_price) }} so'm</th>
                    </tr>
                </table>
                <br>
                <table class="table table-bordered">

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Umumiy ostatka</th>
                        <th>{{ number_format($getOsD) }} $</th>
                        <th>{{ number_format($getOsS) }} so'm</th>
                    </tr>

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Xozirgi qarz</th>
                        <th>{{ number_format($giveOsD) }} $</th>
                        <th>{{ number_format($giveOsS) }} so'm</th>
                    </tr>

                    <tr>
                        <th style="text-align:center; margin-top: 20px">Ostatka oxirgi</th>
                        <th>{{ number_format($getOsD - $giveOsD) }} $</th>
                        <th>{{ number_format($getOsS - $giveOsS) }} so'm</th>
                    </tr>
                </table>

            </div>
        </div>
    </div>
@endsection
