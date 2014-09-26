<?php

  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     $pageURL = htmlspecialchars( filter_var( $pageURL, FILTER_SANITIZE_URL ) );
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file); 
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#sg-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $documentation = 'doc/'.$type.'/'.$file;
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h2 class="sg-h2"><a id="sg-'.$filename.'" class="sg-anchor">'.$title.'</a></h2>';
        if (file_exists($documentation)) {
          echo '<div class="sg-doc">';
          echo '<h3 class="sg-h3">Usage</h3>';
          include($documentation);
          echo '</div>';
        }
        echo '<h3 class="sg-h3">Example</h3>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a> <a class="sg-btn--top" href="#top">Back to Top</a> </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>Style Guide Boilerplate</title>
  <meta name="viewport" content="width=device-width">
  <script type="text/javascript" src="/sites/all/modules/contrib/jquery_update/replace/jquery/1.10/jquery.min.js?v=1.10.2"></script>
  <script type="text/javascript" src="/sites/all/themes/shanti_sarvaka/js/vendor/bootstrap.min.js?n8ic4w"></script>
  <link rel="shortcut icon" href="/sites/all/themes/shanti_sarvaka/favicon.ico" type="image/vnd.microsoft.icon" >
  <!-- Style Guide Boilerplate Styles -->
  <link rel="stylesheet" href="css/sg-style.css">
  
  <!-- Custom Styles for Style Guide -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Styles from theme -->
  <style type="text/css" media="all">
  	@import url("/sites/all/themes/shanti_sarvaka/css/bootstrap.min.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/bootstrap-theme.min.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/utils.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/vjs.zencdn.nt-5.4-video-js.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/shanti-main.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/shanti-main-mb.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/shanti-search.css");
		@import url("/sites/all/themes/shanti_sarvaka/css/shanti-search-mb.css");
		@import url("/sites/all/themes/shanti_sarvaka/fonts/shanticon/css/style.css");
</style>
</head>
<body>
<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo"><span>Shanti Convoy Design</span> STYLE GUIDE (Shanti Sarvaka Theme)</h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="filter-list form-control form-select ss-select" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Font-Stacks</option>
        </optgroup>
        <optgroup label="Base Styles">
          <?php listMarkupAsOptions('base'); ?>
        </optgroup>
        <optgroup label="Pattern Styles">
          <?php listMarkupAsOptions('patterns'); ?>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container">
  <div class="sg-info">               
    <div class="sg-about sg-section">
      <h2 class="sg-h2"><a id="sg-about" class="sg-anchor">About</a></h2>
      <p>This is the style guide for implementing Shanti websites a la the Convoy design and describes the styles used in the Shanti Sarvaka Drupal theme. It is a work in progress.</p>
    </div><!--/.sg-about-->
    
    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Font Stacks</a></h2>
      <p class="sg-font sg-font-primary">"Museo Sans", "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;</p>
      <p class="sg-font sg-font-secondary">Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif;</p>
      <p><strong>Font Sizes: Use percentages to make font sizes larger or smaller</strong> if it is not more appropriate to use the "em" measurement.</p> 
      <p><strong>Please do not use</strong> the following font sizes in your css - these are not reliable.</p>
        <ul>
          <li>font-size: xx-small  /* absolute-size values */</li>
          <li>font-size: x-small</li>
          <li>font-size: small</li>
          <li>font-size: medium</li>
          <li>font-size: large</li>
          <li>font-size: x-large</li>
          <li>font-size: xx-large</li>
          <li>font-size: larger    /* relative-size values */</li>
          <li>font-size: smaller</li>
        </ul>
      <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->    


  <div class="sg-base-styles">    
    <h1 class="sg-h1">Base Styles</h1>
    <?php showMarkup('base'); ?>
  </div><!--/.sg-base-styles-->

  <div class="sg-pattern-styles">
    <h1 class="sg-h1">Pattern Styles<small> - Design and mark-up patterns unique to your site.</small></h1>
    <?php showMarkup('patterns'); ?>
    </div><!--/.sg-pattern-styles-->
  </div><!--/.sg-body-->

    
    <div class="sg-colors sg-section">
      <h2 class="sg-h2"><a id="sg-colors" class="sg-anchor">Colors</a></h2>
      <p>HTML Colors based on the color palette provided by Convoy.</p>
        <table id="palette">
          <tbody>
            <tr>
              <td>
                <div class="sg-color sg-color--a1 main"><span class="sg-color-swatch"><span class="sg-animated">#da3e4a</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--a2 main"><span class="sg-color-swatch"><span class="sg-animated">#a37ffc</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--b1 main"><span class="sg-color-swatch"><span class="sg-animated">#ab4179</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--b2 main"><span class="sg-color-swatch"><span class="sg-animated">#84579d</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--c1 main"><span class="sg-color-swatch"><span class="sg-animated">#db6375</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--c2 main"><span class="sg-color-swatch"><span class="sg-animated">#31459e</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--d1 main"><span class="sg-color-swatch"><span class="sg-animated">#fb8d41</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--d2 main"><span class="sg-color-swatch"><span class="sg-animated">#51a8f8</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--e1 main"><span class="sg-color-swatch"><span class="sg-animated">#fdb443</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--e2 main"><span class="sg-color-swatch"><span class="sg-animated">#158ea6</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--f1 main"><span class="sg-color-swatch"><span class="sg-animated">#c4be27</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--f2 main"><span class="sg-color-swatch"><span class="sg-animated">#3cccca</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="sg-color sg-color--g1 main"><span class="sg-color-swatch"><span class="sg-animated">#7eb822</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
              <td>
                <div class="sg-color sg-color--g2 main"><span class="sg-color-swatch"><span class="sg-animated">#27bd65</span></span></div>
                <div class="sg-color sg-color--dark"><span class="sg-color-swatch"><span class="sg-animated">#39373f</span></span></div>
                <div class="sg-color sg-color--link"><span class="sg-color-swatch"><span class="sg-animated">#5b68ce</span></span></div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-colors-->

  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>
</body>
</html>
 