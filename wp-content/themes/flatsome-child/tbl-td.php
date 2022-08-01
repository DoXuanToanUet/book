<?php
/**
 * Template Name: recruitment
 */
get_header(); ?>
<?php 
    // if( isset($_GET['submit']) ):
    //     print_r($_GET);
    // endif;
?>

<form action="" id="recruitment-form" medthod="POST">
   <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?> 
    <div class="row">
        <div class="col large-6">
            <input type="text" placeholder="Nhập từ khóa " name="search">
        </div>
        <div class="col large-3">
            Ngành nghề
            <select name="recruitment_cat" id="recruitment_cat">
                <option value="all">Tất cả</option>
                <?php 
                    $terms = get_terms( array( 
                        'taxonomy' => 'recruitment_cat',
                        'hide_empty' => false
                        // 'parent'   => 0
                    ) );

                    foreach( $terms as $item):
                        ?> <option value="<?php echo $item->slug;?>"><?php echo $item->name;?></option><?php
                    endforeach;
                    // echo "<pre>";
                    // var_dump(  $terms );
                    // echo "</pre>";
                ?>

            </select>
        </div>
        <div class="col large-3">
            Khu vực
            <select name="recruitment_area" id="recruitment_area">
                <option value="all">Tất cả</option>
                <?php 
                    $terms_area = get_terms( array( 
                        'taxonomy' => 'recruitment_area',
                        'hide_empty' => false
                        // 'parent'   => 0
                    ) );

                    foreach( $terms_area as $item):
                        ?> <option value="<?php echo $item->slug;?>"><?php echo $item->name;?></option><?php
                    endforeach;
                    // echo "<pre>";
                    // var_dump(  $terms );
                    // echo "</pre>";
                ?>
            </select>
        </div>
        <input type="submit" value="Tuyển dụng">
        
       
    </div>  
</form>
<input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
<?php 
   
?>               
<div class="row">
    <div class="show">

    </div>
</div>
<?php get_footer(); ?>