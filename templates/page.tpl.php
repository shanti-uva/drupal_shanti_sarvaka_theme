 <div class="wrap-all">
   <a href=".main-content" class="sr-only">
    Skip to main content</a>
    <!-- Header Region -->
 <header class="header-banner">
  <div class="navbar navbar-default navbar-static-top" role="navigation"> 
    <div class="menu-buttons" role="navigation">
      <?php print render($page['header']); ?>
    </div>
    <nav class="navbar-header">
      <h1 class="navbar-title">
        <a href="<?php print $variables['home_url']; ?>" class="navbar-brand" title="SHANTI Homepage">
          <i class="icon shanticon-logo"></i><em>SHANTI</em>
          <span><?php print $site_slogan; ?></span>
        </a>
      </h1>
    </nav>  
  </header>
  <main class="main-wrapper container">
    <article class="main-content" role="main">
      <div class="row">
        <!-- Banner Region -->
        <header class="col-sm-12 titlearea">
         <div role="banner">
          <h1 class="page-title"><i class="icon shanticon-<?php print $variables['icon_class']; ?>"></i><span><?php 
            print ($title == '')? $variables['default_title']:$title; ?></span></h1>
            <nav class="breadcrumbs-wrapper" role="navigation">
              <?php print shanti_sarvaka_get_breadcrumbs($variables); ?>
            </nav>
            <div class="banner-content">
              <?php print render($page['banner']); ?>
            </div>
            <?php print render($tabs); ?>
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
