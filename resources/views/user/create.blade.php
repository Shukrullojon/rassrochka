@extends('layouts.create')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form action="{{ route("userStore") }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Ism</label>
                                <input type="text" required value="{{ old('name') }}" name="name" class="form-control cc @error('name') is-invalid @enderror" id="basicInput" placeholder="">
                                @error('name')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" required value="{{ old('email') }}" name="email" class="form-control cc @error('email') is-invalid @enderror" id="basicInput" placeholder="">
                                @error('email')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Telefon</label>
                                <input type="number" required value="{{ old('phone') }}" name="phone" class="form-control cc @error('phone') is-invalid @enderror" id="basicInput" placeholder="">
                                @error('phone')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Sms</label>
                                <select name="sms" class="form-control">
                                    <option value="1">Sms yuborilsin</option>
                                    <option value="0">Sms yuborilmasin</option>
                                </select>
                                @error('sms')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Parol</label>
                                <input type="password" required value="{{ old('password') }}" name="password" class="form-control cc @error('password') is-invalid @enderror" id="basicInput" placeholder="">
                                @error('password')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Parol tasdiqlash</label>
                                <input type="password" required value="{{ old('confirm_password') }}" name="confirm_password" class="form-control cc @error('confirm_password') is-invalid @enderror" id="basicInput" placeholder="">
                                @error('confirm_password')
                                    <p style="color: red" class="error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success form-control">Saqlash</button>

                </form>
            </div>
        </div>
    </div>
@endsection
