<!-- tab-section-start -->
<?php
echo "sfdgsdfgsfdg";
ecit();
??
<section class="tab-section">
  <div class="container">
    <div class="tab-wrap">
      <div class="row align-item-center flex-md-row flex-column-reverse">
        <div class="col-md-6">
          <div class="container responsive-tabs">
            <?php if( have_rows('tabbing_and_description') ): ?>
            <ul class="nav nav-tabs" role="tablist">
                <?php $i=0; while ( have_rows('tabbing_and_description') ) : the_row(); 
                  $tab_titile = get_sub_field('tab_titile');
                ?>
              <li class="nav-item">
                <a id="tab-<?php echo $i; ?>" href="#pane-<?php echo $i; ?>" class="nav-link <?php if($i=0) { echo "active"; } ?>" data-bs-toggle="tab" role="tab"><?php echo  $tab_titile; ?></a>
              </li>
              <?php $i++; endwhile; ?>
            </ul>
            <div id="content" class="tab-content" role="tablist">
              <?php $i=0; while ( have_rows('tabbing_and_description') ) : the_row(); ?>
              <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                <div class="card-header" role="tab" id="heading-A">
                  <h5 class="mb-0">
                    <a data-bs-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-A<?php echo $i; ?>">
                      <?php echo  $tab_titile; ?>
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                  </h5>
                </div>
                <div id="collapse-<?php echo $i; ?>" class="collapse show" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-A<?php echo $i; ?>">
                  <?php $tab_description = get_sub_field('tab_description'); ?>
                  <?php if($tab_description) {  ?>
                    <div class="card-body editor-design">
                      <?php echo $tab_description; ?>
                    </div>
                <?php } ?>
                </div>
              </div>
             <!--  <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                <div class="card-header" role="tab" id="heading-B">
                  <h5 class="mb-0">
                    <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                      Inactive
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                  </h5>
                </div>
                <div id="collapse-B" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                  <div class="card-body editor-design">
                    Realm of the galaxies across the centuries the carbon in our apple pies vanquish the impossible
                    another world venture. Dream of the mind's eye muse about the only home we've ever known the only home
                    we've ever known
                  </div>
                </div>
              </div>

              <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                <div class="card-header" role="tab" id="heading-C">
                  <h5 class="mb-0">
                    <a data-bs-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
                      Inactive
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                  </h5>
                </div>
                <div id="collapse-C" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-C">
                  <div class="card-body editor-design">
                    concept of the number one gathered by gravity? Stirred by starlight the sky calls to
                    us rich in mystery paroxysm of global death with pretty stories for which there's little good evidence.
                  </div>
                </div>
              </div>
              <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
                <div class="card-header" role="tab" id="heading-D">
                  <h5 class="mb-0">
                    <a data-bs-toggle="collapse" href="#collapse-D" aria-expanded="false" aria-controls="collapse-D">
                      Active
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                  </h5>
                </div>
                <div id="collapse-D" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-D">
                  <div class="card-body editor-design">
                    Realm of the galaxies across the centuries the carbon in our apple pies vanquish the impossible
                    another world venture. Dream of the mind's eye muse about the only home we've ever known the only home
                    we've ever known concept of the number one gathered by gravity? Stirred by starlight the sky calls to
                  </div>
                </div>
              </div> -->
              <?php $i++; endwhile; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php 
          $tab_right_image = get_sub_field('tab_right_image');
        ?>
        <div class="col-md-6 text-end mb-5 mb-md-0">
          <?php if($tab_right_image) { ?>
            <img src="<?php echo $tab_right_image; ?>" class="img-fluid" alt="">
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- tab-section-end -->
