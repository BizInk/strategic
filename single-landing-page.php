<?php

// Require below variable for change value from db

// Require below library for compile
require "page-templates/scss.inc.php";

$scss = new scssc();

$output_file =  get_stylesheet_directory().'/css/stylesheet.css';
$path = get_stylesheet_directory().'/src/sass/settings.scss';

// $compiled_css = $scss->compile('
//  @import "variables";
//  @import "normal";
// ');


$global_theme_color1 = get_field('global_theme_color1', 'option') ? get_field('global_theme_color1', 'option') : '#0d6efd';
$global_theme_color2 = get_field('global_theme_color2', 'option') ? get_field('global_theme_color2', 'option') : '#212121';
$global_theme_color3 = get_field('global_theme_color3', 'option') ? get_field('global_theme_color3', 'option') : '#ffffff';
$global_theme_color4 = get_field('global_theme_color4', 'option') ? get_field('global_theme_color4', 'option') : '#52647c';
$global_theme_color5 = get_field('global_theme_color5', 'option') ? get_field('global_theme_color5', 'option') : '#eaeaea';
$global_theme_color6 = get_field('global_theme_color6', 'option') ? get_field('global_theme_color6', 'option') : '#D1DBE3';
$global_theme_color7 = get_field('global_theme_color7', 'option') ? get_field('global_theme_color7', 'option') : '#e6f0ff';


$compiled_css = $scss->compile('
  $primary: '.$global_theme_color1.';
  $dark: '.$global_theme_color2.';
  $white: '.$global_theme_color3.';
  $neutral-blue: '.$global_theme_color4.';
  $light-grey: '.$global_theme_color5.';
  $light-blue: '.$global_theme_color6.';
  $neutral-light-blue: '.$global_theme_color7.';
  

  @import "'.$path.'";
');

  //echo '<pre>';
  //echo $compiled_css;

file_put_contents($output_file, $compiled_css);

 //echo 'File Compiled & Saved!';


get_header();


?>
<?php
if( have_rows('page_flexible_content') ): 
  while( have_rows('page_flexible_content') ): the_row();
    if( get_row_layout() == 'info_box' ):
        get_template_part('page-templates/template-parts/info-box');
      elseif( get_row_layout() == 'hero_section' ):
        get_template_part('page-templates/template-parts/hero-section');
      elseif( get_row_layout() == 'two_column' ):
        get_template_part('page-templates/template-parts/two-column');
      elseif( get_row_layout() == 'logo' ):
        get_template_part('page-templates/template-parts/logo');       
      elseif( get_row_layout() == 'counter' ):
        get_template_part('page-templates/template-parts/counter');
      elseif( get_row_layout() == 'form-block' ):
        get_template_part('page-templates/template-parts/form-block');
      elseif( get_row_layout() == 'call_to_action' ):
          get_template_part('page-templates/template-parts/call-to-action');
      elseif( get_row_layout() == 'testimonial_section' ):
          get_template_part('page-templates/template-parts/testimonial');
      elseif( get_row_layout() == 'full_width_section' ):
          get_template_part('page-templates/template-parts/full-width');
      elseif( get_row_layout() == 'pricing' ):
          get_template_part('page-templates/template-parts/pricing');
      elseif( get_row_layout() == 'sign_up' ):
          get_template_part('page-templates/template-parts/sign-up');
      elseif( get_row_layout() == 'get_to_know_section' ):
          get_template_part('page-templates/template-parts/get-to-know-section');
     
    endif;  
  endwhile;
endif;  
?>
<?php
get_footer();
?>