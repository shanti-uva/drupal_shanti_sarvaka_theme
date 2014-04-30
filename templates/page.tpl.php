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
      <section class="col-sm-10 content-section">
        <div class="tab-content">
          <article class="tab-pane active" id="tab-overview">
            <?php print render($page['content']); ?>
          </article>
        </div>
      </section>
    </article>
  </main> <!-- End Main Content -->
  <!-- Search Tab -->
  <section id="gen-search" class="extruder right" >
      <div class="text ui-resizable" >               
      <!-- BEGIN input section -->                    
      <section class="input-section" style="display: block;">      <p>Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus.
        </p>  </section></div></section>
<!-- End of Search Tab -->
 </div> <!-- End of class="wrap" -->
