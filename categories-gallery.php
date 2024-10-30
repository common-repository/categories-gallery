<?php
/**
 * Plugin Name: Bootstrap Categories Gallery
 * Plugin URI: https://troplr.com/
 * Description: Show Post Categories in Gallery Format.
 * Version: 1.0.1
 * Author: Troplr
 * Author URI: https://troplr.com
 * Requires at least: 4.5
 * Tested up to: 4.7
 *
 * Text Domain: troplr
 *
 */

require_once('titan-framework/titan-framework-embedder.php');

require_once dirname( __FILE__ ) . '/TGM-Plugin-Activation-2.6.1/example.php';

function btcg_resources() {   
    wp_enqueue_script( 'btcg-bootstrapjs', plugin_dir_url( __FILE__ ) . 'script/bootstrap.min.js',array('jquery'), '4.0.0', false );
    wp_register_style('btcg-bootstrapcss', plugin_dir_url( __FILE__ ).'script/bootstrap.min.css');
  wp_enqueue_style('btcg-bootstrapcss');
}

add_action('wp_enqueue_scripts', 'btcg_resources');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
//add_action('wp_head','check_some_other_plugin');
function btcg_checkplugin() {
  if ( is_plugin_active('categories-images/categories-images.php') ) {
    $file = 'categories-images/categories-images.php';
    $plugin_dir = ABSPATH . 'wp-content/plugins/'.$file;
 require_once($plugin_dir);
  }
  
}
add_action( 'admin_init', 'btcg_checkplugin' );


add_action( 'tf_create_options', 'btcg_option' );
function btcg_option() {
// Initialize Titan & options here

 $titan = TitanFramework::getInstance( 'btcg-opt' );


 $panel = $titan->createAdminPanel( array(
'name' => 'Categories Gallery',
) );

$generalTab = $panel->createTab( array(
'name' => 'Settings',
) );

$generalTab->createOption(  array(
'name' => 'Category Box Hover Color',
'id' => 'catg_hover',
'type' => 'color',
'alpha' => true,

) );

$generalTab->createOption(  array(
'name' => 'Category Name Text Color',
'id' => 'catg_text',
'type' => 'color',
) );

$generalTab->createOption( array(
'type' => 'save'
) );
$generalTab->createOption( array(
'name' => '',
'id' => 'btcgpay',
'type' => 'note',
'desc' => 'Thankyou for using <b>Categories Gallery</b>.<br>You may want to support my development: <a target="_blank" href="https://paypal.me/sandeeptete">Paypal me a tip</a>'
) );

$generalTab->createOption(  array(
'name' => '',
'id' => 'author_message_grid',
'type' => 'note',
'desc' => 'You may find other plugins from us to be useful below.<br><div class="autowide">
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/categories-gallery/">Bootstrap Categories Gallery</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/custom-scroll-bar-designer/">Custom Scrollbar Designer</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/custom-text-selection-colors/">Custom Text Selection Colors</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/disable-image-right-click/">Disable Image Right Click</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/easy-gallery-slideshow/">Easy Gallery Slideshow</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/exit-popup-show/">Exit Popup Show</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/popup-modal-for-youtube/">Popup Modal For Youtube</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/woo-availability-date/">Product Limited Time Availability Date for woocommerce</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/email-my-posts/">Share Posts To Email</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/custom-scroll-bar-designer/">Share Woocommerce to Email</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/share-woocommerce-email/">Custom Scrollbar Designer</a></b></p>
  </div>
  <div class="module">
    <p><b><a href="https://wordpress.org/plugins/total-sales-for-woocommerce/">Total Sales For Woocommerce</a></b></p>
  </div>
</div>'
) );
}

function btcg_customcss()
{
  $btcgcss = '<style>.autowide {
  margin: 0 auto;
  width: 98%;
}
.autowide img {
  float: left;
  margin: 0 .75rem 0 0;
}
.autowide .module {
  xbackground-color: lightgrey;
  border-radius: .25rem;
  margin-bottom: 1rem;
  color: #0f8cbb;
}
.autowide .module p {
  padding: 4px 0px;
}

/* 2 columns: 600px */
@media only screen and (min-width: 600px) {
  .autowide .module {
    float: left;
    margin-right: 2.564102564102564%;
    width: 48.717948717948715%;
  }
  .autowide .module:nth-child(2n+0) {
    margin-right: 0;
  }
}

/* 3 columns: 768px */
@media only screen and (min-width: 768px) {
  .autowide .module {
    width: 31.623931623931625%;
  }
  .autowide .module:nth-child(2n+0) {
    margin-right: 2.564102564102564%;
  }
  .autowide .module:nth-child(3n+0) {
    margin-right: 0;
  }
}

/* 4 columns: 992px and up */
@media only screen and (min-width: 992px) {
  .autowide .module {
    width: 23.076923076923077%;
  }
  .autowide .module:nth-child(3n+0) {
    margin-right: 2.564102564102564%;
  }
  .autowide .module:nth-child(4n+0) {
    margin-right: 0;
  }
}</style>';
echo $btcgcss;

}
add_action('admin_head','btcg_customcss');

add_action('wp_head','btcg_css');
function btcg_css(){
 ?>
 <style type="text/css"> 
  img.img-responsive.ctg {
    height: 220px!important;
    width: 100%;
}</style>

<?php
}


  
add_action('wp_head','btcg_imghover');
  function btcg_imghover()
  {
    if ( !class_exists('TitanFramework') ) {
return false;
}
    $titan = TitanFramework::getInstance( 'btcg-opt' ); 
    $catg_hover = $titan->getOption( 'catg_hover');
    $catg_text = $titan->getOption( 'catg_text');
    ?>
    <style type="text/css">
      a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active {
    -webkit-box-shadow: 0px 0px 13px 0px <?php echo $catg_hover;?>!important;
    box-shadow: 0px 0px 13px 0px <?php echo $catg_hover;?>!important;
    /*.thumbnail, .img-thumbnail {
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
    box-shadow: 0 1px 2px rgba(0, 0, 0, .075);*/
}
.thumbnail{
  padding: 0px!important;
  margin-bottom: 10px!important;
  border: none!important;
}
a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active {
     border: none!important;
}
a.catgfont {
    color: <?php echo $catg_text;?>;
    font-weight: bold;
    /* font-size: 19px; */
}
}
    </style>
<?php
  }

function btcg_categories()
{
  

$args = array(
     'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
);
$categories = get_terms( 'product_cat', $args );
$categories_sub = get_categories();


$cont = '<div class="container">

        <div class="row">';
        echo $cont;

foreach ( $categories as $category ) {
$categorycount = $category->count;
//echo $categorycount;

    echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb" style="margin-bottom: 28px;">
    <a class="thumbnail" href="' . get_category_link(     $category->term_id ) . '">
                    <img class="img-responsive ctg" src="'.z_taxonomy_image_url($category->term_id).'" alt="">
                </a>
     <a class="catgfont" href="' . get_category_link(     $category->term_id ) . '">' . $category->name . '</a><span style="float:right;font-weight: bold; font-size: 15px;">Posts:'.$categorycount.'</span></div>';
    
    }

    $contt = '</div></div>';
    echo $contt;

}

add_shortcode('categoriesgallery','btcg_categories');





?>