# Starter Kit for a Sub-Theme of the Shanti Sarvaka Theme

This folder should be used to create a sub-theme for the Shanti Sarvaka theme. 
The folder should be copied into the sites .../sites/all/themes/ folder and renamed from STARTERKIT to the name of the sub-theme
Within this folder there are several files that have STARTERKIT as part of the name.
Each instance of "STARTERKIT" should be replaced with your sub-theme's name.

The following items should replace "STARTERKIT" with the sub-theme's name:

* Name of the STARTERKIT folder
* STARTERKIT.info (as well as settings in this file for the following files and the file names themselves):
* shanti-main-STARTERKIT.css
* shanti-search-STARTERKIT.css
* shanti-main-STARTERKIT.js
* shanti-search-STARTERKIT.js
* Name of form alter function (STARTERKIT_form_system_theme_settings_alter) in theme-settings.php

# Custom Theme Colors

Child themes should add the following CSS to the top of their custom CSS (shanti-main-....css) file as following, 
changing the color code #32ccca (which is Mediabase's color) to the site's custom color:

```
/* custom theme colors */
.titlearea {background: #32ccca; } 
.basebg { background-color: #32ccca; } 
.basecolor { color: #32ccca; }   
ul.ss-full-tabs>li.active>a:after {
  border-color: #32ccca;
  border-top-color: #32ccca;
} 
i.thumbtype { background-color: rgba(50,204,202, 0.8); }
.breadwrap ol li .icon{ background:#32ccca;}
.ss-full-tabs.nav-tabs>li.active,
.ss-full-tabs.nav-tabs>li.active:hover{ background:#32ccca;}
.shanticon-twitter,.shanticon-facebook,.shanticon-email,.shanticon-google{ color:#32ccca;}

```

Since i.thumbtype uses an alpha setting one has to convert the color Hex Code to RGBA (see e.g. http://www.javascripter.net/faq/hextorgb.htm)


