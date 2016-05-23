@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/profile/index.css">

@endsection

@section('content')

    <div class="main-container clearfix">
        <!-- Content here -->

        <!-- Current Basics -->
        @if (count($basics) > 0)
            <div class="info-wrapper basic-info-wrapper clearfix">
                <img class="avatar" src="/img/avatar.png"/>
                <div class="basic-info">
                    <h5>
                        {{ Auth::user()->name }}
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </h5>
                    @foreach ($basics as $basic)
                        <p>{{ $basic->gender }} • {{ $basic->city }} • {{ $basic->birth_year }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Current Looking For -->
        @if (count($targets) > 0)
            <div class="info-wrapper target-info-wrapper">
                <h4>希望对方</h4>
                @foreach ($targets as $target)
                    <p>性别: {{ $target->target_gender }}</p>
                    <p>最小年龄: {{ $target->ageMin }}</p>
                    <p>最大年龄: {{ $target->ageMax }}</p>
                    <p>一定要单身么？ {{ $target->isSingle }}</p>
                    <p>一定要同城么？ {{ $target->isNearBy }}</p>
                    <p>想要怎样的关系: {{ $target->relationship }}</p>
                @endforeach
            </div>
        @endif
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
            @if (count($abouts) > 0)
                <div class="tab-pane active info-wrapper about-info-wrapper" id="about" role="tabpanel">
                    @foreach ($abouts as $about)
                        <p>关于我: {{ $about->summary }}</p>
                        <p>每天我都在干啥: {{ $about->routine }}</p>
                        <p>我比较擅长: {{ $about->skills }}</p>
                        <p>我最喜欢的书 电影 音乐 食物: {{ $about->favorite }}</p>
                        <p>没有这几样我会抓狂: {{ $about->necessities }}</p>
                        <p>我会想这些问题: {{ $about->concerns }}</p>
                        <p>周五晚上我会做些啥: {{ $about->friday }}</p>
                    @endforeach
                </div>
            @endif
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
        @if (count($details) > 0)
            <div class="info-wrapper detail-info-wrapper">
                <h5>我的更多细节</h5>
                @foreach ($details as $detail)
                    <p>取向: {{ $detail->orientation }}</p>
                    <p>状态: {{ $detail->status }}</p>
                    <p>民族: {{ $detail->nationality }}</p>
                    <p>身高: {{ $detail->height }}</p>
                    <p>体重: {{ $detail->weight }}</p>
                    <p>吸烟: {{ $detail->smoking }}</p>
                    <p>饮酒: {{ $detail->drinking }}</p>
                    <p>宗教: {{ $detail->religion }}</p>
                    <p>教育: {{ $detail->education }}</p>
                    <p>娃: {{ $detail->offspring }}</p>
                    <p>宠物: {{ $detail->pet }}</p>
                @endforeach
            </div>
        @endif
        <form id="basicInfo" class="hidden" action="/basic/update" method="POST">
            <label for="gender">性别</label>
            <input type="text" name="gender"/>
            <label for="city">城市</label>
            <input type="text" name="city"/>
            <label for="birth_year">出生年</label>
            <input type="text" name="birth_year"/>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Modify
            </button>
        </form>
        <form id="targetInfo" class="hidden" action="/target/update" method="POST">
            <label for="target_gender">目标群体
                <input type="text" name="target_gender"/>
            </label>
            <label for="ageMin">最小年龄
                <input type="text" name="ageMin"/>
            </label>
            <label for="ageMax">最大年龄
                <input type="text" name="ageMax"/>
            </label>
            <label for="isSingle">一定要单身么
                <input type="text" name="isSingle"/>
            </label>
            <label for="isNearBy">一定要同城么
                <input type="text" name="isNearBy"/>
            </label>
            <label for="relationship">预期关系
                <input type="text" name="relationship"/>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Modify
            </button>
        </form>

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
