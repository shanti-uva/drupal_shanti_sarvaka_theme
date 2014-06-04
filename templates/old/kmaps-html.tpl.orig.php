<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <?php
    $theme_path = drupal_get_path('theme', 'shanti_theme');
    $subject =  preg_match('/subjects/', $_SERVER['REQUEST_URI']) === 1 ? true : false;
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shanti Kmaps</title>
  <meta name="description" content="template">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/utils.css">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/search-panel.css">
  <link href="//vjs.zencdn.net/4.5/video-js.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/main.css">
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/additional.css">
  <?php if(!$subject): ?>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/places.css">
  <?php endif ?>
  <link rel="icon" href="<?php print $theme_path; ?>/favicon.ico">
  
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
  <!--[if lte IE 8]><p class="progressive">It appears you are using an older browser. Please consider a upgrading to a modern version of your browser to best appreciate this website. Thank you -<i class="icon km-close"></i></p><![endif]-->
  <div class="wrap-all">
  <a href=".main-content" class="sr-only">Skip to main content</a>
  <header class="header-banner" role="banner">
    <div class="navbar navbar-default navbar-static-top" role="navigation">  
      
      <div class="menu-buttons">
        <span class="kmaps-searchtoggle menu-icon"><a href="#"><i class='icon km-search-kmaps'></i></a></span>
        <span class="menu-toggle menu-icon"><a href="#"><i class="icon km-menu"></i></a></span>
        <span class="menu-maintoggle menu-icon"><a href="#"><i class="icon km-menu"></i></a></span>
        <span class="menu-exploretoggle menu-explore"><a href="#"><span>Explore </span>Collections<i class="icon km-directions"></i></a></span>
      </div>

      <div class="navbar-header">
        <h1 class="navbar-title"><a href="#" class="navbar-brand" title="SHANTI Homepage"><i class="icon km-logo-kmaps"></i><em>SHANTI</em>
          <span>Scholarly Collections at the University of Virginia</span></a>
        </h1>
      </div>

      <nav class="navbar-collapse collapse navtop" role="navigation">
       <form role="form" class="form">
       <fieldset>         
        <ul class="nav navbar-nav navbar-right">
          <li class="explore"><a href="#">Explore Collections<i class="icon km-directions"></i></a></li>
          <li class="dropdown lang highlight">                    
              <a href="" class="dropdown-toggle" data-toggle="dropdown">Eng<i class="icon km-arrowselect"></i></a>
              <ul class="dropdown-menu dropdown-features" role="menu">
                <li class="form-group"><label class="radio-inline" for="optionlang1">
                    <input type="radio" name="radios" id="optionlang1" value="lang1">Tibetan</label>
                </li>
                <li class="form-group"><label class="radio-inline" for="optionlang2">
                    <input type="radio" name="radios" id="optionlang2" value="lang2" checked>English</label>
                </li>
                <li class="form-group"><label class="radio-inline" for="optionlang3">
                    <input type="radio" name="radios" id="optionlang3" value="lang3">French</label>
                </li>
                <li class="last form-group"><label class="radio-inline" for="optionlang4">
                    <input type="radio" name="radios" id="optionlang4" value="lang4">Chinese</label>
                </li>
              </ul>
          </li>
        </ul>
       </fieldset>  
       </form>           
     </nav><!-- END navbar-collapse -->
    </div><!-- END navbar -->

    <!-- BEGIN navigation dropdown panel -->  
    <section class="row collections collapse opencollect">
      <nav class="container-fluid" role="navigation"> 
         <div class="col-sm-8 col-sm-offset-2">          
            <h4>EXPLORE COLLECTIONS</h4>
            <div class="four-collections">
              <div class="col-sm-3">
                <ul>
                  <li><a href="<?php print base_path(); ?>subjects"><i class="icon km-subjects"></i>Subjects</a></li>
                  <li><a href="<?php print base_path(); ?>places"><i class="icon km-places"></i>Places</a></li>
                  <li><a href="#"><i class="icon km-agents"></i>Agents</a></li>
                  <li><a href="#"><i class="icon km-events"></i>Events</a></li>
                </ul>
              </div>
              <div class="col-sm-3">
                <ul>
                  <li><a href="#"><i class="icon km-photos"></i>Photos</a></li>
                  <li><a href="#"><i class="icon km-audiovideo"></i>Audio-Video</a></li>
                  <li><a href="#"><i class="icon km-visuals"></i>Visuals</a></li>
                </ul>
              </div>
              <div class="col-sm-3">
                <ul>
                  <li><a href="#"><i class="icon km-essays"></i>Essays</a></li>
                  <li><a href="#"><i class="icon km-texts"></i>Texts</a></li>
                  <li><a href="#"><i class="icon km-maps"></i>Maps</a></li>
                </ul>
              </div>
              <div class="col-sm-3">
                <ul class="last">
                  <li><a href="#"><i class="icon km-community"></i>Community</a></li>
                  <li><a href="#"><i class="icon km-terms"></i>Terms</a></li>
                  <li><a href="#"><i class="icon km-sources"></i>Sources</a></li>
                </ul>
              </div>
            </div>          
         </div>
          <span class="closecollection"> <i class="icon km-close"></i> </span>
      </nav>
    </section><!-- END dropdown panel -->
  </header><!-- END container-fluid -->
  
  <!-- BEGIN content -->
  <main class="main-wrapper container-fluid" role="main">
    <article class="row main-content">
      
    <header class="col-sm-12 titlearea">
     <div>
      <h1 class="page-title"><i class="icon <?php print $subject ? "km-subjects" : "km-places"; ?>"></i><span><?php print $subject ? "Collections" : "Earth"; ?></span></h1>
      <nav class="breadwrap" role="navigation">
        <ol class="breadcrumb">
          <li><a href=""><span class="tag-before-breadcrumb"><?php print $subject ? "Subjects:" : "Places"; ?></span></a></li>
        </ol>
      </nav>
      </div>
    </header>
              
    <aside class="col-sm-3 content-resources main-col">
      <ul class="nav nav-pills nav-stacked">
        <li class="active overview"><a href="#tab-overview" data-toggle="pill"><i class="icon km-overview"></i>Overview</a></li>
        <li class="related"><a href="#tab-related" data-toggle="pill"><i class="icon km-subjects"></i>Subjects<span class="badge">5</span></a></li>
        <li class="places"><a href="#tab-places" data-toggle="pill"><i class="icon km-places"></i>Places<span class="badge">3</span></a></li>
        <li class="essays"><a href="#tab-essays" data-toggle="pill"><i class="icon km-essays"></i>Essays<span class="badge">1</span></a></li>
        <li class="subjects"><a href="#tab-subjects" data-toggle="pill"><i class="icon km-subjects"></i>Subjects<span class="badge">3</span></a></li>
        <li class="agents"><a href="#tab-agents" data-toggle="pill"><i class="icon km-agents"></i>Agents<span class="badge">3</span></a></li>
        <li class="events"><a href="#tab-events" data-toggle="pill"><i class="icon km-events"></i>Events<span class="badge">3</span></a></li>
        <li class="photos"><a href="#tab-photos" data-toggle="pill"><i class="icon km-photos"></i>Photos<span class="badge">3</span></a></li>
        <li class="audio-video"><a href="#tab-audio-video" data-toggle="pill"><i class="icon km-audiovideo"></i>Audio-Video<span class="badge">3</span></a></li>
        <li class="visuals"><a href="#tab-visuals" data-toggle="pill"><i class="icon km-visuals"></i>Visuals<span class="badge">3</span></a></li>
        <li class="texts"><a href="#tab-texts" data-toggle="pill"><i class="icon km-texts"></i>Texts<span class="badge">3</span></a></li>
        <li class="maps"><a href="#tab-maps" data-toggle="pill"><i class="icon km-maps"></i>Maps<span class="badge">3</span></a></li>
        <li class="community"><a href="#tab-community" data-toggle="pill"><i class="icon km-community"></i>Community<span class="badge">3</span></a></li>
        <li class="terms"><a href="#tab-terms" data-toggle="pill"><i class="icon km-terms"></i>Terms<span class="badge">3</span></a></li>
        <li class="sources"><a href="#tab-sources" data-toggle="pill"><i class="icon km-sources"></i>Sources<span class="badge">3</span></a></li>
      </ul>
    </aside> 
                      
    <section  class="col-xs-12 col-sm-9 content-section main-col">
      <div class="tab-content">
        <article class="tab-pane active" id="tab-overview">
        </article>
        <!-- END tab-pane active -->

        <article class="tab-pane" id="tab-related">
          <h6>Essays</h6>
          <p>Lorem ipsum Cupidatat nostrud qui do in commodo laborum aliquip pariatur id cupidatat non esse ad dolor quis id mollit non quis sint elit aliquip incididunt sint eiusmod irure consequat deserunt incididunt laboris incididunt occaecat cillum aute incididunt magna sed deserunt proident occaecat Ut officia dolor ea Excepteur in minim deserunt adipisicing ullamco voluptate Ut consectetur cillum enim qui aute commodo officia consequat Ut nostrud adipisicing et adipisicing aliquip consequat sit sint dolor irure cupidatat cupidatat dolor id in fugiat culpa fugiat consectetur esse sed dolor fugiat nisi consequat labore ea aliquip in irure occaecat magna veniam reprehenderit sit sit tempor est adipisicing consequat sint ut amet anim cupidatat in labore ullamco qui magna officia quis fugiat dolore consectetur do proident ex sunt sint consectetur cupidatat consectetur cillum dolor ut consequat Excepteur et incididunt qui exercitation cupidatat sit laboris sit anim consequat Ut eu dolore amet cillum proident sint minim ea laboris elit Excepteur.</p>
        </article>

        <article class="tab-pane" id="tab-essays">
          <h6>Essays</h6>
          <p>Lorem ipsum Cupidatat nostrud qui do in commodo laborum aliquip pariatur id cupidatat non esse ad dolor quis id mollit non quis sint elit aliquip incididunt sint eiusmod irure consequat deserunt incididunt laboris incididunt occaecat cillum aute incididunt magna sed deserunt proident occaecat Ut officia dolor ea Excepteur in minim deserunt adipisicing ullamco voluptate Ut consectetur cillum enim qui aute commodo officia consequat Ut nostrud adipisicing et adipisicing aliquip consequat sit sint dolor irure cupidatat cupidatat dolor id in fugiat culpa fugiat consectetur esse sed dolor fugiat nisi consequat labore ea aliquip in irure occaecat magna veniam reprehenderit sit sit tempor est adipisicing consequat sint ut amet anim cupidatat in labore ullamco qui magna officia quis fugiat dolore consectetur do proident ex sunt sint consectetur cupidatat consectetur cillum dolor ut consequat Excepteur et incididunt qui exercitation cupidatat sit laboris sit anim consequat Ut eu dolore amet cillum proident sint minim ea laboris elit Excepteur.</p>
        </article>

        <article class="tab-pane" id="tab-subjects">
          <h6>Subjects</h6>
          <p>Lorem ipsum Excepteur enim nisi in esse sint deserunt enim pariatur incididunt incididunt magna do deserunt aute pariatur deserunt non eiusmod nisi cupidatat commodo irure sit eiusmod elit sed et Ut esse cupidatat occaecat adipisicing eu sunt dolore sed labore in in tempor laborum irure aliquip amet cupidatat mollit do nisi magna pariatur nostrud Ut ex aliqua consequat in incididunt magna nulla Duis culpa mollit Ut culpa occaecat sunt ea cupidatat nostrud ex cupidatat amet esse aliquip aliqua est laborum minim in tempor dolore officia fugiat nisi dolor Duis occaecat reprehenderit incididunt est veniam anim adipisicing in ut nostrud cupidatat in irure quis enim commodo quis officia adipisicing cupidatat nisi incididunt anim dolor sed tempor aliquip esse voluptate aute in exercitation nulla non nostrud in aliquip sed officia sint minim eiusmod voluptate consectetur dolore veniam sint sed in pariatur cillum ad Duis mollit in anim amet enim dolor Duis laboris Duis deserunt Duis ex non eiusmod laborum commodo cupidatat aliqua aute veniam minim sint veniam officia aute Excepteur eiusmod ex adipisicing cillum minim ut non eu voluptate enim ex pariatur ad Duis Ut aliqua et reprehenderit est dolore labore Excepteur laboris deserunt Excepteur officia fugiat do nisi exercitation cupidatat eu non velit veniam quis tempor magna in ut enim fugiat laborum Excepteur aliqua cupidatat consectetur commodo sit quis occaecat anim ullamco id do nulla anim quis proident et cupidatat adipisicing aute quis occaecat ad consequat anim in dolore.</p>
        </article>

        <article class="tab-pane" id="tab-places">
          <h6>Places</h6>
          <p>Lorem ipsum Aute consequat anim cupidatat proident pariatur sed esse tempor est magna culpa minim id proident consectetur officia aliquip in dolore sint occaecat tempor magna minim exercitation consectetur dolor amet elit dolore et nostrud sint amet pariatur sint sint dolor tempor est et dolor reprehenderit dolor pariatur laboris dolore esse laborum occaecat dolor voluptate sed esse in veniam in consequat sed ut laboris cupidatat irure deserunt cillum laborum voluptate eiusmod enim Excepteur veniam proident ut in Duis aute adipisicing minim ex voluptate adipisicing deserunt ex anim amet eu tempor nostrud dolor ut sunt elit do sint dolore ex labore officia fugiat quis exercitation fugiat et nulla velit occaecat enim voluptate est id sed labore eu do deserunt amet id sit laboris dolore dolore ex cupidatat quis laboris aute ut pariatur cillum deserunt aliqua veniam esse eu dolore laboris occaecat esse dolor enim laboris sit deserunt commodo deserunt dolor commodo Excepteur eu ut dolore dolore enim amet deserunt fugiat ut in est dolor nostrud id labore aliquip nisi dolore laborum ut sed do cillum magna officia culpa fugiat laborum laboris sit nostrud esse exercitation commodo dolore dolore proident aliquip ut magna voluptate non exercitation sint adipisicing nostrud est cillum sint nostrud esse ullamco voluptate magna ullamco pariatur sint eu aute consectetur nisi dolor in Duis enim dolore ex et sed elit deserunt non velit proident amet culpa commodo est elit culpa id adipisicing est exercitation dolor nulla commodo sint Duis non incididunt reprehenderit do dolore ad et ad in commodo amet occaecat laborum aliqua sed commodo in in laboris sit et incididunt consectetur sed Duis ut.</p>
        </article>

        <article class="tab-pane" id="tab-agents">
          <h6>Agents</h6>
          <p>Lorem ipsum Consequat Ut tempor culpa ut consequat incididunt dolore sit qui tempor consectetur quis anim culpa non ad dolore adipisicing reprehenderit dolor Ut irure exercitation incididunt ex consequat in eiusmod irure ut ut eu id amet Ut velit proident ad ea consectetur non aliqua Duis tempor ut dolore in magna dolor consectetur proident cillum elit cupidatat cillum dolore commodo cillum tempor quis Ut in in consectetur non ad enim veniam pariatur ad ut aliquip consequat in velit est ut consequat dolor pariatur nisi labore elit aute commodo nisi elit amet laboris pariatur dolore quis sed aliquip Ut laborum cupidatat ea eiusmod ut sed ex enim Duis ex anim reprehenderit pariatur aute dolore deserunt magna esse adipisicing in sit dolor ut minim ut elit ut officia minim pariatur non commodo tempor ut laborum ut adipisicing enim Duis veniam sint dolore dolore esse nostrud velit quis adipisicing aliqua consectetur adipisicing aliquip Duis aute ea ut eiusmod Duis incididunt incididunt quis Ut id enim elit elit id sint adipisicing elit non commodo officia labore culpa ea sed tempor adipisicing id aute ex aliquip reprehenderit ut consequat Excepteur sint et Ut mollit do fugiat ad eiusmod velit labore fugiat fugiat mollit eu cillum eu officia aute enim sint et dolor aliquip voluptate.</p>
        </article>

        <article class="tab-pane" id="tab-events">
          <h6>Events</h6>
          <p>Lorem ipsum Do exercitation enim ea deserunt incididunt ut labore ullamco cupidatat in fugiat mollit officia eu mollit sit sint elit ullamco id aute ad cillum officia irure irure sint in non irure nisi ad pariatur eu veniam mollit culpa dolore eu amet adipisicing in do et esse aliqua tempor dolor velit ex nulla irure nulla nisi tempor sint ad sint ullamco in tempor ut ea sit dolore fugiat pariatur esse dolore consequat esse sunt amet eu ex laboris quis anim nisi ut ut Excepteur nisi do labore commodo ea in officia cillum esse sunt in mollit deserunt nulla irure dolore et Duis ut ea nulla consectetur nostrud nulla magna sit magna consequat irure adipisicing culpa minim Ut do adipisicing mollit culpa sint Duis dolore aliquip nostrud consectetur est proident id sint labore sed nulla irure qui amet pariatur proident minim est proident pariatur consequat irure et in sunt laborum pariatur officia Excepteur pariatur velit do aliquip anim sint labore adipisicing eiusmod quis ut id non consectetur enim adipisicing laboris Duis culpa aliqua ut Excepteur deserunt sunt nostrud velit ea voluptate enim qui non cupidatat reprehenderit dolor anim esse commodo qui laboris id et anim velit minim ut incididunt enim laborum et nisi elit consequat velit deserunt do ex ex aliquip in incididunt commodo Duis laboris non voluptate ea qui mollit enim aliqua esse consectetur Excepteur elit in laboris occaecat nisi Ut deserunt sed aliqua eu esse.</p>
        </article>

        <article class="tab-pane" id="tab-photos">
          <h6>Photos</h6>
          <p>Lorem ipsum Cillum in aliquip culpa commodo nisi non ad cillum eu ullamco laborum do voluptate in voluptate quis in amet ad sunt Ut dolore in ea do sed cillum quis aliquip Duis est officia incididunt pariatur aliqua eiusmod sed in ad consequat eiusmod id mollit voluptate est adipisicing pariatur fugiat id magna ut sunt ea aute ullamco id adipisicing sit ex ea eiusmod cupidatat eiusmod cupidatat id sed amet irure consectetur in tempor ut esse voluptate ut dolore enim commodo ea irure laborum minim veniam commodo consectetur adipisicing enim voluptate ad in officia commodo sed dolor id ut exercitation cillum sint culpa commodo ea deserunt mollit eiusmod laborum do qui sunt do anim cupidatat quis pariatur ut mollit do labore mollit in magna amet elit id dolore nisi non sit amet velit quis in Ut incididunt ut quis proident qui reprehenderit sint id consequat sunt consectetur anim ea qui aliquip magna ex culpa sunt ut sint adipisicing Excepteur aliquip et reprehenderit in aute voluptate aliqua magna laborum laborum Duis anim pariatur amet Excepteur consequat nisi irure aliquip quis voluptate enim elit commodo ad magna eu veniam esse dolor consequat velit esse in.</p>
        </article>

        <article class="tab-pane" id="tab-audio-video">
          <h6>Audio-Video</h6>
          <p>Lorem ipsum Qui veniam ullamco ut sit eu esse eu eiusmod nisi pariatur qui et dolor deserunt amet sed est reprehenderit culpa aliquip dolore fugiat adipisicing Excepteur veniam ea laboris proident et dolore deserunt pariatur sed Duis labore aliquip in sed laboris minim tempor id officia id ut aute officia ullamco eu sit minim sunt commodo ut sint commodo ad Ut eiusmod minim laboris eiusmod minim aute aute veniam enim dolore pariatur minim esse sit dolore nulla in laboris amet esse esse sit sint ullamco elit ad nostrud officia quis dolore in officia nostrud irure sit eiusmod nulla laboris reprehenderit ut Ut nulla sint sunt est sint cillum commodo consequat nulla aute dolor ad esse anim cupidatat commodo in dolor culpa incididunt Duis Ut in tempor Ut in id Duis nisi consectetur ut ut in enim tempor sunt nostrud labore do sint culpa irure labore cupidatat do irure sit minim et aliquip elit enim amet occaecat laboris mollit amet sint sint adipisicing in incididunt cillum tempor aute laborum cupidatat Duis officia nisi aliquip sed id reprehenderit ullamco exercitation dolor incididunt ullamco dolore ullamco eiusmod et sed labore deserunt dolore tempor quis occaecat aliquip culpa cupidatat nulla aliquip amet eiusmod velit eiusmod sit cupidatat dolore irure reprehenderit ut consequat anim quis incididunt enim aute ut veniam mollit esse Excepteur magna anim mollit eiusmod laboris sint amet in consequat eiusmod quis ut quis sit ea ex aliquip nostrud officia et Ut consequat in enim dolore laboris eu ea id qui nisi veniam dolor sint in aliquip labore aliquip occaecat sint dolore.</p>
        </article>

        <article class="tab-pane" id="tab-visuals">
          <h6>Visuals</h6>
          <p>Lorem ipsum Laborum minim dolore qui consequat non enim fugiat in adipisicing consectetur aliquip ut dolore mollit sed nulla irure occaecat exercitation veniam eiusmod in non anim anim consequat magna in minim dolore in aliquip dolore irure qui fugiat mollit laboris anim nulla in mollit elit do dolore exercitation do et elit ad nulla ea laborum Excepteur eiusmod nostrud aute culpa occaecat velit eiusmod nulla dolor irure consectetur mollit fugiat pariatur tempor consectetur Excepteur dolor dolore est exercitation enim Excepteur occaecat proident anim in ut id quis in enim esse mollit aliqua dolore dolor quis eu enim aliquip dolor in laborum consectetur occaecat in tempor ea dolore do non deserunt ad proident laboris esse enim labore commodo laboris incididunt ullamco consequat ut deserunt in nisi velit aliqua officia proident amet nulla aliquip et cupidatat enim culpa tempor dolore ullamco ad qui labore.</p>
        </article>

        <article class="tab-pane" id="tab-texts">
          <h6>Texts</h6>
          <p>Lorem ipsum Laboris cillum magna nulla Excepteur nostrud dolore irure do aute officia eu eu incididunt tempor laborum adipisicing ut dolore culpa veniam nostrud magna eiusmod do officia Excepteur nisi commodo Duis exercitation occaecat deserunt sit in sed esse sit eu dolor ex aliquip occaecat cupidatat commodo Duis fugiat nostrud nulla eu elit id dolore anim dolore veniam amet quis nisi amet aliquip labore aute sit consequat laboris commodo ullamco sed consectetur anim commodo elit ex mollit culpa reprehenderit sit ea amet anim in nulla ad occaecat in minim adipisicing ea quis dolor ut Duis nisi irure dolore pariatur pariatur enim quis Duis veniam aliqua nostrud dolore dolor eu dolor sit commodo dolor reprehenderit magna consequat minim ullamco mollit labore aliquip laborum veniam nulla enim esse et reprehenderit anim officia ad reprehenderit pariatur proident deserunt officia labore exercitation exercitation ad eu consequat enim commodo quis nostrud pariatur proident laborum mollit dolor nulla elit fugiat enim Duis ut pariatur eiusmod sint consequat dolore Excepteur cillum sint nostrud ex cupidatat in ullamco dolore sint commodo cupidatat occaecat pariatur Duis Duis esse velit velit amet est enim cillum ullamco dolore cillum nulla voluptate dolore minim qui eu dolore consequat exercitation culpa in fugiat esse est dolor velit in id nostrud in qui Duis amet ex consectetur deserunt minim id irure fugiat dolor Ut voluptate Duis ullamco ea in aliqua enim eiusmod dolor dolore proident ad cupidatat.</p>
        </article>

        <article class="tab-pane" id="tab-maps">
          <h6>Maps</h6>
          <p>Lorem ipsum Mollit adipisicing adipisicing anim officia sit commodo fugiat enim pariatur dolore eiusmod labore aliquip sit amet labore proident labore mollit dolore do nulla laborum id in elit sit nulla adipisicing esse reprehenderit incididunt anim sunt commodo aliquip dolore adipisicing voluptate proident non in et aute occaecat et fugiat ut nulla dolor fugiat voluptate esse commodo aliquip est aliquip sint mollit sit voluptate voluptate culpa velit nisi in id velit minim id deserunt et proident incididunt aliquip eu velit laboris commodo do sint incididunt eu dolor consectetur ad exercitation voluptate Ut veniam irure in dolore ut ea et sed officia sed aliquip consectetur dolore proident mollit eu nulla minim cillum do ad quis enim incididunt in anim eu incididunt ea enim adipisicing cupidatat dolore ad dolore ut nisi do voluptate deserunt elit proident in Duis culpa ut voluptate est sed occaecat in tempor dolor dolore magna ut minim in id elit est magna.</p>
        </article>

        <article class="tab-pane" id="tab-community">
          <h6>Community</h6>
          <p>Lorem ipsum Dolor velit ad culpa occaecat minim sint reprehenderit fugiat qui minim ut tempor elit dolor sit id do ex fugiat deserunt consectetur consectetur nisi Duis magna aliqua veniam adipisicing ut eiusmod amet adipisicing eu Duis exercitation occaecat qui laborum elit cupidatat cupidatat Duis fugiat esse dolor ut irure in cupidatat laboris consectetur quis enim Ut consequat deserunt commodo consequat nisi aliquip eu ex Duis sint labore minim nostrud adipisicing irure Ut aute esse sit et sit exercitation dolor consectetur proident Excepteur do dolor minim irure laborum cillum incididunt sit velit dolore reprehenderit eiusmod dolor do eu irure ex id tempor mollit eiusmod laborum non amet aliquip enim est incididunt qui dolore sunt esse irure dolore qui consectetur deserunt in dolor ea Excepteur reprehenderit laboris in ea aliquip minim veniam occaecat aute mollit dolor aliqua qui irure tempor reprehenderit nisi do et dolor dolore irure aliquip deserunt dolore consequat minim reprehenderit minim irure dolor dolor Duis.</p>
        </article>

        <article class="tab-pane" id="tab-terms">
          <h6>Terms</h6>
          <p>Lorem ipsum Nulla in ullamco pariatur velit occaecat cupidatat in ex reprehenderit incididunt elit nostrud laboris id pariatur irure cillum dolor exercitation magna laborum proident in nostrud fugiat mollit nulla dolore qui deserunt fugiat esse est ut anim eiusmod cillum dolore officia sed elit laborum id incididunt dolor do id sed do pariatur proident ut pariatur aliqua enim veniam eiusmod anim nisi magna cupidatat reprehenderit aute cupidatat Duis in id nisi sit do et anim dolore elit quis laboris velit amet consectetur reprehenderit ut Ut magna qui cillum est nulla deserunt tempor in fugiat quis consequat magna adipisicing commodo consectetur in exercitation occaecat cupidatat fugiat consequat et incididunt laboris nulla velit nulla aute exercitation ea nisi tempor culpa ea qui elit qui deserunt Duis aliquip consectetur deserunt laboris voluptate mollit enim irure Excepteur ut Excepteur exercitation consequat cupidatat in aliquip minim esse consectetur magna nulla elit quis id dolore labore est pariatur ad ad anim exercitation consectetur commodo ex sunt occaecat non incididunt laborum Duis qui magna dolor sit dolore tempor consequat ullamco nostrud nostrud adipisicing nulla proident aliqua ut non anim in sint amet ut commodo enim consectetur nostrud officia eiusmod eiusmod enim cillum Excepteur mollit do esse velit dolore est reprehenderit nostrud proident aute nisi deserunt do laboris velit ut quis dolore magna amet consequat et aliquip magna adipisicing fugiat Excepteur consectetur dolore veniam mollit veniam occaecat in dolor enim dolor mollit dolor sed id elit reprehenderit officia Duis ut voluptate.</p>
        </article>

        <article class="tab-pane" id="tab-sources">
          <h6>Sources</h6>
          <p>Lorem ipsum Et in et magna qui qui occaecat sunt do Ut magna in eu nulla minim ad sit nulla nisi commodo et proident est reprehenderit sunt culpa aliqua tempor laborum enim elit amet et do sunt officia nulla ut nisi ullamco mollit incididunt tempor laboris sed consequat sed pariatur deserunt tempor aute qui in culpa ut nulla irure officia laboris commodo cillum consequat Duis incididunt aliqua Ut adipisicing cillum proident eu consequat sit velit adipisicing aute Duis do esse incididunt reprehenderit consectetur dolore et Excepteur velit dolore exercitation in aute velit occaecat commodo enim quis sit minim sunt in occaecat ea pariatur elit ullamco Excepteur ut sed sunt eu Ut pariatur dolor qui aliqua proident sunt non consequat est elit incididunt quis officia aliqua veniam consequat pariatur anim nostrud mollit est mollit incididunt ad ut anim minim anim sint commodo quis cillum sed officia esse exercitation nisi velit qui enim sed ullamco aliqua dolore laboris laboris sunt quis dolor voluptate cupidatat aute in ad Ut ex nulla nisi enim tempor non fugiat in et pariatur ex tempor officia aute velit quis eu ea cillum mollit ut est in tempor eu deserunt amet Excepteur aute incididunt irure enim in ullamco adipisicing sed incididunt nisi velit tempor reprehenderit consectetur commodo dolore dolore est magna qui ullamco sunt dolore sit labore veniam esse Duis qui tempor in ea amet commodo elit dolore occaecat mollit elit nostrud cupidatat deserunt ea consectetur exercitation dolor culpa do ad pariatur.</p>
        </article>
      </div><!-- END tab-content -->
    </section><!-- END content-page -->           
    
    
    
    
      <a href="#" class="back-to-top"><i class="icon"></i>Top</a>
    </article><!-- END main-content -->
  </main><!-- END container-fluid -->



  <section id="menu-collections" class="menu-accordion" role="navigation">    
      <nav class="panel-group accordion" id="menu-accordion">                         
      
            <div class="panel panel-default menu-collections-wrap1">
              <h6 class="panel-heading"><a href="#collapseCollections1" data-toggle="collapse" data-parent="#menu-accordion" class="accordion-toggle"><i class="icon"></i> 
                    Kmaps Collections</a>
              </h6>
              <div id="collapseCollections1" class="panel-collapse collapse in">
                <div class="panel-body menu-collections">
                  <ul>
                    <li><a href="#"><i class="icon km-subjects"></i>Subjects</a></li>
                    <li><a href="#"><i class="icon km-places"></i>Places</a></li>
                    <li><a href="#"><i class="icon km-agents"></i>Agents</a></li>
                    <li><a href="#"><i class="icon km-events"></i>Events</a></li>
                    <li><a href="#"><i class="icon km-photos"></i>Photos</a></li>
                    <li><a href="#"><i class="icon km-audiovideo"></i>Audio-Video</a></li>
                    <li><a href="#"><i class="icon km-visuals"></i>Visuals</a></li>
                    <li><a href="#"><i class="icon km-essays"></i>Essays</a></li>
                    <li><a href="#"><i class="icon km-texts"></i>Texts</a></li>
                    <li><a href="#"><i class="icon km-maps"></i>Maps</a></li>
                    <li><a href="#"><i class="icon km-community"></i>Community</a></li>
                    <li><a href="#"><i class="icon km-terms"></i>Terms</a></li>
                    <li><a href="#"><i class="icon km-sources"></i>Sources</a></li>
                    <li class="bottom-trim"></li>
                  </ul>
                </div>
              </div>
            </div>
      </nav>      
  </section>

  
  
  <section id="menu-main" class="menu-accordion" role="navigation">   
      <nav class="panel-group accordion" id="menu-accordion-main">                                
            
            <div class="panel panel-default menu-collections-wrap">
              <h6 class="panel-heading"><a href="#collapseCollections" data-toggle="collapse" data-parent="#menu-accordion-main" class="accordion-toggle collapsed"><i class="icon"></i> 
                    Kmaps Collections</a>
              </h6>
              <div id="collapseCollections" class="panel-collapse collapse">
                <div class="panel-body menu-collections">
                  <ul>
                    <li><a href="#"><i class="icon km-subjects"></i>Subjects</a></li>
                    <li><a href="#"><i class="icon km-places"></i>Places</a></li>
                    <li><a href="#"><i class="icon km-agents"></i>Agents</a></li>
                    <li><a href="#"><i class="icon km-events"></i>Events</a></li>
                    <li><a href="#"><i class="icon km-photos"></i>Photos</a></li>
                    <li><a href="#"><i class="icon km-audiovideo"></i>Audio-Video</a></li>
                    <li><a href="#"><i class="icon km-visuals"></i>Visuals</a></li>
                    <li><a href="#"><i class="icon km-essays"></i>Essays</a></li>
                    <li><a href="#"><i class="icon km-texts"></i>Texts</a></li>
                    <li><a href="#"><i class="icon km-maps"></i>Maps</a></li>
                    <li><a href="#"><i class="icon km-community"></i>Community</a></li>
                    <li><a href="#"><i class="icon km-terms"></i>Terms</a></li>
                    <li><a href="#"><i class="icon km-sources"></i>Sources</a></li>
                    <li class="bottom-trim"></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="panel panel-default menu-commons-wrap">
              <h6 class="panel-heading"><a href="#collapseCommons" data-toggle="collapse" data-parent="#menu-accordion-main" class="accordion-toggle"><i class="icon"></i> 
                    Main Menu</a></h6>
              <div id="collapseCommons" class="panel-collapse collapse in">
                <div class="panel-body menu-common">
                  <ul>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
            </div>
          
            <div class="panel panel-default menu-options-wrap">
              <h6 class="panel-heading"><a href="#collapseOptions" data-toggle="collapse" data-parent="#menu-accordion-main" class="accordion-toggle collapsed"><i class="icon"></i> 
                  View Preferences</a></h6>
              <div id="collapseOptions" class="panel-collapse collapse">
                <div class="panel-body menu-options">
                
                  <ul>          
                    <!-- header -->              
                    <li class="drop-hdr"><em>Site Language</em></li>
                      <li class="form-group"><label class="radio-inline" for="option0a">
                        <input type="radio" name="option0" id="option0a" value="option0a" checked>English</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option0b">
                        <input type="radio" name="option0" id="option0b" value="option0b">French</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option0c">
                        <input type="radio" name="option0" id="option0c" value="option0c">Tibetan</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option0d">
                        <input type="radio" name="option0" id="option0d" value="option0d">Chinese</label>
                      </li>                     
                      <li class="form-group last"></li>
                      
                    <!-- header -->              
                    <li class="drop-hdr"><em>Perspective</em></li>
                      <li class="form-group"><label class="radio-inline" for="option1a">
                        <input type="radio" name="option1" id="option1a" value="option1a" checked>General</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option1b">
                        <input type="radio" name="option1" id="option1b" value="option1b">Other</label>
                      </li>
                      <li class="form-group last"></li>
                    
                    <!-- header -->
                    <li class="drop-hdr"><em>Subject Language</em></li>
                      <li class="form-group"><label class="radio-inline" for="option2a">
                        <input type="radio" name="option2" id="option2a" value="option2a">Chinese Characters (simplified)</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option2b">
                        <input type="radio" name="option2" id="option2b" value="option2b">Chinese Characters (traditional)</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option2c">
                        <input type="radio" name="option2" id="option2c" value="option2c">Devangiri Script</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option2d">
                        <input type="radio" name="option2" id="option2d" value="option2d" checked>Popular Standard (romanization)</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option2e">
                        <input type="radio" name="option2" id="option2e" value="option2e">Scholarly Standard (romanization)</label>
                      </li>                   
                      <li class="form-group"><label class="radio-inline" for="option2f">
                        <input type="radio" name="option2" id="option2f" value="option2f">Tibetan Script (simplified)</label>
                      </li>                   
                      <li class="form-group"><label class="radio-inline" for="option2g">
                        <input type="radio" name="option2" id="option2g" value="option2g">Tibetan Script (romanization)</label>
                      </li>
                      <li class="form-group last"></li>
                    
                    <!-- header -->
                    <li class="drop-hdr"><em>Show Subject Details</em></li>                     
                      <li class="form-group"><label class="radio-inline" for="option3a">
                        <input type="radio" name="option3" id="option3a" value="option3a" checked>Yes</label>
                      </li>
                      <li class="form-group"><label class="radio-inline" for="option3b">
                        <input type="radio" name="option3" id="option3b" value="option3b">No</label>
                      </li>
                      <li class="form-group last"></li>
                      <li class="bottom-trim"></li>
                  </ul>
                                                  
                </div>
              </div>
            </div>
      </nav>        
  </section>

  <!-- BEGIN Search Panel --> 
  <section id="kmaps-search">               
      <!-- BEGIN input section -->                    
      <section class="input-section" style="display:none;">                   
        <form role="form" class="form">
         <fieldset>                       
          <legend class="hidden">Search Form</legend>                 
                                    
            <div class="input-group">
                <input id="searchform" class="form-control kms" type="text" placeholder="Enter Search...">
                <span class="input-group-btn">
                  <button type="reset" class="searchreset">&times;</button>
                  <button id="searchbutton" type="button" class="btn btn-default"><i class="icon"></i></button>
                </span>
					  </div>

                     <!-- search scope -->
                     <div class="btn-group" data-toggle="buttons">
                         <label class="checkbox-inline">
                             <input type="checkbox" id="termscope" name="term-scope" checked="checked" data-value="terms"> Terms
                         </label>
                         <label class="checkbox-inline">
                             <input type="checkbox" id="summaryscope" name="summary-scope" checked="checked" data-value="summaries"> Summaries
                         </label>
                         <label class="checkbox-inline" >
                             <input type="checkbox" id="essayscope" name="essay-scope" data-value="essays"> Essays
                         </label>
            </div>

            <a href="#" class="advanced-link toggle-link"><i class="icon"></i>Advanced</a>  
            <div id="notification-wrapper"></div>
                
               <!-- advanced search hidden ontent -->
               <div class="advanced-view" style="display:none;">
                
                                              
                  <div class="form-group"> 
                    <label class="radio-inline" for="radios-0">
                      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
                        All Text</label> 
                    <label class="radio-inline" for="radios-1">
                      <input type="radio" name="radios" id="radios-1" value="2">
                        Name </label> 
                  </div>
                                              
                  <div class="form-group">
                    <label class="radio-inline" for="radios-2">
                      <input type="radio" name="radios2" id="radios-2" value="3" checked="checked">
                        Contains</label> 
                    <label class="radio-inline" for="radios-3">
                      <input type="radio" name="radios2" id="radios-3" value="4">
                        Starts With</label>
                    <label class="radio-inline" for="radios-4">
                      <input type="radio" name="radios2" id="radios-4" value="5">
                        Exactly</label>                             
                  </div>
                  
                  <div class="form-group">
                    <label class="checkbox-inline" for="checkbox-1">
                      <input type="checkbox" name="checkbox" id="checkbox-1" value="6">
                        Show only entries with essays</label> 
                  </div>

                  <div class="form-group">                                    
                    <label class="checkbox-inline" for="checkbox-2">
                      <input type="checkbox" name="checkbox" id="checkbox-2" value="7" checked="checked">
                        Show feature details</label>                              
                  </div>
                  
                  
                  
                  
                  <!-- feature tree, under contruction -->
                  <div class="form-group km-input feature-group dropdown">
                        <a href="#" class="feature-toggle toggle-link" data-toggle="dropdown"><i class="icon"></i>Show Features</a>     
                        <span class="filter"><label>Filter:</label> <span id="matches"></span></span>                       

                        
                        <input class="form-control feature-name" id="feature-name" name="features" type="text" placeholder="Filter by Feature Name">  
                                              
                        <div class="dropdown-menu feature-menu">
                            <div class="tree-wrap"> 

                              <div class="feature-container">                             
                                <div id="feature-tree"></div> <!-- features tree, under construction -->                              
                              </div> 
                                                          
                              <div class="feature-submit">
                                <button type="button" class="btn btn-default">Select</button>
                                <button id="btnResetSearch" class="btn btn-default clear-form">Cancel <span>&times;</span></button>
                              </div>
                                                          
                            </div>                      
                        </div> <!-- END dropdown-menu -->
                        
                        <button id="feature-reset" class="feature-reset">&times;</button>
                  </div> <!-- END feature-group -->
                  
                  
                  
                  
                  <div class="form-group km-input">                                   
                      <input class="form-control kms-fsid" id="feature-id" type="text" placeholder="Filter by Feature ID">
                  </div>               
                  
                  <div class="form-group"> 
                        <select class="selectpicker" id="selector1" name="selector1" multiple data-selected-text-format="count" data-header="Select from the following..." data-width="100%">
                          <option>Selector One</option>
                          <option>Selector</option>
                          <option>Selector</option>
                          <option>Selector Text</option>
                          <option>Selector Text Text</option>
                          <option>Selector Very Long Text</option>
                          <option>Selector Very Long Long Text</option>
                          <option>Shorter</option>
                          <option>Shorter</option>
                          <option>Shorter Text</option>
                          <option>Shorter Text Text</option>
                        </select>
                  </div>

               </div>
         </fieldset>
         
       </form>
      </section>  <!-- END search section -->

      <!-- START TABS / View section -->                                  
      <section class="view-section">             
        <ul class="nav nav-tabs">
          <li class="treeview active"><a href=".treeview" data-toggle="tab"><i class="icon km-tree"></i>Tree</a></li>
          <li class="listview"><a href=".listview" data-toggle="tab"><i class="icon km-list"></i>List</a></li>
        </ul>           
        <div class="tab-content">
                          
          <!-- TAB - tree view -->
          <div class="treeview tab-pane active">        
              <div id="tree" class="view-wrap"><!-- view-wrap controls tree container height --></div>              
          </div>          
          <!-- TAB - list view -->
          <div class="listview tab-pane">   
            <div class="view-wrap"> <!-- view-wrap controls container height -->              
              <div class="table-responsive">
                 <table class="table table-condensed table-results">
                  <thead>
                      <tr>
                        <th>Name</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                 </table>                                   
              </div>
            </div>
          </div>
        </div>                        
      </section><!-- END view section -->
  </section><!-- END kmaps-search -->

 

  
  <section id="menu" style="display:none;">
    <nav role="navigation">                
     <ul>
       <li><h3><em>Main Menu</em></h3> 
          <a class="link-blocker"></a>
       </li>
       <li class="myaccount">
          <a href="#">My Account</a>
          <h2>My Account</h2>       
          <ul>
            <li><a href="#">Logout</a></li>  
            <li>
              <a href="#">Edit Account Details</a>              
              <h2>Account Details</h2>               
                 <ul class="myaccount-details">
                  <li><a href="#">Account Settings</a></li>  
                  <li><a href="#">Profile</a></li>   
                  <li><a href="#">Related Link</a></li>
                  <li><a href="#">Another Link</a></li>
                </ul>           
            </li>
            <li><a href="#">Community Networks</a></li>
          </ul>
          
       </li>                  
       <li>
          <a href="#">Preferences</a>
          <h2>Preferences</h2>
          <ul>          
            <!-- header -->              
            <li class="drop-hdr"><em>Perspective</em></li>
              <li class="form-group"><label class="radio-inline" for="option1a">
                <input type="radio" name="option1" id="option1a" value="option1a" checked>General</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option1b">
                <input type="radio" name="option1" id="option1b" value="option1b">Tibetan</label>
              </li>
              <li class="form-group last"></li>
            
            <!-- header -->
            <li class="drop-hdr"><em>Subject Language</em></li>
              <li class="form-group"><label class="radio-inline" for="option2a">
                <input type="radio" name="option2" id="option2a" value="option2a">Chinese Characters (simplified)</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option2b">
                <input type="radio" name="option2" id="option2b" value="option2b">Chinese Characters (traditional)</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option2c">
                <input type="radio" name="option2" id="option2c" value="option2c">Devangiri Script</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option2d">
                <input type="radio" name="option2" id="option2d" value="option2d" checked>Popular Standard (romanization)</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option2e">
                <input type="radio" name="option2" id="option2e" value="option2e">Scholarly Standard (romanization)</label>
              </li>                   
              <li class="form-group"><label class="radio-inline" for="option2f">
                <input type="radio" name="option2" id="option2f" value="option2f">Tibetan Script (simplified)</label>
              </li>                   
              <li class="form-group"><label class="radio-inline" for="option2g">
                <input type="radio" name="option2" id="option2g" value="option2g">Tibetan Script (romanization)</label>
              </li>
              <li class="form-group last"></li>
            
            <!-- header -->
            <li class="drop-hdr"><em>Show Subject Details</em></li>                     
              <li class="form-group"><label class="radio-inline" for="option3a">
                <input type="radio" name="option3" id="option3a" value="option3a" checked>Yes</label>
              </li>
              <li class="form-group"><label class="radio-inline" for="option3b">
                <input type="radio" name="option3" id="option3b" value="option3b">No</label>
              </li>
              <li class="form-group last"></li>
          </ul>                         
        </li>   
         
        <li><a href="#">Help</a></li>
        
        <li><a href="#">Contact Us</a></li>
     </ul>    
    </nav>
  </section><!-- END menu -->
  </div><!-- END wrap-all -->


  <footer class="footer">
    <div>
      <p>&copy; COPYRIGHT 2014</p>
    </div>
  </footer>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript">window.jQuery || document.write('<script src="<?php print $theme_path; ?>/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
  
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/vendor/bootstrap.min.js"></script> 
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/menus/jquery.multilevelpushmenu.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/menus/jquery.jBreadCrumb.1.1.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/extruder/mbExtruder.js"></script><!-- searchpanel(3) --> 
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.fancytree.js"></script><!-- tree -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.fancytree.glyph.js"></script><!-- tree -->  
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.fancytree.filter.js"></script><!-- tree -->

  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.fancytree.edit.js"></script> <!-- is this needed ? -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/equalHeights.js"></script> <!-- sidecolumn resources full-height -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/forms/check/icheck.min.js"></script><!-- forms -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/forms/select/bootstrap-select.min.js"></script><!-- forms -->  
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.highlight.js"></script><!-- highlight -->
  <script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script> <!-- tablesorter -->    
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/src/trunk8.min.js"></script>
  <!-- Hashchange event -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/vendor/jquery.ba-hashchange.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/vendor/bootstrap-paginator.min.js"></script>
  <script src="//vjs.zencdn.net/4.5/video.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/main.js"></script> <!-- kmaps fx -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/kmap_places.js"></script>
  
</body>
</html>
