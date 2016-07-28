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
                <h5>希望对方</h5>
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
        <ul class="nav nav-tabs nav-tabs-profile" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#refer" role="tab">朋友说</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#about" role="tab">关于我</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Refers -->
            @if (count($refers) > 0)
                <div class="tab-pane active info-wrapper refer-info-wrapper" id="refer" role="tabpanel">
                    @foreach ($refers as $item)
                        <div class="refer-info">
                            <h5>
                                {{ $item['cname'] }}:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $item['value'] or '——' }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="{{ $item['name'] }}" rows="3"></textarea>
                                <button type="button" class="btn btn-primary btn-sm refer-modify" name="refer">保存设置</button>
                                <button type="button" class="btn btn-secondary btn-sm refer-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- About -->
            <div class="tab-pane info-wrapper about-info-wrapper" id="about" role="tabpanel">
                @if (count($about) > 0)
                    @foreach ($about as $item)
                        <div class="about-info">
                            <h5>
                                {{ $item['cname'] }}:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $item['value'] or '——' }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="{{ $item['name'] }}" rows="3"></textarea>
                                <button type="button" class="btn btn-primary btn-sm about-modify" name="about">保存设置</button>
                                <button type="button" class="btn btn-secondary btn-sm about-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
                    @endforeach
                @endif
            </div>
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
                        <form id="basicForm">
                            <div class="form-group">
                                <label for="gender">我是</label>
                                <select class="c-select" name="gender">
                                    <option value="男" selected>男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">城市</label>
                                <input type="text" name="city" data-required="1" data-must="1"/>
                                <span class="empty-alert">城市不能为空</span>
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
                        <form id="targetForm">
                            <div class="form-group">
                                这些关键词决定了我们为您展示的人
                            </div>
                            <div class="form-group">
                                <label for="target_gender">性别</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="男" data-select="0">男</span>
                                    <span class="pseudo-radio" data-value="女" data-select="0">女</span>
                                    <input type="hidden" name="target_gender" value="男"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ageMin">最小年龄</label>
                                <div class="range">
                                    <input type="text" name="ageMin" data-required="1" data-pattern="range" data-role="min"/>
                                    <span class="error-alert">请输入数字</span>
                                    <span class="range-alert">最小值无效</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ageMin">最大年龄</label>
                                <div class="range">
                                    <input type="text" name="ageMax" data-required="1" data-pattern="range" data-role="max"/>
                                    <span class="error-alert">请输入数字</span>
                                    <span class="range-alert">最大值无效</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="isSingle">必须单身</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="是" data-select="0">是</span>
                                    <span class="pseudo-radio" data-value="否" data-select="0">否</span>
                                    <input type="hidden" name="isSingle" value="是"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="isNearBy">必须同城</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="是" data-select="0">是</span>
                                    <span class="pseudo-radio" data-value="否" data-select="0">否</span>
                                    <input type="hidden" name="isNearBy" value="是"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>想建立</label>
                                <div class="pseudo-radio-container">
                                    <span class="pseudo-radio active" data-value="新朋友" data-select="0">新朋友</span>
                                    <span class="pseudo-radio" data-value="长期约会" data-select="0">长期约会</span>
                                    <span class="pseudo-radio" data-value="短期约会" data-select="0">短期约会</span>
                                    <span class="pseudo-radio" data-value="待定" data-select="0">待定</span>
                                    <input type="hidden" name="relationship" value="新朋友"/>
                                </div>
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
                        <form id="detailForm">
                            <div class="form-group">
                                <label for="orientation">取向</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="直" data-select="0">直</span>
                                    <span class="pseudo-radio" data-value="弯" data-select="0">弯</span>
                                    <span class="pseudo-radio" data-value="双" data-select="0">双</span>
                                    <input type="hidden" name="orientation" value="直"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">情感状态</label>
                                <select name="status">
                                    <option value="单身">单身</option>
                                    <option value="和别人交往">在和别人交往</option>
                                    <option value="已婚">已婚</option>
                                    <option value="在开放式关系中">在开放式关系中</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="height">身高</label>
                                <div>
                                    <input class="height-v" type="text" name="height" data-required="1" data-must="" data-pattern="number"/>
                                    <span class="error-alert">请输入数字</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weight">体重</label>
                                <select class="select-weight" name="weight">
                                    <option value="暂时不想说">暂时不想说</option>
                                    <option value="瘦">瘦</option>
                                    <option value="瘦高">瘦高</option>
                                    <option value="匀称">匀称</option>
                                    <option value="微胖">微胖</option>
                                    <option value="胖">胖</option>
                                    <option value="胖又圆">胖又圆</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="smoking">吸烟</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="否" data-select="0">否</span>
                                    <span class="pseudo-radio" data-value="有时" data-select="0">有时</span>
                                    <span class="pseudo-radio" data-value="是" data-select="0">是</span>
                                    <input type="hidden" name="smoking" value="否"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drinking">饮酒</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="否" data-select="0">否</span>
                                    <span class="pseudo-radio" data-value="社交场合" data-select="0">社交场合</span>
                                    <span class="pseudo-radio" data-value="是" data-select="0">是</span>
                                    <input type="hidden" name="drinking" value="否"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="religion">宗教信仰</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="否" data-select="0">有</span>
                                    <span class="pseudo-radio" data-value="无" data-select="0">无</span>
                                    <input type="hidden" name="religion" value="否"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="education">教育</label>
                                <div>
                                    <span class="pseudo-radio active" data-value="本科" data-select="0">本科</span>
                                    <span class="pseudo-radio" data-value="研究生" data-select="0">研究生</span>
                                    <span class="pseudo-radio" data-value="高中" data-select="0">高中</span>
                                    <input type="hidden" name="education" value="本科"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="offspring">娃</label>
                                <div>
                                    <span class="pseudo-radio" data-value="有" data-select="0">有</span>
                                    <span class="pseudo-radio" data-value="无" data-select="0">无</span>
                                    <input type="hidden" name="offspring" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pet">宠物</label>
                                <div>
                                    <span class="pseudo-radio" data-value="有" data-select="0">有</span>
                                    <span class="pseudo-radio" data-value="无" data-select="0">无</span>
                                    <input type="hidden" name="pet" value=""/>
                                </div>
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
