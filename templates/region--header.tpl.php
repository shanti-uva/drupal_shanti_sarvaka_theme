<header role="banner">
    <div class="navbar navbar-default navbar-static-top" role="navigation"> 
      <nav class="navbar-header" role="navigation">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navtop">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>        
      </nav>      
      <h1 class="navbar-title"><a href="" class="navbar-brand" title="SHANTI homepage link">
        <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="SHANTI homepage link"><img 
          src="<?php print $variables['theme_path']; ?>/images/shanti_logo.png" alt="shanti logo"> 
          <span> <span class="hidden">SHANTI</span><?php print $site_slogan; ?></span></a></h1>  
          <nav class="navbar-collapse collapse navtop" role="navigation"><?php echo $content; ?></nav>            
      <!--<nav class="navbar-collapse collapse navtop" role="navigation">
        <form role="form" class="form">
          <fieldset>      
            <ul class="nav navbar-nav navbar-right"><li class="explore"><a href="#">Explore Collections<i class="icon km-directions"></i></a></li>
              <li class="dropdown lang">                    
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
              <li class="menu-toggle">
                  <a href="#"><i class="icon km-menu"></i></a>
              </li>
            </ul>
          </fieldset>
          
          <ul class="language-switcher-locale-url"><li class="zh-hans first"><a href="/zh-hans" class="language-link" lang="zh-hans">简体中文</a></li>
<li class="en active"><a href="/" class="language-link active" lang="en">English</a></li>
<li class="bo last"><a href="/bo" class="language-link" lang="bo">Tibetan</a></li>
</ul>
        </form>
      </nav>
    </div> <!-- End of Navbar -->
    <!--
  <section class="row collections collapse opencollect">
    <nav class="container-fluid" role="navigation"> 
       <div class="col-sm-8 col-sm-offset-2">          
          <h4>EXPLORE COLLECTIONS</h4>
          <div class="four-collections">
            <div class="col-sm-3">
              <ul>
                <li><a href="#"><i class="icon km-subjects"></i>Subjects</a></li>
                <li><a href="#"><i class="icon km-places"></i>Places</a></li>
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
</header>