@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/profile/index.css">

@endsection

@section('content')

    <div class="main-container clearfix">
        <!-- Content here -->

        <!-- Current Basics -->
        <div class="info-wrapper basic-info-wrapper clearfix">
            <img class="avatar" src="/img/avatar.png"/>
            <div class="basic-info">
                <h5>
                    {{ Auth::user()->name }}
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </h5>
                <p class="info-content">{{ $basic['gender']['value'] or '——' }} • {{ $basic['city']['value'] or '——' }} • {{ $basic['birth_year']['value'] or '——' }}</p>
            </div>
        </div>

        <!-- Current Looking For -->
        <div class="info-wrapper target-info-wrapper">
            <div class="target-info">
                <h4>希望对方</h4>
                <div class="info-content">
                    @if (count($target) > 0)
                        @foreach ($target as $item)
                            <p>{{ $item['cname'] }}: {{ $item['value'] or '——' }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#about" role="tab">关于我</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#refer" role="tab">朋友说</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- About -->
            <div class="tab-pane active info-wrapper about-info-wrapper" id="about" role="tabpanel">
                @if (count($about) > 0)
                    @foreach ($about as $item)
                        <p>{{ $item['cname'] }}: {{ $item['value'] or '——' }}</p>
                    @endforeach
                @endif
            </div>
            <!-- Refers -->
            @if (count($refers) > 0)
                <div class="tab-pane info-wrapper refer-info-wrapper" id="refer" role="tabpanel">
                    @foreach ($refers as $refer)
                        <p>推荐原因: {{ $refer->why }}</p>
                        <p>描述: {{ $refer->description }}</p>
                        <p>你们的故事: {{ $refer->story }}</p>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Current Details -->
        <div class="info-wrapper detail-info-wrapper">
            <div class="detail-info">
                <h5>我的更多细节</h5>
                <div class="info-content">
                    @if (count($detail) > 0)
                        @foreach ($detail as $item)
                            <p>{{ $item['cname'] }}: {{ $item['value'] or '——' }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div id="basic-info-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">你的基本信息</h4>
                    </div>
                    <div class="modal-body">
                        <form id="basicForm" action="/basic/update" method="POST">
                            <div class="form-group">
                                <label for="gender">性别</label>
                                <input type="text" name="gender"/>
                            </div>
                            <div class="form-group">
                                <label for="city">城市</label>
                                <input type="text" name="city"/>
                            </div>
                            <div class="form-group">
                                <label for="birth_year">出生年</label>
                                <input type="text" name="birth_year"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary basic-modify">保存设置</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="target-info-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">希望对方</h4>
                    </div>
                    <div class="modal-body">
                        <form id="targetForm" action="/target/update" method="POST">
                            <div class="form-group">
                                <label for="target_gender">目标群体</label>
                                <input type="text" name="target_gender"/>
                            </div>
                            <div class="form-group">
                                <label for="ageMin">最小年龄</label>
                                <input type="text" name="ageMin"/>
                            </div>
                            <div class="form-group">
                                <label for="ageMax">最大年龄</label>
                                <input type="text" name="ageMax"/>
                            </div>
                            <div class="form-group">
                                <label for="isSingle">一定要单身么</label>
                                <input type="text" name="isSingle"/>
                            </div>
                            <div class="form-group">
                                <label for="isNearBy">一定要同城么</label>
                                <input type="text" name="isNearBy"/>
                            </div>
                            <div class="form-group">
                                <label for="relationship">预期关系</label>
                                <input type="text" name="relationship"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary target-modify">保存设置</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="aboutInfo" class="hidden" action="/about/update" method="POST">
            <label for="summary">关于我
                <input type="text" name="summary"/>
            </label>
            <label for="routine">每天我都在干啥
                <input type="text" name="routine"/>
            </label>
            <label for="skills">我比较擅长
                <input type="text" name="skills"/>
            </label>
            <label for="favorite">我最喜欢的书 电影 音乐 食物
                <input type="text" name="favorite"/>
            </label>
            <label for="necessities">没有这几样我会抓狂
                <input type="text" name="necessities"/>
            </label>
            <label for="concerns">我会想这些问题
                <input type="text" name="concerns"/>
            </label>
            <label for="friday">周五晚上我会做些啥
                <input type="text" name="friday"/>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Modify
            </button>
        </form>
        <form id="refer" class="hidden" action="/refer/update" method="POST">
            <label for="why">why
                <input type="text" name="why"/>
            </label>
            <label for="description">描述
                <input type="text" name="description"/>
            </label>
            <label for="story">你们的故事
                <input type="text" name="story"/>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Modify
            </button>
        </form>

        <form id="detailInfo" class="hidden" action="/detail/update" method="POST">
            <label for="orientation">取向
                <input type="text" name="orientation"/>
            </label>
            <label for="status">状态
                <input type="text" name="status"/>
            </label>
            <label for="nationality">民族
                <input type="text" name="nationality"/>
            </label>
            <label for="height">身高
                <input type="text" name="height"/>
            </label>
            <label for="weight">体重
                <input type="text" name="weight"/>
            </label>
            <label for="smoking">吸烟
                <input type="text" name="smoking"/>
            </label>
            <label for="drinking">饮酒
                <input type="text" name="drinking"/>
            </label>
            <label for="religion">宗教
                <input type="text" name="religion"/>
            </label>
            <label for="education">教育
                <input type="text" name="education"/>
            </label>
            <label for="offspring">娃
                <input type="text" name="offspring"/>
            </label>
            <label for="pet">宠物
                <input type="text" name="pet"/>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Modify
            </button>
        </form>
    </div>

@endsection

@section('scripts')
    @parent

@endsection
