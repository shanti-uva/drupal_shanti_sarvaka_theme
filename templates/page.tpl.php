 <div class="wrap">
   <a href=".main-content" class="sr-only">
    Skip to main content</a>
   <?php print render($page['header']); ?>
  <!-- BEGIN content -->
  <main class="container-fluid" role="main">
    <article class="row main-content">
      <header class="col-sm-12 titlearea">
       <div>
        <h1 class="page-title"><i class="icon km-places"></i><span><?php print ($title == '')? $variables['default_title']:$title; ?></span></h1>
          <nav class="breadcrumbs-wrapper" role="navigation">
            <?php print shanti_sarvaka_get_breadcrumbs($variables); ?>
          </nav>
        </div>
      </header>
      <?php if (isset($messages)) { ?><section class="messages"><?php print $messages; ?></section> <?php } ?>
      <section class="col-sm-10 content-section">
        <div class="tab-content">
          <article class="tab-pane active" id="tab-overview">
            <?php print render($page['content']); ?>
          </article>
        </div>
      </section>
      <a href="#" class="back-to-top" style="display: inline;"><i class="icon"></i>Top</a>
    </article>
  </main> <!-- End Main Content -->
  <?php print render($page['search_flyout']); ?>
 </div> <!-- End of class="wrap" -->
<?php print render($page['footer']); ?>

<div id="admin_footer">
  <?php print render($page['admin_footer']); ?> 
</div>
