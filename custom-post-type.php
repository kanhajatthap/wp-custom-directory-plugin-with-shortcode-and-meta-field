<?php

// Directory Custom Post Type

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


// Below code for shortcode
function hello_world() {
    ob_start();
    $args = array(
        'post_type'  => 'directory',
        'order'      => 'DESC'
      );
    
      $loop = new WP_Query($args);
      $html = "";
      $html = '
      <div class="directoryheader">
      <h1>Directory</h1>
      <div class="short-forms">
        <form class="short-form">            
            <select name="cars" id="cars">
            <option value="volvo">Short by company</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
            </select>
        </form>
        <form class="short-form">            
            <select name="cars" id="cars">
            <option value="volvo">Short by continent</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
            </select>
        </form>
        <form class="short-form">            
            <select name="cars" id="cars">
            <option value="volvo">Short by name</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
            </select>
        </form>
        </div>
        <form class="search-form">
            <input type="text" class="search" placeholder="Search">
            <ul class="suggestions">
                <li>Filter for keyword</li>                
            </ul>
        </form>
      </div>
      ';
      
      $html .="<div class='directory_iteams'>";
      while ( $loop->have_posts() ) : $loop->the_post();
        $post_id = get_the_id();        
        $content = apply_filters( 'the_content', get_the_content() );

        // $terms = get_the_terms( $term_id, 'category' ); 
        $terms = get_the_terms( $post_id, 'directory_category' );

      $html .="<div class='iteam'>";
      $html .= "<div class='directoryTitle'>";
      $html .= get_the_title();
      $html .= "</div>";
      $html .= "<div class='directoryContent'>";
      $html .= $content;
      $html .= "</div>";


      $html .= "<div class='directoryCategory'>";
        foreach($terms as $term) {
            
            $html .="<div class='category_iteam'>";
            $html .= $term -> name;
            $html .="</div>";

            // print_r($term);
        }
      $html .= "</div>";
      



      $html .= "</div>";

      endwhile;
      $html .= "</div>";
      return $html;
     wp_reset_postdata();
}
add_shortcode('post_with_filter_form', 'hello_world');
