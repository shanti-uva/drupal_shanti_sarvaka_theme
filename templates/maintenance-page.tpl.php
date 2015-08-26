<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head> <!-- head had attribute: profile="<?php print $grddl_profile; ?>" -->
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $modernizer; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <!--[if lte IE 8]><p class="progressive">It appears you are using an older browser. Please consider a upgrading to a modern version of your browser to best enjoy this website.</p><![endif]-->
  <!-- Code from Shanti Sarvaka page.tpl.php -->
	<div class="wrap-all">
	    <!-- Header Region -->
	   <header class="header-banner">
	    <div class="navbar navbar-default">
	
		      <h1 class="navbar-header default">
		        <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="<?php print $site_name; ?> Homepage">
		          <img src="<?php print $logo; ?>" class="site-logo" /> <span class="site-title"><?php print $site_name; ?></span>
		          <?php if($site_slogan) { print '<span class="site-slogan">' . $site_slogan . '</span>' ;} ?>
		        </a>
		      </h1>
	
		      <!-- HEADER REGION -->
		      <nav id="sarvaka-header" class="region navbar-collapse collapse navtop" role="navigation"> <!-- desktop display > 768 -->
		         <form class="form">
		         <fieldset>
		          <ul class="nav navbar-nav navbar-right">
			            <!-- If admin puts blocks in  header, render here -->
			            <?php print $header;  ?>
		          </ul>
		         </fieldset>
		         </form>
		       </nav>
		       <!-- End of HEADER region -->
	     </div>
	     <!-- include shanti-explore-menu if it exists -->
	    </header>
	
	
	    <!-- Begin Content Region -->
	    <main class="main-wrapper container-fluid">
	      <article class="main-content" role="main">
	        <div class="row">
	
	          <!-- Banner Region -->
	          <header class="col-xs-12 titlearea banner">
	           <div role="banner">
	            <h1 class="page-title"><span class="icon shanticon-<?php print $icon_class; ?>"></span><span class="page-title-text">
	            <?php print $title;
	              ?></span></h1>
	              <div class="banner-content">
	                <?php print $banner; ?>
	              </div>
	            </div>
	          </header>
	
	        </div> <!-- End of Banner Row -->
	
	
	        <!-- Begin Content Row -->
	        <div class="row row-offcanvas row-offcanvas-left">
	
	          <!-- Sidebar First Region -->
	          <?php if ($sidebar_first): ?>
	            <div id="sidebar-first" class="region sidebar<?php print " $bsclass_sb1"; ?>">
	              <?php print $sidebar_first; ?>
	            </div>
	          <?php endif; ?>
	
	          <!-- Begin Page Content -->
	          <section class="content-section col-xs-12<?php if (!empty($bsclass_main)) { print " $bsclass_main"; } ?>">
		        
			        <button type="button" class="btn btn-default view-resources" data-toggle="offcanvas" style="display:none;">
		            <span class="icon"></span>
		          </button>
	          
	          	<!-- Message Area -->
	          	<?php if (!empty($messages)) { print "<div class=\"messages\">$messages</div>"; } ?>
	          	
	          	<!-- Main Content -->
	            <div class="tab-content">
	              <article class="tab-pane main-col active" id="tab-overview">
	              	 <?php print $content; ?>
	              </article>
	            </div>
	          </section>
	          <!-- END Content -->
	
	          <!-- Sidebar Second Region -->
	          <?php if ($sidebar_second): ?>
	            <div id="sidebar-second" class="region sidebar pull-right sidebar-offcanvas<?php print " $bsclass_sb2"; ?>">
	              <?php print $sidebar_second; ?>
	            </div>
	          <?php endif; ?>
	        </div>
	
	        <a href="#" class="back-to-top"><span class="icon fa"></span></a>
	      </article>
	
			  <!-- Search Flyout -->
			  <?php if(!empty($search_flyout)): ?>
			      <!--print render($page['search_flyout']); -->
					<div id="search-flyout" class="region extruder right" role="search" style="display: none;">
					   <?php print $search_flyout; ?>
					</div>
		    <?php endif; ?>
	
	    </main> <!-- End Main Content -->
	
	
	</div> <!-- End wrap-all -->
	
	<!-- Footer -->
	<footer class="footer">
	  <div>
	    <p>&copy; Copyright 2015</p>
	    <?php print $footer; ?>
	  </div>
	</footer>
	
	<!-- Admin Footer -->
	<div id="admin-footer">
	  <?php print $admin_footer; ?>
	</div>
	
</body>
</html>
