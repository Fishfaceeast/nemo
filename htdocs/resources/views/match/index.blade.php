@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/match/index.css">

@endsection

@section('content')
    <div class="main-container clearfix">
        <section class="base-search">
            <div>
                <strong>
                    <i class="pop-switch">
                        搜一下：男，
                    </i>
                    <span class="arrow-box pop-over">
                        <h4>性别</h4>
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
                </strong>
                <strong>年龄25-35，</strong>
                <strong>对女性感兴趣，</strong>
                <strong>坐标上海。</strong>
            </div>
        </section>
        <section class="advanced-search">

        </section>
    </div>
@endsection

@section('scripts')
    @parent

    <script src="/d/match/index.js"></script>

@endsection
