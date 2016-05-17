@extends('layouts.common')

@section('styles')
    @parent

@endsection

@section('content')

    <h2>我的资料</h2>

    <!-- Current Basics -->
    @if (count($basics) > 0)
        <div>
            <h4>基本信息</h4>
            @foreach ($basics as $basic)
                <span>性别: {{ $basic->gender }}</span>
                <span>城市: {{ $basic->city }}</span>
                <span>出生年: {{ $basic->birth_year }}</span>
            @endforeach
        </div>
    @endif

    <form id="basicInfo" action="/basic/update" method="POST">
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

    <!-- Current Details -->
    @if (count($details) > 0)
        <div>
            <h4>更多的信息</h4>
            @foreach ($details as $detail)
                <span>取向: {{ $detail->orientation }}</span>
                <span>状态: {{ $detail->status }}</span>
                <span>民族: {{ $detail->nationality }}</span>
                <span>身高: {{ $detail->height }}</span>
                <span>体重: {{ $detail->weight }}</span>
                <span>吸烟: {{ $detail->smoking }}</span>
                <span>饮酒: {{ $detail->drinking }}</span>
                <span>宗教: {{ $detail->religion }}</span>
                <span>教育: {{ $detail->education }}</span>
                <span>娃: {{ $detail->offspring }}</span>
                <span>宠物: {{ $detail->pet }}</span>
            @endforeach
        </div>
    @endif
    <h4>更多的信息</h4>
    <form id="detailInfo" action="/detail/update" method="POST">
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

    <!-- Current Looking For -->
    @if (count($targets) > 0)
        <div>
            <h4>希望对方</h4>
            @foreach ($targets as $target)
                <span>性别: {{ $target->target_gender }}</span>
                <span>最小年龄: {{ $target->ageMin }}</span>
                <span>最大年龄: {{ $target->ageMax }}</span>
                <span>一定要单身么？ {{ $target->isSingle }}</span>
                <span>一定要同城么？ {{ $target->isNearBy }}</span>
                <span>想要怎样的关系: {{ $target->relationship }}</span>
            @endforeach
        </div>
    @endif
    <h4>Looking For</h4>
    <form id="targetInfo" action="/target/update" method="POST">
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

    <!-- About -->
    @if (count($abouts) > 0)
        <div>
            <h4>关于我</h4>
            @foreach ($abouts as $about)
                <span>关于我: {{ $about->summary }}</span>
                <span>每天我都在干啥: {{ $about->routine }}</span>
                <span>我比较擅长: {{ $about->skills }}</span>
                <span>我最喜欢的书 电影 音乐 食物: {{ $about->favorite }}</span>
                <span>没有这几样我会抓狂: {{ $about->necessities }}</span>
                <span>我会想这些问题: {{ $about->concerns }}</span>
                <span>周五晚上我会做些啥: {{ $about->friday }}</span>
            @endforeach
        </div>
    @endif
    <h4>About Me</h4>
    <form id="aboutInfo" action="/about/update" method="POST">
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
    <!-- Refers -->
    @if (count($refers) > 0)
        <div>
            <h4>朋友们怎么说</h4>
            @foreach ($refers as $refer)
                <span>关于我: {{ $refer->why }}</span>
                <span>描述: {{ $refer->description }}</span>
                <span>你们的故事: {{ $refer->story }}</span>
            @endforeach
        </div>
    @endif
    <h4>朋友们怎么说</h4>
    <form id="refer" action="/refer/update" method="POST">
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

@endsection

@section('scripts')
    @parent

@endsection
