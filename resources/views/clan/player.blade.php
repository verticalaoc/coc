@extends('clan')

@section('content')

<div>
    <h3>
        成員資訊 - {{$player->name}} ({{$player->tag}})
    </h3>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">主堡等級</div>
    <div class="col-xs-3 col-md-2">{{$player->townHallLevel}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">經驗等級</div>
    <div class="col-xs-3 col-md-2">{{$player->expLevel}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">獎杯數</div>
    <div class="col-xs-3 col-md-2">{{$player->trophies}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">歷來最佳成績</div>
    <div class="col-xs-3 col-md-2">{{$player->bestTrophies}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">贏得的戰爭星星</div>
    <div class="col-xs-3 col-md-2">{{$player->warStars}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">部落名稱</div>
    <div class="col-xs-3 col-md-2"><a href="{{url('/clans/' . $encodedClanTag)}}">{{$player->clanName}}</a> (等級: {{$player->clanClanLevel}})</div>
</div>
<hr>
<div>
    <h4>
        本季表現
    </h4>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">攻擊成功次數</div>
    <div class="col-xs-3 col-md-2">{{$player->attackWins}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">防禦成功次數</div>
    <div class="col-xs-3 col-md-2">{{$player->defenseWins}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">近期捐兵</div>
    <div class="col-xs-3 col-md-2">{{$player->donations}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">近期收到的部隊數量</div>
    <div class="col-xs-3 col-md-2">{{$player->donationsReceived}}</div>
</div>

<!--"achievementsBiggercoffersName" => "Bigger Coffers"-->
<!--"achievementsBiggercoffersStars" => 3-->
<!--"achievementsBiggercoffersValue" => 12-->
<!--"achievementsBiggercoffersTarget" => 10-->
<!--"achievementsBiggercoffersInfo" => "Upgrade a Gold Storage to level 10"-->
<!--"achievementsBiggercoffersCompletionInfo" => "Highest Gold Storage level: 12"-->
<!--"achievementsGetthosegoblins!Name" => "Get those Goblins!"-->
<!--"achievementsGetthosegoblins!Stars" => 3-->
<!--"achievementsGetthosegoblins!Value" => 150-->
<!--"achievementsGetthosegoblins!Target" => 150-->
<!--"achievementsGetthosegoblins!Info" => "Win 150 stars on the Campaign Map"-->
<!--"achievementsGetthosegoblins!CompletionInfo" => "Stars in Campaign Map: 150"-->
<!--"achievementsBigger&betterName" => "Bigger & Better"-->
<!--"achievementsBigger&betterStars" => 3-->
<!--"achievementsBigger&betterValue" => 11-->
<!--"achievementsBigger&betterTarget" => 8-->
<!--"achievementsBigger&betterInfo" => "Upgrade Town Hall to level 8"-->
<!--"achievementsBigger&betterCompletionInfo" => "Current Town Hall level: 11"-->
<!--"achievementsNiceandtidyName" => "Nice and Tidy"-->
<!--"achievementsNiceandtidyStars" => 3-->
<!--"achievementsNiceandtidyValue" => 2762-->
<!--"achievementsNiceandtidyTarget" => 500-->
<!--"achievementsNiceandtidyInfo" => "Remove 500 obstacles (trees, rocks, bushes)"-->
<!--"achievementsNiceandtidyCompletionInfo" => "Total obstacles removed: 2762"-->
<!--"achievementsReleasethebeastsName" => "Release the Beasts"-->
<!--"achievementsReleasethebeastsStars" => 3-->
<!--"achievementsReleasethebeastsValue" => 1-->
<!--"achievementsReleasethebeastsTarget" => 1-->
<!--"achievementsReleasethebeastsInfo" => "Unlock Dragon in the Barracks"-->
<!--"achievementsGoldgrabName" => "Gold Grab"-->
<!--"achievementsGoldgrabStars" => 3-->
<!--"achievementsGoldgrabValue" => 832114919-->
<!--"achievementsGoldgrabTarget" => 100000000-->
<!--"achievementsGoldgrabInfo" => "Steal 100000000 gold"-->
<!--"achievementsGoldgrabCompletionInfo" => "Total Gold looted: 832114919"-->
<!--"achievementsElixirescapadeName" => "Elixir Escapade"-->
<!--"achievementsElixirescapadeStars" => 3-->
<!--"achievementsElixirescapadeValue" => 805882047-->
<!--"achievementsElixirescapadeTarget" => 100000000-->
<!--"achievementsElixirescapadeInfo" => "Steal 100000000 elixir"-->
<!--"achievementsElixirescapadeCompletionInfo" => "Total Elixir looted: 805882047"-->
<!--"achievementsSweetvictory!Name" => "Sweet Victory!"-->
<!--"achievementsSweetvictory!Stars" => 3-->
<!--"achievementsSweetvictory!Value" => 5437-->
<!--"achievementsSweetvictory!Target" => 1250-->
<!--"achievementsSweetvictory!Info" => "Achieve a total of 1250 trophies in Multiplayer battles"-->
<!--"achievementsSweetvictory!CompletionInfo" => "Trophy record: 5437"-->
<!--"achievementsEmpirebuilderName" => "Empire Builder"-->
<!--"achievementsEmpirebuilderStars" => 3-->
<!--"achievementsEmpirebuilderValue" => 7-->
<!--"achievementsEmpirebuilderTarget" => 4-->
<!--"achievementsEmpirebuilderInfo" => "Upgrade Clan Castle to level 4"-->
<!--"achievementsEmpirebuilderCompletionInfo" => "Current Clan Castle level: 7"-->
<!--"achievementsWallbusterName" => "Wall Buster"-->
<!--"achievementsWallbusterStars" => 3-->
<!--"achievementsWallbusterValue" => 36253-->
<!--"achievementsWallbusterTarget" => 2000-->
<!--"achievementsWallbusterInfo" => "Destroy 2000 Walls in Multiplayer battles"-->
<!--"achievementsWallbusterCompletionInfo" => "Total walls destroyed: 36253"-->
<!--"achievementsHumiliatorName" => "Humiliator"-->
<!--"achievementsHumiliatorStars" => 3-->
<!--"achievementsHumiliatorValue" => 2919-->
<!--"achievementsHumiliatorTarget" => 2000-->
<!--"achievementsHumiliatorInfo" => "Destroy 2000 Town Halls in Multiplayer battles"-->
<!--"achievementsHumiliatorCompletionInfo" => "Total Town Halls destroyed: 2919"-->
<!--"achievementsUnionbusterName" => "Union Buster"-->
<!--"achievementsUnionbusterStars" => 3-->
<!--"achievementsUnionbusterValue" => 12518-->
<!--"achievementsUnionbusterTarget" => 2500-->
<!--"achievementsUnionbusterInfo" => "Destroy 2500 Builder's Huts in Multiplayer battles"-->
<!--"achievementsUnionbusterCompletionInfo" => "Total Builder's Huts destroyed: 12518"-->
<!--"achievementsConquerorName" => "Conqueror"-->
<!--"achievementsConquerorStars" => 2-->
<!--"achievementsConquerorValue" => 3908-->
<!--"achievementsConquerorTarget" => 5000-->
<!--"achievementsConquerorInfo" => "Win 5000 Multiplayer battles"-->
<!--"achievementsConquerorCompletionInfo" => "Total multiplayer battles won: 3908"-->
<!--"achievementsUnbreakableName" => "Unbreakable"-->
<!--"achievementsUnbreakableStars" => 2-->
<!--"achievementsUnbreakableValue" => 455-->
<!--"achievementsUnbreakableTarget" => 5000-->
<!--"achievementsUnbreakableInfo" => "Successfully defend against 5000 attacks"-->
<!--"achievementsUnbreakableCompletionInfo" => "Total defenses won: 455"-->
<!--"achievementsFriendinneedName" => "Friend in Need"-->
<!--"achievementsFriendinneedStars" => 3-->
<!--"achievementsFriendinneedValue" => 117640-->
<!--"achievementsFriendinneedTarget" => 25000-->
<!--"achievementsFriendinneedInfo" => "Donate 25000 Clan Castle capacity worth of reinforcements"-->
<!--"achievementsFriendinneedCompletionInfo" => "Total capacity donated: 117640"-->
<!--"achievementsMortarmaulerName" => "Mortar Mauler"-->
<!--"achievementsMortarmaulerStars" => 3-->
<!--"achievementsMortarmaulerValue" => 8785-->
<!--"achievementsMortarmaulerTarget" => 5000-->
<!--"achievementsMortarmaulerInfo" => "Destroy 5000 Mortars in Multiplayer battles"-->
<!--"achievementsMortarmaulerCompletionInfo" => "Total Mortars destroyed: 8785"-->
<!--"achievementsHeroicheistName" => "Heroic Heist"-->
<!--"achievementsHeroicheistStars" => 3-->
<!--"achievementsHeroicheistValue" => 5010109-->
<!--"achievementsHeroicheistTarget" => 1000000-->
<!--"achievementsHeroicheistInfo" => "Steal 1000000 Dark Elixir"-->
<!--"achievementsHeroicheistCompletionInfo" => "Total Dark Elixir looted: 5010109"-->
<!--"achievementsLeagueall-starName" => "League All-Star"-->
<!--"achievementsLeagueall-starStars" => 3-->
<!--"achievementsLeagueall-starValue" => 22-->
<!--"achievementsLeagueall-starTarget" => 1-->
<!--"achievementsLeagueall-starInfo" => "Become a Champion!"-->
<!--"achievementsX-bowexterminatorName" => "X-Bow Exterminator"-->
<!--"achievementsX-bowexterminatorStars" => 3-->
<!--"achievementsX-bowexterminatorValue" => 5973-->
<!--"achievementsX-bowexterminatorTarget" => 2500-->
<!--"achievementsX-bowexterminatorInfo" => "Destroy 2500 X-Bows in Multiplayer battles"-->
<!--"achievementsX-bowexterminatorCompletionInfo" => "Total X-Bows destroyed: 5973"-->
<!--"achievementsFirefighterName" => "Firefighter"-->
<!--"achievementsFirefighterStars" => 2-->
<!--"achievementsFirefighterValue" => 2780-->
<!--"achievementsFirefighterTarget" => 5000-->
<!--"achievementsFirefighterInfo" => "Destroy 5000 Inferno Towers in Multiplayer battles"-->
<!--"achievementsFirefighterCompletionInfo" => "Total Inferno Towers destroyed: 2780"-->
<!--"achievementsWarheroName" => "War Hero"-->
<!--"achievementsWarheroStars" => 2-->
<!--"achievementsWarheroValue" => 752-->
<!--"achievementsWarheroTarget" => 1000-->
<!--"achievementsWarheroInfo" => "Score 1000 stars for your clan in Clan War battles"-->
<!--"achievementsWarheroCompletionInfo" => "Total stars scored for clan in Clan War battles: 752"-->
<!--"achievementsTreasurerName" => "Treasurer"-->
<!--"achievementsTreasurerStars" => 3-->
<!--"achievementsTreasurerValue" => 225935258-->
<!--"achievementsTreasurerTarget" => 100000000-->
<!--"achievementsTreasurerInfo" => "Collect 100000000 gold from the Treasury"-->
<!--"achievementsTreasurerCompletionInfo" => "Total gold collected in Clan War bonuses: 225935258"-->
<!--"achievementsAnti-artilleryName" => "Anti-Artillery"-->
<!--"achievementsAnti-artilleryStars" => 2-->
<!--"achievementsAnti-artilleryValue" => 1179-->
<!--"achievementsAnti-artilleryTarget" => 2000-->
<!--"achievementsAnti-artilleryInfo" => "Destroy 2000 Eagle Artilleries in Multiplayer battles"-->
<!--"achievementsAnti-artilleryCompletionInfo" => "Total Eagle Artilleries destroyed: 1179"-->
<!--"achievementsSharingiscaringName" => "Sharing is caring"-->
<!--"achievementsSharingiscaringStars" => 1-->
<!--"achievementsSharingiscaringValue" => 1290-->
<!--"achievementsSharingiscaringTarget" => 2000-->
<!--"achievementsSharingiscaringInfo" => "Donate 2000 spell storage capacity worth of spells"-->
<!--"achievementsSharingiscaringCompletionInfo" => "Total spell capacity donated: 1290"-->

<hr>
<div>
    <h4>
        科技
    </h4>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">野蠻人</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsBarbarianLevel; $i++)
        <span>★</span>
        @endfor
        @for($i = 0; $i < ($player->troopsBarbarianMaxLevel - $player->troopsBarbarianLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">弓箭手</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsArcherLevel; $j++)
        <span>★</span>
        @endfor @for ($j= 0; $j < ($player->troopsArcherMaxLevel - $player->troopsArcherLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">巨人</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsGoblinLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsGoblinMaxLevel - $player->troopsGoblinLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">哥布林</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsGiantLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsGiantMaxLevel - $player->troopsGiantLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">炸彈人</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsWallbreakerLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsWallbreakerMaxLevel - $player->troopsWallbreakerLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">氣球兵</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsBalloonLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsBalloonMaxLevel - $player->troopsBalloonLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">法師</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsWizardLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsWizardMaxLevel - $player->troopsWizardLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">天使</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsHealerLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsHealerMaxLevel - $player->troopsHealerLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">飛龍</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsDragonLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsDragonMaxLevel - $player->troopsDragonLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">皮卡超人</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsPekkaLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsPekkaMaxLevel - $player->troopsPekkaLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">亡靈</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsMinionLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsMinionMaxLevel - $player->troopsMinionLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">野豬騎士</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsHogriderLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsHogriderMaxLevel - $player->troopsHogriderLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">瓦基麗武神</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsValkyrieLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsValkyrieMaxLevel - $player->troopsValkyrieLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">戈侖石人</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsGolemLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsGolemMaxLevel - $player->troopsGolemLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">女巫</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsWitchLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsWitchMaxLevel - $player->troopsWitchLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">熔岩獵犬</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsLavahoundLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsLavahoundMaxLevel - $player->troopsLavahoundLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">巨石投手</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsBowlerLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsBowlerMaxLevel - $player->troopsBowlerLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">飛龍寶寶</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->troopsBabydragonLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->troopsBabydragonMaxLevel - $player->troopsBabydragonLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">掘地礦工</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->troopsMinerLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->troopsMinerMaxLevel - $player->troopsMinerLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1"></div>
    <div class="col-xs-3 col-md-2"></div>
</div>
<hr>
<div>
    <h4>
        雙王
    </h4>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">野蠻人之王</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->heroesBarbariankingLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->heroesBarbariankingMaxLevel - $player->heroesBarbariankingLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">弓箭女皇</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->heroesArcherqueenLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->heroesArcherqueenMaxLevel - $player->heroesArcherqueenLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<hr>
<div>
    <h4>
        法術
    </h4>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">雷電法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->spellsLightningspellLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->spellsLightningspellMaxLevel - $player->spellsLightningspellLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">療傷法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->spellsHealingspellLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->spellsHealingspellMaxLevel - $player->spellsHealingspellLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">狂暴法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->spellsRagespellLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->spellsRagespellMaxLevel - $player->spellsRagespellLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">彈跳法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->spellsJumpspellLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->spellsJumpspellMaxLevel - $player->spellsJumpspellLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">冰凍法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->spellsFreezespellLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->spellsFreezespellMaxLevel - $player->spellsFreezespellLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">施毒法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->spellsPoisonspellLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->spellsPoisonspellMaxLevel - $player->spellsPoisonspellLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">地震法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->spellsEarthquakespellLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->spellsEarthquakespellMaxLevel - $player->spellsEarthquakespellLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">加速法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->spellsHastespellLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->spellsHastespellMaxLevel - $player->spellsHastespellLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>

<div class="row">
    <div class="col-xs-3 col-md-2">鏡像法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($i = 0; $i < $player->spellsClonespellLevel; $i++)
        <span>★</span>
        @endfor
        @for ($i = 0; $i < ($player->spellsClonespellMaxLevel - $player->spellsClonespellLevel); $i++)
        <span>☆</span>
        @endfor
    </div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">骷髏法術</div>
    <div class="col-xs-3 col-md-2">
        @for ($j = 0; $j < $player->spellsSkeletonspellLevel; $j++)
        <span>★</span>
        @endfor
        @for ($j = 0; $j < ($player->spellsSkeletonspellMaxLevel - $player->spellsSkeletonspellLevel); $j++)
        <span>☆</span>
        @endfor
    </div>
</div>
<hr>
<div>
    <h4>
        最近30天記錄
    </h4>
</div>
<table id="member" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td>日期</td>
        <td>獎杯數</td>
        <td>捐兵數</td>
        <td>收兵數</td>
        <td>捐收比</td>
    </tr>
    </thead>
    <tbody>
    @foreach($playerHistory as $member)
    <tr>
        <td>{{$member->created_at}}</td>
        <td>{{$member->trophies}}</td>
        <td>{{$member->donations}}</td>
        <td>{{$member->donationsReceived}}</td>
        <td>{{$member->donationRatio}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop