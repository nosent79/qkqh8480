<ul class="nav navbar-nav">
    <li @if(isSelectedMenu("task/index", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('task.index') }}">홈</a></li>
    <li @if(isSelectedMenu("task/register", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('task.register') }}">태스크 등록</a></li>
    <li @if(isSelectedMenu("task/statistics", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('task.statistics') }}">통계</a></li>
    <li @if(isSelectedMenu("task/deleted_list", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('task.deleted_list') }}">삭제 리스트</a></li>
    <li @if(isSelectedMenu("memo/register", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('memo.register') }}">메모 등록</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    @if (app('session')->has('user_id'))
        <li @if(isSelectedMenu("member/change_password", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('member.change_password') }}">비밀번호 변경</a></li>
        <li @if(isSelectedMenu("member/modify_info", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('member.modify_info') }}">회원정보 변경</a></li>
        <li @if(isSelectedMenu("auth/logout", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('auth.logout') }}">로그아웃</a></li>
    @else
        <li @if(isSelectedMenu("auth/login", app('url')->current())) {{ "class=active" }} @endif><a href="{{ route('auth.login') }}">로그인</a></li>
    @endif
</ul>