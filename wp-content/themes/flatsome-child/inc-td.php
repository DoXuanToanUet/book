<?php 
add_action('wp_ajax_recruitmentAction', 'recruitmentAction');
add_action('wp_ajax_nopriv_recruitmentAction', 'recruitmentAction');

function recruitmentAction(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $recruitment_cat  = isset( $_POST['recruitment_cat'] ) ? $_POST['recruitment_cat'] : '';
    $recruitment_area  = isset( $_POST['recruitment_area'] ) ? $_POST['recruitment_area'] : '';
    $search  = isset( $_POST['search'] ) ? $_POST['search'] : '';
    
    if( $recruitment_cat === 'all' && $recruitment_area === 'all') :
        ob_start(); //bắt đầu bộ nhớ đệm
        $args_all = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'DATE',
            'posts_per_page' => -1 ,
            's'              => $search,
        );
        $recruitment_all = new WP_Query($args_all);
        if ( $recruitment_all->have_posts() ) : while ( $recruitment_all->have_posts() ) : $recruitment_all->the_post();?>
            <p><?php the_title();?></p>
        <?php endwhile;  endif;wp_reset_postdata();
        $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
 
        wp_send_json_success($result); // trả về giá trị dạng json
        die();
    elseif( $recruitment_cat === 'all'):
        ob_start(); //bắt đầu bộ nhớ đệm
        $args2 = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'DATE',
            'posts_per_page' => -1 ,
            's'              => $search,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'recruitment_area',
                    'field' => 'slug',
                    'terms' => array($recruitment_area),
                    // 'operator' => 'IN',
                ),
            ),
        );
        $recruitment_all2 = new WP_Query($args2);
        if ( $recruitment_all2->have_posts() ) : while ( $recruitment_all2->have_posts() ) : $recruitment_all2->the_post();?>
            <p><?php the_title();?></p>
        <?php endwhile;  endif;wp_reset_postdata();
        $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
 
        wp_send_json_success($result); // trả về giá trị dạng json
        die();
    elseif( $recruitment_area === 'all'):
        ob_start(); //bắt đầu bộ nhớ đệm
        $args3 = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'DATE',
            'posts_per_page' => -1 ,
            's'              => $search,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'recruitment_cat',
                    'field' => 'slug',
                    'terms' => array($recruitment_cat),
                    // 'operator' => 'IN',
                ),
            ),
        );
        $recruitment_all3 = new WP_Query($args3);
        if ( $recruitment_all3->have_posts() ) : while ( $recruitment_all3->have_posts() ) : $recruitment_all3->the_post();?>
            <p><?php the_title();?></p>
        <?php endwhile;  endif;wp_reset_postdata();
        $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    
        wp_send_json_success($result); // trả về giá trị dạng json
        die();
    else:
        ob_start(); //bắt đầu bộ nhớ đệm
 
        $args = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'DATE',
            'posts_per_page' => -1 ,
            's'              => $search,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'recruitment_cat',
                    'field' => 'slug',
                    'terms' => array($recruitment_cat),
                    // 'operator' => 'IN',
                ),
                array(
                    'taxonomy' => 'recruitment_area',
                    'field' => 'slug',
                    'terms' => array($recruitment_area),
                    // 'operator' => 'IN',
                ),
            ),
        );
        $eProduct = new WP_Query($args);
        if ( $eProduct->have_posts() ) : while ( $eProduct->have_posts() ) : $eProduct->the_post();?>
            <p><?php the_title();?></p>
        <?php endwhile;  endif;wp_reset_postdata();
        $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
 
         wp_send_json_success($result); // trả về giá trị dạng json
         die();
    endif;
}