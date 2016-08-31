<tr>
    <td>{{$clan->created_at}}</td>
    <!--    <td><img src="{{$clan->badgeUrlsSmall}}"></td>-->
    <!--    <td>{{$clan->locationName}}</td>-->
    <!--    <td><a href="{{action('ClanController@clan',[urlencode($clan->tag)])}}">{{$clan->name}}</a></td>-->
    <!--    <td>{{$clan->tag}}</td>-->
    <!--    <td>{{$clan->type}}</td>-->
    <!--    <td>{{$clan->clanLevel}}</td>-->
    <td>{{$clan->clanPoints}}</td>
    <!--    <td>{{$clan->requiredTrophies}}</td>-->
    <!--    <td>{{$clan->warFrequency}}</td>-->
    <td>{{$clan->warWinStreak}}</td>
    <td>{{$clan->warWins}}</td>
    <!--        <td>{{$clan->isWarLogPublic}}</td>-->
    <td><a href="{{action('ClanController@members',[urlencode($clan->id)])}}">{{$clan->members}}</a></td>
    <td>{{$clan->donations}}</td>
<!--    <td>{{$clan->description}}</td>-->
</tr>