 <div class="wrap-all">
   <a href=".main-content" class="sr-only">
    Skip to main content</a>
   <?php print render($page['header']); ?>
  <!-- BEGIN content -->
  <main class="main-wrapper container">
    <article class="main-content" role="main">
      <div class="row">
        <header class="col-sm-12 titlearea">
         <div role="banner">
          <h1 class="page-title"><i class="icon km-audiovideo"></i><span><?php print ($title == '')? $variables['default_title']:$title; ?></span></h1>
            <nav class="breadcrumbs-wrapper" role="navigation">
              <?php print shanti_sarvaka_get_breadcrumbs($variables); ?>
            </nav>
            <?php print render($tabs); ?>
          </div>
        </header>
        <?php if (isset($messages)) { ?><section class="messages"><?php print $messages; ?></section> <?php } ?>
        <section class="content-section col-xs-12"> <!-- had col-sm-9 (ndg, 2014-06-06) -->
          <div class="tab-content">
            <article class="tab-pane main-col active" id="tab-overview">
               <?php print render($page['content']); ?>
            </article>
            <!-- END tab-pane active -->
            <!-- Example for second tab. Question: how do we do tabs in Drupal templates?
            <article class="tab-pane main-col" id="tab-related">
              <h6>Essays</h6>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
            </article>
            -->
          </div>
        </section>
      </div>
      <a href="#" class="back-to-top" style="display: inline;"><i class="icon"></i>Top</a>
    </article>
  </main> <!-- End Main Content -->
  <?php print render($page['search_flyout']); ?>
 </div> <!-- End of class="wrap" -->
<?php print render($page['footer']); ?>

<div id="admin_footer">
  <?php print render($page['admin_footer']); ?> 
</div>
