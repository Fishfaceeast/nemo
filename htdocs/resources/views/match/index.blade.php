@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/match/index.css">

@endsection

@section('content')
    <div class="main-container clearfix">
        <section class="base-search">
            <div>
                搜一下：男，
                <span class="pop-form">
                    <label>
                        <input type="checkbox" val="男"/> 男
                    </label>
                    <label>
                        <input type="checkbox" val="女"/> 女
                    </label>
                    <label>
                        <input type="checkbox" val="所有人"/> 所有人
                    </label>
                </span>
            </div>
            <div>年龄25-35，</div>
            <div>对女性感兴趣，</div>
            <div>坐标上海。</div>
        </section>
        <section class="advanced-search">

        </section>
    </div>
@endsection

@section('scripts')
    @parent

@endsection
