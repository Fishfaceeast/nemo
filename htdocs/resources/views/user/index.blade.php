@extends('layouts.common')

@section('styles')
    @parent
    <link rel="stylesheet" href="/d/profile/index.css">

@endsection

@section('content')

    <div class="main-container user-main-container clearfix">
        <!-- Content here -->

        <!-- Current Basics -->
        <div class="info-wrapper basic-info-wrapper clearfix">
            <img class="avatar" src="/img/avatar.png"/>
            <div class="basic-info">
                <h5>
                    {{ $userName }}
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
                            </h5>
                            <p>{{ $item['value'] or '——' }}</p>
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
                            </h5>
                            <p>{{ $item['value'] or '——' }}</p>
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
    </div>

@endsection

@section('scripts')
    @parent

@endsection
