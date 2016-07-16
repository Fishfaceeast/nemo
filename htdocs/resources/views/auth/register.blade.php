@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/auth/index.css">

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">注册</div>
                    <div class="card-block">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group clearfix{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">用户名</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">城市</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('birth_year') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">出生年</label>

                                <div class="col-md-6">
                                    <?php $minY = intval(date('Y', time() - 86400*365*88));?>
                                    <?php $y = intval(date('Y', time() - 86400*365*18));?>
                                    <select class="form-control form-control-select" name="birth_year">
                                        @for ($y; $y > $minY; $y--)
                                            <option value={{ $y }}>{{ $y }}</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('birth_year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birth_year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">性别</label>

                                <div class="col-md-6">
                                    <div class="form-control form-control-radio">
                                        <input type="radio" name="gender" value="男" checked/> 男
                                        <input type="radio" name="gender" value="女"/> 女
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix{{ $errors->has('target_gender') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">寻找</label>

                                <div class="col-md-6">
                                    <div class="form-control form-control-radio">
                                        <input type="radio" name="target_gender" value="男"/> 男
                                        <input type="radio" name="target_gender" value="女" checked/> 女
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>注册
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
