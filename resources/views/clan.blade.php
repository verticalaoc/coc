<html>

<head>
    <title>部落衝突 Clash of Clans 台灣部落/部落排名/成員/查詢/搜尋</title>
    <meta name="description" content="提供查詢 Clash of Clans 的網頁查詢, 包含查詢部落, 查詢部落排名 和 查詢部落成員資料. 同時在首頁也提供了官方最新的資訊.">
    <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $('#clans').DataTable();
        });

        $(document).ready(function () {
            $('#members').DataTable();
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
<div class="container">
    <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand" href="{{url('/')}}">部落衝突 Clash of Clans</a>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/queryClans')}}">查詢部落</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/queryClanRankings')}}">查詢部落排名</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/about')}}">關於</a>
            </li>
        </ul>
    </nav>
    @yield('content')
</div>


</body>
</html>