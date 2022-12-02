<?php
add_action('wp_enqueue_scripts', 'load_style');
function load_style() {
wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ) .'assets/css/dir_style.css');
}

function directory_init() {
    // set up directory labels
    $labels = array(
        'name' => 'Directory',
        'singular_name' => 'Directory',
        'add_new' => 'Add New Directory',
        'add_new_item' => 'Add New Directory',
        'edit_item' => 'Edit Directory',
        'new_item' => 'New Directory',
        'all_items' => 'All Directory',
        'view_item' => 'View Directory',
        'search_items' => 'Search Directory',
        'not_found' =>  'No Directory Found',
        'not_found_in_trash' => 'No Directory found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Directory',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'directory'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'directory', $args );
    
    // register taxonomy
    register_taxonomy('directory_category', 'directory', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'directory-category' )));
}
add_action( 'init', 'directory_init' );

// --------------------------
function get_child_category_with_filter () {
	ob_start();
	$html = "";
	$parent_id = isset($_POST['parent_id'])? $_POST['parent_id']:"";
	$args4 = array(
		'post_type'  => 'directory',
		'taxonomy' => 'directory_category',
		'child_of' => $parent_id,
		'orderby' => 'name',
		'hide_empty' => 0,
		'order'   => 'ASC'
	);
	$forms_catess = get_categories($args4);
	$html .= "<option value='' class='defaultdivision'>Select City</option>";
	foreach($forms_catess as $forms_catesss) {
		$html .= "<option value='".$forms_catesss->term_id."'>".$forms_catesss->name."</option>";
	}
	echo $html;
	wp_reset_postdata();
	// die();
}
add_action('wp_ajax_get_child_category_with_filter', 'get_child_category_with_filter');
add_action('wp_ajax_nopriv_get_child_category_with_filter', 'get_child_category_with_filter');

function post_with_filter () {
    ob_start();
    $selected_submit = isset($_POST['selected_submit'])? $_POST['selected_submit']:"";
    $selected_cat = isset($_POST['selected_cat'])? $_POST['selected_cat']:"";
    $selected_dev = isset($_POST['selected_dev'])? $_POST['selected_dev']:"";
    $selected_name = isset($_POST['selected_name'])? $_POST['selected_name']:"";

    if (!empty($selected_cat) && empty($selected_name) && empty($selected_dev)) {
        $args = array(
          'post_type'  => 'directory',
          'post_status' => 'publish',
          'posts_per_page' => -1,
        );
        $args['tax_query'] = array(
          'relation' => 'OR',
          array(
            'taxonomy'  => 'directory_category',
            'field'  => 'id',
            'terms'  => array($selected_cat),
            'include_children' => false,
          )
        );
    }
    if (empty($selected_cat) && empty($selected_name) && !empty($selected_dev)) {
      $args = array(
        'post_type'  => 'directory',
        'post_status' => 'publish',
        'posts_per_page' => -1,
      );
      $args['tax_query'] = array(
        'relation' => 'OR',
        array(
          'taxonomy'  => 'directory_category',
          'field'  => 'id',
          'terms'  => array($selected_dev),
          'include_children' => false,
        )
      );
    }
    elseif(!empty($selected_name) && empty($selected_cat) && empty($selected_dev)) {
      $args = array(
        'post_type'  => 'directory',
        'post_status' => 'publish',
        's' => $selected_name,
        'posts_per_page' => -1,
        'compare' => '%LIKE%'
      );
    }
    elseif(empty($selected_name) && !empty($selected_cat) && !empty($selected_dev)) {
      $args = array(
        'post_type'  => 'directory',
        'post_status' => 'publish',
        'posts_per_page' => -1,
      );
      $args['tax_query'] = array(
        'relation' => 'OR',
        array(
          'taxonomy'  => 'directory_category',
          'field'  => 'id',
          'terms'  => array($selected_dev),
          'include_children' => false,
        )
      );
    }
    elseif (!empty($selected_cat) || !empty($selected_dev) || !empty($selected_name)) {
      $args = array(
        'post_type'  => 'directory',
        'post_status' => 'publish',
        's' => $selected_name,
        'posts_per_page' => -1,
        'compare' => 'IN'
      );
      $args['tax_query'] = array(
        'relation' => 'OR',
        array(
          'taxonomy'  => 'directory_category',
          'field'  => 'id',
          'terms'  => array($selected_cat),
          'include_children' => false,
        ),
        array(
          'taxonomy'  => 'directory_category',
          'field'  => 'id',
          'terms'  => array($selected_dev),
        )
      );
    }
    else{
      $args = array(
        'post_type'  => 'directory',
        'orderby' => 'date',
        'order'   => 'ASC',
        'posts_per_page' => -1,
      );
    }
  
    $loop = new WP_Query($args);
    $html = "";
    $html .="<div id='directory_loop' class='employee_loop directory_iteams' >";
    while ( $loop->have_posts() ) : $loop->the_post();
        $post_id = get_the_id();
        $url = get_permalink( $post_id );
        $title = get_the_title( $post_id );
        $content = apply_filters( 'the_content', get_the_content() );
        $terms = get_the_terms($post_id, 'directory_category');
        $html.= "<div class='loop_div iteam'>";
          $count=1;
          foreach($terms as $term){
            $html.= "<div class='country".$count."'><h5>".$term->name."<h5></div>";
            $count++;
          }
            $html.= "<div class='title'><h5>".$title."</h5></div>";
            $html.= "<div class='directoryContent'>".$content."</div>";
        $html.= "</div>";
  
    endwhile;
    $html.= "</div>";
    echo $html;
    echo "<div class='pagination-page'></div>"; 
    wp_reset_postdata();
    die();
  }
  add_action('wp_ajax_post_with_filter', 'post_with_filter');
  add_action('wp_ajax_nopriv_post_with_filter', 'post_with_filter');
