<div class="wrap-all">
   <span class="sr-only"><a href=".main-content">Skip to main content</a> <a href="#kmaps-search">Skip to search</a></span>
    <!-- Header Region -->
   <header class="header-banner">
    <div class="navbar navbar-default" role="navigation"> 
     
      <nav class="menu-buttons">
        <span class="shanti-searchtoggle menu-icon"><a href="#"><i class='icon shanticon-search'></i></a></span><!-- mobile < 400 : search -->
        <span class="menu-toggle menu-icon"><a href="#"><i class="icon shanticon-menu"></i></a></span><!-- desktop > 768 drilldown menu : main-menu -->
        <span class="menu-maintoggle menu-icon"><a href="#"><i class="icon shanticon-menu"></i></a></span><!-- mobile < 768 : main-menu -->
        <span class="menu-exploretoggle menu-explore"><a href="#"><span>Explore </span>Collections<i class="icon shanticon-directions"></i></a></span><!-- mobile < 768 : collections -->
      </nav>

      <nav class="navbar-header">
        <h1 class="navbar-title<?php if(!$variables['shanti_site']) { print " default"; } ?>">
          <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="<? print $site_name; ?> Homepage">
            <?php if($variables['shanti_site']): ?>
              <i class="icon shanticon-logo"></i><em>SHANTI</em>
            <?php else: ?>
              <img src="<?php print $logo; ?>" class="site-logo" /> <span class="site-title"><?php print $site_name; ?></span>
            <?php endif; ?>
            <?php if($site_slogan) { print '<span class="site-slogan">' . $site_slogan . '</span>' ;} ?>
          </a>
        </h1>
      </nav>  
      <!-- HEADER REGION -->
      <nav id="sarvaka-header" class="region navbar-collapse collapse navtop"> <!-- desktop display > 768 -->
         <form class="form">
         <fieldset>         
          <ul class="nav navbar-nav navbar-right">
            <?php if(module_exists('explore_menu')): ?>
              <li id="collexplink" class="explore closed"><a href="#"><?php print $variables['explore_menu_link']; ?> 
                <i class="icon shanticon-directions"></i></a></li>
            <?php endif; ?>
            <?php  if(isset($variables['language_switcher'])) { print $variables['language_switcher']; }  ?>
            <!-- TODO: Need to hardcode user menu/options here as well -->
            <!-- If admin puts blocks in  header, render here -->
            <?php print render($page['header']);  ?>
          </ul>
         </fieldset>  
         </form>           
       </nav>
       <!-- End of HEADER region -->
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
              <nav class="breadwrap" role="navigation">
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
        </div> <!-- End of Banner Region -->
        
        <div class="row row-offcanvas row-offcanvas-right">
          <!-- Message Area -->
          <?php if (isset($messages)) { ?><section class="messages"><?php print $messages; ?></section> <?php } ?>
          <!-- Sidebar First Region -->
          <?php if ($page['sidebar_first']): ?>
            <div id="sidebar-first" class="region sidebar sidebar-offcanvas col-xs-6 <?php print $bsclass_sb1; ?>">
              <?php print render($page['sidebar_first']); ?>
            </div>
          <?php endif; ?>
          
          <!-- Begin Page Content -->
          <section class="content-section <?php print $bsclass_main; ?>"> 
            <div class="tab-content">
              <article class="tab-pane main-col active" id="tab-overview">
                 <?php print render($page['content']); ?>
              </article>
            </div>
          </section>
          <!-- END Content -->
          
          <!-- Sidebar Second Region -->
          <?php if ($page['sidebar_second']): ?>
            <div id="sidebar-second" class="region sidebar pull-right sidebar-offcanvas col-xs-6 <?php print $bsclass_sb2; ?>">
              <?php print render($page['sidebar_second']); ?>
            </div>
          <?php endif; ?>
        </div>
        <a href="#" class="back-to-top"><i class="icon"></i></a>
      </article>


    
		  <!-- Search Flyout -->
		  <?php 
		    if($page['search_flyout']) {
		      print render($page['search_flyout']);
		    }
		  ?>

    </main> <!-- End Main Content -->

    
  <!-- LOAD menus -->
  <section id="menu-main" role="navigation" class="{ url:'<?php print $theme_path; ?>/js/menus/menu-ajax.php'} menu-accordion">   </section>  
  <section id="menu-collections" role="navigation" class="{ url:'<?php print $theme_path; ?>/js/menus/menu-ajax.php'} menu-accordion">    </section>

  <section id="menu" role="navigation" style="display:none;">
    <nav id="menu-drill">                
     <?php print $variables['user_menu_links']; ?>
    </nav>
  </section><!-- END menu -->
</div> <!-- End wrap-all -->

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
