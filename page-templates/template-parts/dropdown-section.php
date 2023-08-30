<?php 
$dropdown_bg = get_sub_field('dropdown_bg');
$dropdown_title = get_sub_field('dropdown_title');
$dropdown_config_1 = get_sub_field('dropdown_config_1');
$dropdown_config_2 = get_sub_field('dropdown_config_2'); 

if( !empty($dropdown_config_1) && !empty($dropdown_config_2) ){

    $main_array = array();

    while( have_rows('dropdown_1', 'options') ){
        the_row();

        $dropdown_1_value = get_sub_field('dropdown_1_value');

        $main_array['dropdown1'][] = $dropdown_1_value;
    }

    while( have_rows('dropdown_2', 'options') ){
        the_row();

        $dropdown_2_value = get_sub_field('dropdown_2_value');

        $main_array['dropdown2'][] = $dropdown_2_value;
    }

    while( have_rows('dropdown_links') ){
        the_row();

        $link_1_value = get_sub_field('link_1_value');
        $link_2_value = get_sub_field('link_2_value');
        $dropdown_link = get_sub_field('dropdown_link');

        $main_array['dropdownlinks'][] = array('link_1_value' => $link_1_value, 'link_2_value' => $link_2_value, 'dropdown_link' => $dropdown_link);
    }
/*
    echo '<pre>';
        print_r($main_array);
    echo '</pre>'; */

    if( !empty($main_array['dropdownlinks']) ){ ?>

        <section class="help-section comman-padding overlay"<?php if( !empty($dropdown_bg) ){ ?> style="background-image:url(<?php echo $dropdown_bg; ?>);"<?php } ?>>
            <div class="container">
                <?php if( !empty($dropdown_title) ){ ?>

                    <div class="editor-design">
                        <h2><?= $dropdown_title; ?></h2>
                    </div>
                <?php } ?>

                <div class="dropdown-full-wrap">

                    <div class="dropdown-single-wrap">
                        <h3 class="green"><?= $dropdown_config_1; ?></h3>
                        
                        <?php if( !empty($main_array['dropdown1']) ){ ?>
                            
                            <div class="dropdown orange">
                                <button class="dropdown-toggle orange dropdown1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Please Select</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 

                                    <?php foreach( $main_array['dropdown1'] as $dropdown1 ){ ?>

                                        <li><a class="dropdown-item" data-value="<?= $dropdown1; ?>" href="javascript:void(0);"><?= $dropdown1; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="dropdown-single-wrap">
                        <h3 class="purple"><?= $dropdown_config_2; ?></h3>
                    
                        <?php if( !empty($main_array['dropdown2']) ){ ?>
                        
                            <div class="dropdown yellow">
                                <button class="dropdown-toggle yellow dropdown2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Please Select</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                    <?php foreach( $main_array['dropdown2'] as $dropdown2 ){ ?>

                                        <li><a class="dropdown-item" data-value="<?= $dropdown2; ?>" href="javascript:void(0);"><?= $dropdown2; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>


                    <?php foreach( $main_array['dropdownlinks'] as $dropdownlink ){ ?>

                        <a href="<?= $dropdownlink['dropdown_link']; ?>" data-first="<?= !empty($dropdownlink['link_1_value']) ? $dropdownlink['link_1_value'] : 'Please Select'; ?>" data-second="<?= !empty($dropdownlink['link_2_value']) ? $dropdownlink['link_2_value'] : 'Please Select'; ?>" class="button go dropdownbtn" style="display: none;">Go<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <?php } ?>
                </div>
            </div>
        </section>

        <script>
            if( jQuery('.help-section .dropdown-item') ){

                jQuery(document).ready(function(){

                    jQuery('.dropdown ul li').eq(0).click();
                });
                
                jQuery(document).on('mouseup', '.dropdown-item', function(){
                    
                    var dropdown1 = jQuery('.dropdown1').text();
                    var dropdown2 = jQuery('.dropdown2').text();

                    console.log(dropdown1+'/'+dropdown2);

                    jQuery('.dropdownbtn').hide();
                    
                    if( jQuery('.dropdownbtn[data-first="'+dropdown1+'"][data-second="'+dropdown2+'"]').length > 0 ){
                        
                        jQuery('.dropdownbtn[data-first="'+dropdown1+'"][data-second="'+dropdown2+'"]').show();
                    }
                });
            }
        </script>
    <?php }
} ?>