// --------------------------
function post_with_filter_form () {

    $filtr_form = "";
    $args1 = array(
              'taxonomy' => 'directory_category',
              'orderby' => 'name',
              'order'   => 'ASC',
              'hide_empty' => 0,
              'parent' => 0,
            );
    $category_ats = get_categories($args1);
    $filtr_form .= "<div class='directoryheader'>";
    $filtr_form .= "<h1>Directory</h1>";
    $filtr_form .= "<select id='selected_cat' name='selected_cat'>";
    $filtr_form .= "<option value=''>Select Country</option>";
    foreach($category_ats as $category_cats) {
      $filtr_form .= "<option value='".$category_cats->term_id."'>".$category_cats->name."</option>";
    }
    $filtr_form .= "</select>";
    $filtr_form .= "<select id='selected_dev' name='selected_dev'>";
    $filtr_form .= "</select>";
    $filtr_form .= "<input type='text' id='selected_name' name='selected_name'>";
    $filtr_form .= "<input type='button' name='submit_filter' id='submit_filter' value='Search'>";
    $filtr_form .= " </div>";
    $filtr_form .= "<div id='loader'><img src='".plugins_url( "assets/loading.gif", __FILE__ )."' alt='loading'></div>";
    $filtr_form .= "<div id='submit_filter_post'></div>";
    
    echo $filtr_form;
  ?>
  <script>
    // child category fetch
    jQuery('#selected_cat').on('change', function() {
			var pid = jQuery('#selected_cat').val();
		  jQuery.ajax({
		    type: 'POST',
		    url: '<?php echo admin_url('admin-ajax.php'); ?>',
		    dataType: 'html',
		    data: {
		      action: 'get_child_category_with_filter',
		      parent_id: pid,
		    },
		    success: function(res) {
		      jQuery('#selected_dev').html(res);
		    }
		  })
		});

    search_filtr();
    function search_filtr(){
      var scat = jQuery('#selected_cat').val();
      var sdev = jQuery('#selected_dev').val();
      var sname = jQuery('#selected_name').val();
      var submit = jQuery('#submit_filter').val();
      //alert(scat + sdev + sname);
      jQuery('#loader').show();
      jQuery('#submit_filter_post').hide();
      
      jQuery.ajax({
        type: 'POST',
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        dataType: 'html',
        data: {
          action: 'post_with_filter',
          selected_cat: scat,
          selected_dev: sdev,
          selected_name: sname,
          selected_submit: submit
        },
        success: function(res) {
          jQuery('#loader').hide();
          jQuery('#submit_filter_post').show();
          jQuery('#submit_filter_post').html(res);
          ajax_paging();
        }
      })
    }
  
    jQuery('#submit_filter').on('click', function() {
      search_filtr();
    });
    function ajax_paging(){
      jQuery(function(jQuery) {
        var items = jQuery("#directory_loop .loop_div");
        var numItems = items.length;
        var perPage = 6;
        items.slice(perPage).hide();
        jQuery(".pagination-page").pagination({
        items: numItems,
        itemsOnPage: perPage,
        cssStyle: "light-theme",
        onPageClick: function(pageNumber) {
          var showFrom = perPage * (pageNumber - 1);
          var showTo = showFrom + perPage;
          items.hide().slice(showFrom, showTo).show();
        }
        });
      });
    }
  </script>
  <?php
  }
  add_shortcode( 'post_with_filter_form', 'post_with_filter_form' );
add_action('wp_enqueue_scripts','pagination_init');
function pagination_init() {
    wp_enqueue_script( 'pagination.js', plugins_url( '/assets/js/pagination.js', __FILE__ ));
}