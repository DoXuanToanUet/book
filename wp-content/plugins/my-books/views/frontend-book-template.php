<?php 
/*
Template Name : Front end book page layout
*/
get_header();
?>
<div class="book-page">
    <div class="container">
        <h2 class="text-center pb-4 book-title" >Book List</h2>
        <div class="row">
            <div class="col-sm-12">
                <?php echo do_shortcode("[book_page]");?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>