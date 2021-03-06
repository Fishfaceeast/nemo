@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/match/index.css">

@endsection

@section('content')
    <section class="base-search clearfix">
        <div id="cover" class="hidden clearfix">
            <div class="main-container">
                <span class="close-cover"> &times;</span>
            </div>
        </div>
        <div class="main-container">
            <div class="clearfix">
                <form id="base-form"></form>
                <i class="fa fa-sliders" aria-hidden="true"></i>
            </div>
            <div class="adv-feature"></div>
        </div>
    </section>
    <section class="advanced-search hidden clearfix">
        <div class="main-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs advanced-pannel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#status" role="tab">状态</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#look" role="tab">外表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#background" role="tab">背景</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#vice" role="tab">嗜好</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active clearfix" id="status" role="tabpanel">
                    <div data-key="status" data-type="radio">
                        <p class="feature-title">情感状态</p>
                        <span class="choice-block adv-choice" data-value="单身">单身</span>
                    </div>
                    <div data-key="relationship" data-type="radio">
                        <p class="feature-title">他寻找怎样的关系</p>
                        <span class="choice-block adv-choice" data-value="新朋友">新朋友</span>
                        <span class="choice-block adv-choice" data-value="长期约会">长期约会</span>
                        <span class="choice-block adv-choice" data-value="短期约会">短期约会</span>
                        <span class="choice-block adv-choice" data-value="待定">待定</span>
                    </div>
                    <div data-key="offspring" data-type="radio">
                        <p class="feature-title">娃</p>
                        <span class="choice-block adv-choice" data-value="有">有</span>
                        <span class="choice-block adv-choice" data-value="无">没有</span>
                    </div>
                    <div data-key="pet" data-type="radio">
                        <p class="feature-title">宠物</p>
                        <span class="choice-block adv-choice" data-value="有">有</span>
                        <span class="choice-block adv-choice" data-value="无">没有</span>
                    </div>
                    <div class="btn-wrapper">
                        <button type="button" class="btn btn-primary btn-search">搜索</button>
                        <button type="button" class="btn btn-secondary btn-cancel">取消</button>
                    </div>
                </div>
                <div class="tab-pane clearfix" id="look" role="tabpanel">
                    <div class="heightMin-container" data-key="heightMin" data-type="select">
                        <p class="feature-title">身高</p>
                        <select name="heightMin">
                            <option value="150">150</option>
                            <option value="155">155</option>
                            <option value="160">160</option>
                            <option value="165">165</option>
                            <option value="170">170</option>
                            <option value="175">175</option>
                            <option value="180">180</option>
                        </select>
                    </div>
                    <div class="heightMax-container" data-key="heightMax" data-type="select">
                        <p class="feature-title">身高</p>
                        <select name="heightMax">
                            <option value="150">150</option>
                            <option value="155">155</option>
                            <option value="160">160</option>
                            <option value="165">165</option>
                            <option value="170">170</option>
                            <option value="175">175</option>
                            <option value="180">180</option>
                            <option value="180">185</option>
                        </select>
                    </div>
                    <div data-key="weight" data-type="select">
                        <p class="feature-title">体重</p>
                        <select name="weight">
                            <option value="瘦">瘦</option>
                            <option value="瘦高">瘦高</option>
                            <option value="匀称">匀称</option>
                            <option value="微胖">微胖</option>
                            <option value="胖">胖</option>
                            <option value="胖又圆">胖又圆</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-search">搜索</button>
                    <button type="button" class="btn btn-secondary btn-cancel">取消</button>
                </div>
                <div class="tab-pane clearfix" id="background" role="tabpanel">
                    <div data-key="education" data-type="radio">
                        <p class="feature-title">教育</p>
                        <span class="choice-block adv-choice" data-value="本科">本科</span>
                        <span class="choice-block adv-choice" data-value="研究生">研究生</span>
                    </div>
                    <div data-key="religion" data-type="radio">
                        <p class="feature-title">宗教信仰</p>
                        <span class="choice-block adv-choice" data-value="有">有</span>
                        <span class="choice-block adv-choice" data-value="无">没有</span>
                    </div>
                    <button type="button" class="btn btn-primary btn-search">搜索</button>
                    <button type="button" class="btn btn-secondary btn-cancel">取消</button>
                </div>
                <div class="tab-pane clearfix" id="vice" role="tabpanel">
                    <div data-key="smoking" data-type="smokingSlider">
                        <p class="feature-title">吸烟</p>
                        <div class="smoke-slider"></div>
                    </div>
                    <div data-key="drinking" data-type="drikingSlider">
                        <p class="feature-title">饮酒</p>
                        <div class="drink-slider"></div>
                    </div>
                    <button type="button" class="btn btn-primary btn-search">搜索</button>
                    <button type="button" class="btn btn-secondary btn-cancel">取消</button>
                </div>
            </div>
        </div>
    </section>
    <section class="board clearfix">

    </section>
@endsection

@section('scripts')
    @parent
    <script>
        window.__data = {
            defaultBase: {!! json_encode($defaultBase) !!}
        }
    </script>

    <script src="/d/match/index.js"></script>

@endsection
