<?php
/**
 * Pinterest Portfolio Section Style
 */

$i = $j = 0;
$portfolio_groups = array();

while ( yit_have_works() ) {
    $portfolio_groups[$i][] = array(
        'title' => yit_work_get('title'),
        'terms' => yit_work_get('terms'),
        'permalink' => yit_work_permalink( yit_work_get( 'item_id' ) ),
        'image_id' => yit_work_get( 'item_id' ),
        'image_url' => yit_work_get( 'image_url' ),
        'read_more_text' => yit_work_get( 'read_more_text' )
    );

    if( ++$j % 2 == 0 ) $i++;
} ?>

<?php foreach( $portfolio_groups as $k => $group ): ?>
    <div class="section_portfolio_group span3 clearfix<?php if( $k % 4 == 3 ): ?> last_group<?php endif ?>">
        <?php foreach( $group as $index=>$work ): ?>
            <?php
            $class = '';
            if( $k % 2 == 0 ) { $class = 'section_portfolio'; }
            else { $class = $index == 0 ? 'section_portfolio_small' : 'section_portfolio_large'; } ?>

            <div class="<?php echo $class . ' work yit_item' ?>">
                <?php yit_image( "id={$work['image_id']}&size=" . $class ); ?>

                <?php if( $show_lightbox_hover == 'yes' ): ?>
	                <div class="description">
	                   <div class="inner-description">
	                        <div class="description-container">
	                            <div class="inner-description-container">
	                            <?php if( $work['title'] ): ?>
	                                <!-- title -->
	                                <h3><?php echo $work['title'] ?></h3>
	                                <span><?php echo $work['read_more_text'] ?> &rarr;</span>
	                            <?php endif ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                    <span class="detail"></span>
                <?php endif; ?>
                <a href="<?php echo $work['permalink'] ?>"></a>
            </div><!-- .work.yit_item -->
        <?php endforeach ?>

        <?php /*
            <?php foreach( $group as $index=>$work ): ?>
                <?php
                    $class = "";
                    if( $k % 2 == 1 ) {
                        $class = ( $index % 3 == 0 ) ? 'large' : 'half';
                    } else {
                        $class = ( $index % 3 == 2 ) ? 'large' : 'half';
                    }
                ?>
                <div <?php yit_work_class( $class . $classes ) ?>>
                    <?php yit_image( "id={$work['image_id']}&size=" . ( $class == 'large' ? 'section_portfolio_large' : 'section_portfolio' ) ); ?>

                    <?php if( $show_lightbox_hover == 'yes' ): ?>
                        <div class="description">
                            <div class="description-container">
                                <?php if( $work['title'] ): ?>
                                    <!-- title -->
                                    <h2><?php echo $work['title'] ?></h2>
                                <?php endif ?>

                                <?php if( $work['terms'] ): ?>
                                    <!-- categories -->
                                    <span class="categories"><img src="<?php echo get_template_directory_uri() ?>/theme/templates/portfolios/pinterest/images/terms.png" alt="" /><?php echo implode( ', ', $work['terms'] ) ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif ?>

                    <span class="detail"></span>
                    <a href="<?php echo $work['permalink'] ?>"></a>
                </div>
            <?php endforeach ?>
            */ ?>
    </div><!-- .section_portfolio_group -->
<?php endforeach ?>