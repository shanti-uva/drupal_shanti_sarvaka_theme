<div class="wrap-all">
   <a href=".main-content" class="sr-only">
    Skip to main content</a>
    <!-- Header Region -->
   <header class="header-banner">
    <div class="navbar navbar-default navbar-static-top" role="navigation"> 
      <!-- Need Mark to implement this for mobile devices (????)
      <nav class="menu-buttons">
        <!-- <span class="kmaps-searchtoggle menu-icon"><a href="#"><i class="icon km-search-kmaps"></i></a></span><!-- mobile < 400 : search -->
        <!-- <span class="menu-toggle menu-icon"><a href="#"><i class="icon km-menu"></i></a></span><!-- desktop > 768 drilldown menu : main-menu -->
        <!-- <span class="menu-maintoggle menu-icon"><a href="#"><i class="icon km-menu"></i></a></span><!-- mobile < 768 : main-menu -->
        <!-- <span class="menu-exploretoggle menu-explore"><a href="#"><span>Explore </span>Collections<i class="icon km-directions"></i></a></span><!-- mobile < 768 : collections -->
      <!-- </nav>-->
      <nav class="navbar-header">
        <h1 class="navbar-title">
          <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="SHANTI Homepage">
            <i class="icon shanticon-logo"></i><em>SHANTI</em>
            <span><?php print $site_slogan; ?></span>
          </a>
        </h1>
      </nav>  
      <nav class="navbar-collapse collapse navtop"> <!-- desktop display > 768 -->
         <form class="form">
         <fieldset>         
          <ul class="nav navbar-nav navbar-right">
            <?php if(module_exists('explore_menu')): ?>
              <li id="collexplink" class="explore closed"><a href="#"><?php print $variables['explore_menu_link']; ?> 
                <i class="icon shanticon-explore"></i></a></li>
            <?php endif; ?>
            <?php  if(isset($variables['language_switcher'])) { print $variables['language_switcher']; }  ?>
            <!-- TODO: Need to hardcode user menu/options here as well -->
            
            <?php print render($page['header']);  ?>
          </ul>
         </fieldset>  
         </form>           
       </nav>
       
     </div>
     
     <!-- include shanti-explore-menu if it exists -->
     <?php if(module_exists('explore_menu')) { print render($variables['explore_menu']); } ?>
    
    </header>
    <main class="main-wrapper container">
      <article class="main-content" role="main">
        <div class="row">
          <!-- Banner Region -->
          <header class="col-sm-12 titlearea banner">
           <div role="banner">
            <h1 class="page-title"><i class="icon shanticon-<?php print $variables['icon_class']; ?>"></i><span><?php 
              print ($title == '')? $variables['default_title']:$title; ?></span></h1>
              <nav class="breadcrumbs-wrapper" role="navigation">
                <?php print shanti_sarvaka_get_breadcrumbs($variables); ?>
              </nav>
              <div class="banner-content">
                <?php print render($page['banner']); ?>
              </div>
              <?php 
                // For view/edit tabs
                print render($tabs); 
              ?>
            </div>
          </header>
          <!-- Message Area -->
          <?php if (isset($messages)) { ?><section class="messages"><?php print $messages; ?></section> <?php } ?>
          
          <!-- Begin Page Content -->
          <section class="content-section col-xs-12"> <!-- had col-sm-9 (ndg, 2014-06-06) -->
            <div class="tab-content">
              <article class="tab-pane main-col active" id="tab-overview">
                 <?php print render($page['content']); ?>
              </article>
            </div>
          </section>
          <!-- END Content -->
          
        </div>
        <a href="#" class="back-to-top" style="display: inline;"><i class="icon"></i>Top</a>
      </article>
    </main> <!-- End Main Content -->
    <!-- Search Flyout -->
    <?php print render($page['search_flyout']); ?>
    
</div> <!-- End of class="wrap" -->

<!-- Footer -->
<footer class="footer">
  <div>
    <p>© COPYRIGHT 2014</p>
    <?php print render($page['footer']); ?>
  </div>
</footer>

<!-- Admin Footer -->
<div id="admin_footer">
  <?php print render($page['admin_footer']); ?> 
</div>
