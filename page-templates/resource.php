<?php
/**
* Template Name: Resource
*
* Template to display listing of team members page
*
* @package Understrap
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part('global-templates/inner-banner');

$topics = get_terms([
  'taxonomy' => 'content-topic', 
  'hide_empty' => true, 
]);

$types = get_terms([
  'taxonomy' => 'content-type', 
  'hide_empty' => true, 
]);
?>

<section class="infobox-section checklist-infobox content-topic-section comman-padding">

    <?php if( !empty($topics) ){ ?>

        <div class="container mb-5">
            <div class="resources-filter resources-filter-topic">
                <h4>Select Content Topic</h4>
                <span class="d-flex justify-content-between align-items-center d-md-none dropdown">Select</span>
                <ul>
                    <li class="active" data-cat="">ALL</li>
                    <?php foreach( $topics as $topic ){ ?>

                        <li data-cat="<?= $topic->term_id; ?>"><?= $topic->name; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>

    <?php if( !empty($types) ){ ?>

        <div class="container mb-5">
            <div class="resources-filter resources-filter-type">
                <h4>Select Content Type</h4>
                <span class="d-flex justify-content-between align-items-center d-md-none dropdown">Select</span>
                <ul>
                    <li class="active" data-cat="">ALL</li>
                    <?php foreach( $types as $type ){ ?>

                        <li data-cat="<?= $type->term_id; ?>"><?= $type->name; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>

    <div class="container">

        <div class="infobox-warp resources-cont">
            Loading...
        </div>
    </div>
</section>

<?php
get_footer(); ?>