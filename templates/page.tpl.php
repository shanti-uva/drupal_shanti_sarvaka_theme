<div class="wrap-all">
   <span class="sr-only"><a href=".main-content">Skip to main content</a> <a href="#kmaps-search">Skip to search</a></span>
    <!-- Header Region -->
   <header class="header-banner">
    <div class="navbar navbar-default" role="navigation">

	      <nav class="navbar-buttons">
	        <span class="menu-icon shanti-searchtoggle"><a href="#"><span class='icon shanticon-search'></span></a></span><!-- mobile < 400 : search -->
	        <span class="menu-icon menu-toggle"><a href="#"><span class="icon shanticon-menu"></span></a></span><!-- desktop > 768 drilldown menu : main-menu -->
	        <span class="menu-icon menu-maintoggle"><a href="#"><span class="icon shanticon-menu"></span></a></span><!-- mobile < 768 : main-menu -->
	        <span class="menu-explore menu-exploretoggle"><a href="#"><span>Explore</span><span class="icon shanticon-directions"></span></a></span><!-- mobile < 768 : collections -->
	      </nav>

	      <h1 class="navbar-header<?php if(!$variables['shanti_site']) { print " default"; } ?>">
	        <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="<?php print $site_name; ?> Homepage">
	          <?php if($variables['shanti_site']): ?>
	            <span class="icon shanticon-logo"></span><em>SHANTI</em><?php if($variables['use_admin_site_title']) {
		            	print "<span class=\"site-title\">{$site_name}</span>";
		            } ?>
	          <?php else: ?>
	            <img src="<?php print $logo; ?>" class="site-logo" /> <span class="site-title"><?php print $site_name; ?></span>
	          <?php endif; ?>
	          <?php if($site_slogan) { print '<span class="site-slogan">' . $site_slogan . '</span>' ;} ?>
	        </a>
	      </h1>

	      <!-- HEADER REGION -->
	      <nav id="sarvaka-header" class="region navbar-collapse collapse navtop"> <!-- desktop display > 768 -->
	         <form class="form">
	         <fieldset>
	          <ul class="nav navbar-nav navbar-right">
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


    <!-- Begin Content Region -->
    <main class="main-wrapper container-fluid">
      <article class="main-content" role="main">
        <div class="row">

          <!-- Banner Region -->
          <header class="col-xs-12 titlearea banner<?php print $variables['banner_class']; ?>">
           <div role="banner">
            <h1 class="page-title"><span class="icon shanticon-<?php print $variables['icon_class']; ?>"></span><span class="page-title-text
            "><?php
            	if(!empty($variables['default_title']) && !empty($variables['prefix_default_title'])) {
            		print ($title == '')? $variables['default_title'] : $variables['default_title'] . ': ' . $title;
            	} else {
            		print ($title == '')? $variables['default_title']:$title;
            	}
              ?></span></h1>
              <nav class="breadwrap" role="navigation">
                <?php print theme('breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
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

        </div> <!-- End of Banner Row -->


        <!-- Begin Content Row -->
        <div class="row row-offcanvas row-offcanvas-left">

          <!-- Sidebar First Region -->
          <?php if ($page['sidebar_first']): ?>
            <div id="sidebar-first" class="region sidebar col-xs-6 <?php print $bsclass_sb1; ?>">
              <?php print render($page['sidebar_first']); ?>
            </div>
          <?php endif; ?>

          <!-- Begin Page Content -->
          <section class="content-section col-xs-12<?php if (!empty($bsclass_main)) { print ' ' . $bsclass_main; } ?>">
          <!-- Message Area -->
          <?php if (!empty($messages)) { print "<div class=\"messages\">$messages</div>"; } ?>
            <div class="tab-content">
              <article class="tab-pane main-col active" id="tab-overview">
              	 <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
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

        <a href="#" class="back-to-top"><span class="icon fa"></span></a>
      </article>

		  <!-- Search Flyout -->
		  <?php if(!empty($page['search_flyout'])): ?>
		      <!--print render($page['search_flyout']); -->
				<div id="search-flyout" class="region extruder right" role="search" style="display: none;">
				   <?php print render($page['search_flyout']); ?>
				</div>
	    <?php endif; ?>

    </main> <!-- End Main Content -->


  <!-- LOAD menus -->
  <section id="menu-main" class="menu-main-mobile { url:'<?php if(!empty($base_theme_path)) { print $base_theme_path; } else { print $theme_path; } ?>js/inc/menus/menu-ajax.php'} menu-accordion"> </section>
  <section id="menu-collections" class="menu-collections-mobile { url:'<?php if(!empty($base_theme_path)) { print $base_theme_path; } else { print $theme_path; } ?>js/inc/menus/menu-ajax.php'} menu-accordion"> </section>

  <section id="menu" class="menu-main-desk" style="display:none;">
    <nav id="menu-drill" role="navigation">
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
<div id="admin-footer">
  <?php print render($page['admin_footer']); ?>
</div>




