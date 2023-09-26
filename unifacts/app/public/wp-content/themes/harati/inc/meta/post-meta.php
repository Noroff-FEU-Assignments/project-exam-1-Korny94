<?php
/**
* Sidebar Metabox.
*
* @package Harati
*/
if( !function_exists( 'harati_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function harati_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists('harati_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function harati_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists( 'harati_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function harati_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;


if( !function_exists( 'harati_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function harati_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

add_action( 'add_meta_boxes', 'harati_metabox' );

if( ! function_exists( 'harati_metabox' ) ):


    function  harati_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'harati' ),
            'harati_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'harati' ),
            'harati_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$harati_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'harati' ),
    'layout-2' => esc_html__( 'Banner Layout', 'harati' ),
);

$harati_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'harati' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'harati' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'harati' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'harati' ),
                ),
);

$harati_post_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'harati' ),
    'layout-2' => esc_html__( 'Banner Layout', 'harati' ),
);

$harati_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'harati' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'harati' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'harati_post_metafield_callback' ) ):
    
    function harati_post_metafield_callback() {
        global $post, $harati_post_sidebar_fields, $harati_post_layout_options,  $harati_page_layout_options, $harati_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'harati_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'harati'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'harati'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'harati'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','harati'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $harati_post_sidebar = esc_html( get_post_meta( $post->ID, 'harati_post_sidebar_option', true ) ); 
                            if( $harati_post_sidebar == '' ){ $harati_post_sidebar = 'global-sidebar'; }

                            foreach ( $harati_post_sidebar_fields as $harati_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="harati_post_sidebar_option" value="<?php echo esc_attr( $harati_post_sidebar_field['value'] ); ?>" <?php if( $harati_post_sidebar_field['value'] == $harati_post_sidebar ){ echo "checked='checked'";} if( empty( $harati_post_sidebar ) && $harati_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $harati_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Banner Layout','harati'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $harati_page_layout = esc_html( get_post_meta( $post->ID, 'harati_page_layout', true ) ); 
                                if( $harati_page_layout == '' ){ $harati_page_layout = 'layout-1'; }

                                foreach ( $harati_page_layout_options as $key => $harati_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="harati_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $harati_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $harati_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','harati'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $harati_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'harati_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="harati-header-overlay" name="harati_ed_header_overlay" value="1" <?php if( $harati_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="harati-header-overlay"><?php esc_html_e( 'Enable Header Overlay','harati' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Title Layout','harati'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $harati_post_layout = esc_html( get_post_meta( $post->ID, 'harati_post_layout', true ) ); 

                                foreach ( $harati_post_layout_options as $key => $harati_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="harati_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $harati_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $harati_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','harati'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $harati_header_overlay = esc_html( get_post_meta( $post->ID, 'harati_header_overlay', true ) ); 
                                if( $harati_header_overlay == '' ){ $harati_header_overlay = 'global-layout'; }

                                foreach ( $harati_header_overlay_options as $key => $harati_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="harati_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $harati_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $harati_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>
<!-- 
                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php //esc_html_e('Navigation Setting','harati'); ?></h3>

                        <?php //$twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php //esc_html_e( 'Navigation Type','harati' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php //if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php //esc_html_e('Global Layout','harati'); ?></option>
                                <option <?php //if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php //esc_html_e('Disable Navigation','harati'); ?></option>
                                <option <?php //if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php //esc_html_e('Next Previous Navigation','harati'); ?></option>
                                <option <?php //if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php //esc_html_e('Ajax Load Next 3 Posts Contents','harati'); ?></option>

                            </select>

                        </div>
                    </div> -->

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $harati_ed_post_views = esc_html( get_post_meta( $post->ID, 'harati_ed_post_views', true ) );
                    $harati_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'harati_ed_post_read_time', true ) );
                    $harati_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'harati_ed_post_like_dislike', true ) );
                    $harati_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'harati_ed_post_author_box', true ) );
                    $harati_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'harati_ed_post_social_share', true ) );
                    $harati_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'harati_ed_post_reaction', true ) );
                    $harati_ed_post_rating = esc_html( get_post_meta( $post->ID, 'harati_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','harati'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-views" name="harati_ed_post_views" value="1" <?php if( $harati_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-views"><?php esc_html_e( 'Disable Post Views','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-read-time" name="harati_ed_post_read_time" value="1" <?php if( $harati_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-like-dislike" name="harati_ed_post_like_dislike" value="1" <?php if( $harati_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-author-box" name="harati_ed_post_author_box" value="1" <?php if( $harati_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-social-share" name="harati_ed_post_social_share" value="1" <?php if( $harati_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-reaction" name="harati_ed_post_reaction" value="1" <?php if( $harati_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','harati' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="harati-ed-post-rating" name="harati_ed_post_rating" value="1" <?php if( $harati_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="harati-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','harati' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'harati_save_post_meta' );

if( ! function_exists( 'harati_save_post_meta' ) ):

    function harati_save_post_meta( $post_id ) {

        global $post, $harati_post_sidebar_fields, $harati_post_layout_options, $harati_header_overlay_options,  $harati_page_layout_options;

        if ( !isset( $_POST[ 'harati_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['harati_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $harati_post_sidebar_fields as $harati_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'harati_post_sidebar_option', true ) ); 
                $new = isset( $_POST['harati_post_sidebar_option'] ) ? harati_sanitize_sidebar_option_meta( wp_unslash( $_POST['harati_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'harati_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'harati_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? harati_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $harati_post_layout_options as $harati_post_layout_option ) {  
            
            $harati_post_layout_old = esc_html( get_post_meta( $post_id, 'harati_post_layout', true ) ); 
            $harati_post_layout_new = isset( $_POST['harati_post_layout'] ) ? harati_sanitize_post_layout_option_meta( wp_unslash( $_POST['harati_post_layout'] ) ) : '';

            if ( $harati_post_layout_new && $harati_post_layout_new != $harati_post_layout_old ){

                update_post_meta ( $post_id, 'harati_post_layout', $harati_post_layout_new );

            }elseif( '' == $harati_post_layout_new && $harati_post_layout_old ) {

                delete_post_meta( $post_id,'harati_post_layout', $harati_post_layout_old );

            }
            
        }



        foreach ( $harati_header_overlay_options as $harati_header_overlay_option ) {  
            
            $harati_header_overlay_old = esc_html( get_post_meta( $post_id, 'harati_header_overlay', true ) ); 
            $harati_header_overlay_new = isset( $_POST['harati_header_overlay'] ) ? harati_sanitize_header_overlay_option_meta( wp_unslash( $_POST['harati_header_overlay'] ) ) : '';

            if ( $harati_header_overlay_new && $harati_header_overlay_new != $harati_header_overlay_old ){

                update_post_meta ( $post_id, 'harati_header_overlay', $harati_header_overlay_new );

            }elseif( '' == $harati_header_overlay_new && $harati_header_overlay_old ) {

                delete_post_meta( $post_id,'harati_header_overlay', $harati_header_overlay_old );

            }
            
        }


        $harati_ed_post_views_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_views', true ) ); 
        $harati_ed_post_views_new = isset( $_POST['harati_ed_post_views'] ) ? absint( wp_unslash( $_POST['harati_ed_post_views'] ) ) : '';

        if ( $harati_ed_post_views_new && $harati_ed_post_views_new != $harati_ed_post_views_old ){

            update_post_meta ( $post_id, 'harati_ed_post_views', $harati_ed_post_views_new );

        }elseif( '' == $harati_ed_post_views_new && $harati_ed_post_views_old ) {

            delete_post_meta( $post_id,'harati_ed_post_views', $harati_ed_post_views_old );

        }



        $harati_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_read_time', true ) ); 
        $harati_ed_post_read_time_new = isset( $_POST['harati_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['harati_ed_post_read_time'] ) ) : '';

        if ( $harati_ed_post_read_time_new && $harati_ed_post_read_time_new != $harati_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'harati_ed_post_read_time', $harati_ed_post_read_time_new );

        }elseif( '' == $harati_ed_post_read_time_new && $harati_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'harati_ed_post_read_time', $harati_ed_post_read_time_old );

        }



        $harati_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_like_dislike', true ) ); 
        $harati_ed_post_like_dislike_new = isset( $_POST['harati_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['harati_ed_post_like_dislike'] ) ) : '';

        if ( $harati_ed_post_like_dislike_new && $harati_ed_post_like_dislike_new != $harati_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'harati_ed_post_like_dislike', $harati_ed_post_like_dislike_new );

        }elseif( '' == $harati_ed_post_like_dislike_new && $harati_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'harati_ed_post_like_dislike', $harati_ed_post_like_dislike_old );

        }



        $harati_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_author_box', true ) ); 
        $harati_ed_post_author_box_new = isset( $_POST['harati_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['harati_ed_post_author_box'] ) ) : '';

        if ( $harati_ed_post_author_box_new && $harati_ed_post_author_box_new != $harati_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'harati_ed_post_author_box', $harati_ed_post_author_box_new );

        }elseif( '' == $harati_ed_post_author_box_new && $harati_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'harati_ed_post_author_box', $harati_ed_post_author_box_old );

        }



        $harati_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_social_share', true ) ); 
        $harati_ed_post_social_share_new = isset( $_POST['harati_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['harati_ed_post_social_share'] ) ) : '';

        if ( $harati_ed_post_social_share_new && $harati_ed_post_social_share_new != $harati_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'harati_ed_post_social_share', $harati_ed_post_social_share_new );

        }elseif( '' == $harati_ed_post_social_share_new && $harati_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'harati_ed_post_social_share', $harati_ed_post_social_share_old );

        }



        $harati_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_reaction', true ) ); 
        $harati_ed_post_reaction_new = isset( $_POST['harati_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['harati_ed_post_reaction'] ) ) : '';

        if ( $harati_ed_post_reaction_new && $harati_ed_post_reaction_new != $harati_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'harati_ed_post_reaction', $harati_ed_post_reaction_new );

        }elseif( '' == $harati_ed_post_reaction_new && $harati_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'harati_ed_post_reaction', $harati_ed_post_reaction_old );

        }



        $harati_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'harati_ed_post_rating', true ) ); 
        $harati_ed_post_rating_new = isset( $_POST['harati_ed_post_rating'] ) ? absint( wp_unslash( $_POST['harati_ed_post_rating'] ) ) : '';

        if ( $harati_ed_post_rating_new && $harati_ed_post_rating_new != $harati_ed_post_rating_old ){

            update_post_meta ( $post_id, 'harati_ed_post_rating', $harati_ed_post_rating_new );

        }elseif( '' == $harati_ed_post_rating_new && $harati_ed_post_rating_old ) {

            delete_post_meta( $post_id,'harati_ed_post_rating', $harati_ed_post_rating_old );

        }

        foreach ( $harati_page_layout_options as $harati_post_layout_option ) {  
        
            $harati_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'harati_page_layout', true ) ); 
            $harati_page_layout_new = isset( $_POST['harati_page_layout'] ) ? harati_sanitize_post_layout_option_meta( wp_unslash( $_POST['harati_page_layout'] ) ) : '';

            if ( $harati_page_layout_new && $harati_page_layout_new != $harati_page_layout_old ){

                update_post_meta ( $post_id, 'harati_page_layout', $harati_page_layout_new );

            }elseif( '' == $harati_page_layout_new && $harati_page_layout_old ) {

                delete_post_meta( $post_id,'harati_page_layout', $harati_page_layout_old );

            }
            
        }

        $harati_ed_header_overlay_old = absint( get_post_meta( $post_id, 'harati_ed_header_overlay', true ) ); 
        $harati_ed_header_overlay_new = isset( $_POST['harati_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['harati_ed_header_overlay'] ) ) : '';

        if ( $harati_ed_header_overlay_new && $harati_ed_header_overlay_new != $harati_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'harati_ed_header_overlay', $harati_ed_header_overlay_new );

        }elseif( '' == $harati_ed_header_overlay_new && $harati_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'harati_ed_header_overlay', $harati_ed_header_overlay_old );

        }

    }

endif;   