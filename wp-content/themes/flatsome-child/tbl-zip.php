<?php
/**
 * Template Name: Zip test
 */
get_header(); ?>
<?php 

     $filename1 = 'D:\person\demo\wp-content\themes\flatsome-child\inc-td.zip';
     $zip1 = new ZipArchive;
     $res1= $zip1->open($filename1);
     var_dump($res1);
     if ($res1==TRUE ){
        //  echo "test";
         $zip1->extractTo('D:\person\demo\wp-content\themes\flatsome-child\test');
         $zip1->close();
     }	
    //  var_dump($pathInfo);
    // Create new zip class
    // $fp = @fopen(ABSPATH.'/wp-config.php', "w");
    // // $t = ABSPATH.'w';
    // // var_dump($t);
    // // Kiểm tra file mở thành công không
    // if (!$fp) {
    //     echo 'Mở file không thành công';
    // }
    // $data = "tt";
	// // Ghi file
	// fwrite($fp, $data);
  
	// Đóng file
	// fclose($fp);
    
	
?>
<?php get_footer();?>
