<html>

<head>
    <title>《菜菜子的部落衝突》Clash of Clans - 查詢/搜尋/部落/部落排名/成員/比較 - COC</title>
    <meta name="description" content="部落衝突 Clash of Clans - COC - 部落/排名/成員歷史資料的搜尋比較, 同時也提供了官方最新的資訊.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $('#clans').DataTable({
                "order": [[ 0, "desc" ]],
                "pageLength": 50
            });
        });

        $(document).ready(function () {
            $('#members').DataTable({
                "order": [[ 5, "desc" ]],
                "pageLength": 50
            });
        });

        $(document).ready(function () {
            $('#member').DataTable({
                "order": [[ 0, "desc" ]],
                "pageLength": 50
            });
        });
    </script>
    <style type="text/css" class="init">
    </style>
    <script src="{{ url('/sorttable.js') }}"></script>
    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $('#clans').DataTable();
        });
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-365466-5']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>


</head>

<body>
<!--@include('clan.ad.ad1')-->
<div class="container">
    <nav class="navbar navbar-light bg-faded">
<!--        <a class="navbar-brand" href="{{url('/')}}">最新消息</a>-->
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}">最新消息</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/queryClans')}}">查詢部落</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/queryClanRankings')}}">查詢部落排名</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/queryMember')}}">查詢部落成員</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/faq')}}">常見問題</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/about')}}">關於我</a>
            </li>
        </ul>
    </nav>
    @yield('content')
    <hr>
    <br>
    <small class="form-text text-muted">
        本內容與Supercell沒有任何關聯，Supercell對此不提供任何保證、贊助或特別準許，也不對此承擔任何責任。更多信息，請參閱Supercell 玩家內容條款：www.supercell.com/fan-content-policy
    </small>
</div>
<!--@include('clan.ad.ad2')-->
<!--<script type="text/javascript" src="http://m.vpon.com/sdk/vpadn-sdk.js"> </script>-->
</body>
</html>