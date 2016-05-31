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
                                <label for="gender">我是</label>
                                <select class="c-select" name="gender">
                                    <option value="男" selected>男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">城市</label>
                                <input type="text" name="city"/>
                            </div>
                            <div class="form-group">
                                <?php $minY = intval(date('Y', time() - 86400*365*88));?>
                                <?php $y = intval(date('Y', time() - 86400*365*18));?>
                                <label for="birth_year">出生年</label>
                                <select class="c-select" name="birth_year">
                                @for ($y; $y > $minY; $y--)
                                    <option value={{ $y }}>{{ $y }}</option>
                                @endfor
                                </select>
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
                        <h4 class="modal-title">寻找：</h4>
                    </div>
                    <div class="modal-body">
                        <form id="targetForm" action="/target/update" method="POST">
                            <div class="form-group">
                                这些关键词决定了我们为您展示的人
                            </div>
                            <div class="form-group">
                                <label for="target_gender">想找</label>
                                <label for="ageMin">年龄</label>
                                <br/>
                                <select class="c-select" name="target_gender">
                                    <option value="不限">不限</option>
                                    <option value="直">直</option>
                                    <option value="弯">弯</option>
                                    <option value="双">双</option>
                                </select>
                                <input type="text" name="ageMin"/>
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
                                <label for="relationship">想建立</label>
                                <label>
                                    <input type="checkbox" name="relationship[]" value="新朋友"/>
                                    新朋友
                                </label>
                                <label>
                                    <input type="checkbox" name="relationship[]" value="长期约会"/>
                                    长期约会
                                </label>
                                <label>
                                    <input type="checkbox" name="relationship[]" value="短期约会"/>
                                    短期约会
                                </label>
                                <label>
                                    <input type="checkbox" name="relationship[]" value="待定"/>
                                    待定
                                </label>
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

        <div id="detail-info-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">我的更多细节</h4>
                    </div>
                    <div class="modal-body">
                        <form id="detailForm" method="POST">
                            <div class="form-group">
                                <label for="orientation">取向</label>
                                <input type="text" name="orientation"/>
                            </div>
                            <div class="form-group">
                                <label for="nationality">状态</label>
                                <input type="text" name="nationality"/>
                            </div>
                            <div class="form-group">
                                <label for="height">身高</label>
                                <input type="text" name="height"/>
                            </div>
                            <div class="form-group">
                                <label for="weight">体重</label>
                                <input type="text" name="weight"/>
                            </div>
                            <div class="form-group">
                                <label for="smoking">吸烟</label>
                                <input type="text" name="smoking"/>
                            </div>
                            <div class="form-group">
                                <label for="drinking">饮酒</label>
                                <input type="text" name="drinking"/>
                            </div>
                            <div class="form-group">
                                <label for="religion">宗教</label>
                                <input type="text" name="religion"/>
                            </div>
                            <div class="form-group">
                                <label for="education">教育</label>
                                <input type="text" name="education"/>
                            </div>
                            <div class="form-group">
                                <label for="offspring">娃</label>
                                <input type="text" name="offspring"/>
                            </div>
                            <div class="form-group">
                                <label for="pet">宠物</label>
                                <input type="text" name="pet"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary detail-modify">保存设置</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        window.__data = {
            basic: {!! json_encode($basic) !!},
            target: {!! json_encode($target) !!},
            detail: {!! json_encode($detail) !!}
        }
    </script>
    <script src="/d/profile/index.js"></script>

@endsection
