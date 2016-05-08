@extends('layouts.app')

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
        <label for="city">性别</label>
        <input type="text" name="city"/>
        <label for="birth_year">出生年</label>
        <input type="text" name="birth_year"/>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Modify
        </button>
    </form>
    <h4>更多的信息</h4>
    <form id="detailInfo" action="/detail/update" method="POST">
        <label for="orientation">取向
            <input type="text" name="gender"/>
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
        <label for="body_type">体型
            <input type="text" name="body_type"/>
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
    <h4>Looking For</h4>
    <form id="targetInfo" action="/target/update" method="POST">
        <label for="gender">目标群体
            <input type="text" name="gender"/>
        </label>
        <label for="status">状态
            <input type="text" name="status"/>
        </label>
        <label for="ageMin">最小年龄
            <input type="text" name="ageMin"/>
        </label>
        <label for="ageMax">最大年龄
            <input type="text" name="ageMax"/>
        </label>
        <label for="location">位置
            <input type="text" name="location"/>
        </label>
        <label for="relationship">预期关系
            <input type="text" name="location"/>
        </label>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Modify
        </button>
    </form>
    <h4>About Me</h4>
    <form id="aboutInfo" action="/about/update" method="POST">
        <label for="gender">关于我
            <input type="text" name="gender"/>
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
        <label for="depend">没有这几样我会抓狂
            <input type="text" name="depend"/>
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
