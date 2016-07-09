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
                        <div class="about-info">
                            <h5>
                                {{ $item['cname'] }}:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $item['value'] or '——' }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="{{ $item['name'] }}" rows="3"></textarea>
                                <button type="button" class="btn btn-primary about-modify" name="about">保存设置</button>
                                <button type="button" class="btn btn-secondary about-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Refers -->
            @if (count($refers) > 0)
                <div class="tab-pane info-wrapper refer-info-wrapper" id="refer" role="tabpanel">
                    @foreach ($refers as $refer)
                        <div class="refer-info">
                            <h5>推荐原因:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $refer->why }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="why" rows="3"></textarea>
                                <button type="button" class="btn btn-primary refer-modify" name="refer">保存设置</button>
                                <button type="button" class="btn btn-secondary refer-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
                        <div class="refer-info">
                            <h5>描述:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $refer->description }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="description" rows="3"></textarea>
                                <button type="button" class="btn btn-primary refer-modify" name="refer">保存设置</button>
                                <button type="button" class="btn btn-secondary refer-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
                        <div class="refer-info">
                            <h5>你们的故事:
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </h5>
                            <p>{{ $refer->story }}</p>
                            <fieldset class="form-group">
                                <textarea class="form-control" id="story" rows="3"></textarea>
                                <button type="button" class="btn btn-primary refer-modify" name="refer">保存设置</button>
                                <button type="button" class="btn btn-secondary refer-cancel" data-dismiss="modal">关闭</button>
                            </fieldset>
                        </div>
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
                                <input type="text" name="city" data-required="1" />
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
                                <label for="target_gender">想找</label>
                                <label for="ageMin">年龄</label>
                                <br/>
                                <select class="c-select" name="target_gender">
                                    <option value="不限">不限</option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                                <input type="text" name="ageMin" data-required="1" data-pattern="number"/>
                                <span class="empty-alert">最小年龄不能为空</span>
                                <span class="error-alert">请输入数字</span>
                                <input type="text" name="ageMax" data-required="1" data-pattern="number"/>
                                <span class="empty-alert">最大年龄不能为空</span>
                                <span class="error-alert">请输入数字</span>
                            </div>
                            <div class="form-group">
                                <label for="isSingle">一定要单身么</label>
                                <span class="pseudo-radio" data-value="是" data-select="0">是</span>
                                <span class="pseudo-radio" data-value="否" data-select="0">否</span>
                                <input type="hidden" name="isSingle" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="isNearBy">一定要同城么</label>
                                <span class="pseudo-radio" data-value="是" data-select="0">是</span>
                                <span class="pseudo-radio" data-value="否" data-select="0">否</span>
                                <input type="hidden" name="isNearBy" value=""/>
                            </div>
                            <div class="form-group">
                                <label>想建立</label>
                                <div class="pseudo-radio-container">
                                    <span class="pseudo-radio" data-value="新朋友" data-select="0">新朋友</span>
                                    <span class="pseudo-radio" data-value="长期约会" data-select="0">长期约会</span>
                                    <span class="pseudo-radio" data-value="短期约会" data-select="0">短期约会</span>
                                    <span class="pseudo-radio" data-value="待定" data-select="0">待定</span>
                                    <input type="hidden" name="relationship" value=""/>
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
                                <select name="orientation">
                                    <option value="直">直</option>
                                    <option value="弯">弯</option>
                                    <option value="双">双</option>
                                    <option value="不分">不分</option>
                                </select>
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
                                <input type="text" name="height" data-required="1" data-must="" data-pattern="number"/>
                                <span class="error-alert">请输入数字</span>
                            </div>
                            <div class="form-group">
                                <label for="weight">体重</label>
                                <select name="weight">
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
                                <select name="smoking">
                                    <option value="是">是</option>
                                    <option value="否">否</option>
                                    <option value="有时">有时</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="drinking">饮酒</label>
                                <select name="drinking">
                                    <option value="是">是</option>
                                    <option value="否">否</option>
                                    <option value="社交场合">社交场合</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="religion">宗教</label>
                                <input type="text" name="religion" data-required="1" data-must="1"/>
                                <span class="empty-alert">不能为空</span>
                            </div>
                            <div class="form-group">
                                <label for="education">教育</label>
                                <select name="education">
                                    <option value="高中">高中</option>
                                    <option value="本科">本科</option>
                                    <option value="硕士">硕士</option>
                                    <option value="博士">博士</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="offspring">娃</label>
                                <select name="offspring">
                                    <option value="暂时不想说">暂时不想说</option>
                                    <option value="有">有</option>
                                    <option value="无">无</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pet">宠物</label>
                                <input type="text" name="pet" data-required="1" data-must="1" data-pattern="number"/>
                                <span class="empty-alert">不能为空</span>
                                <span class="error-alert">请输入数字</span>
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
