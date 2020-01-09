<?php

register_nav_menus( array( // Регистрируем 2 меню
	'top' => 'Верхнее меню',
	'left' => 'Нижнее'
) );
add_theme_support('post-thumbnails'); // Включаем поддержку миниатюр
set_post_thumbnail_size(254, 190); // Задаем размеры миниатюре

if ( function_exists('register_sidebar') )
register_sidebar(); // Регистрируем сайдбар

// STYLES && SCRIPTS
if (!is_admin()) {
//Load the theme CSS
function theme_styles() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    /*wp_enqueue_style( 'owl', get_template_directory_uri() . '/css/owl.carousel.min.css');*/
    /*wp_enqueue_style( 'magnific', get_template_directory_uri() . '/css/magnific-popup.css');*/
    wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css');
}
//Load the theme JS
function theme_js() {

    wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

}
 
add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_js' );
}


add_action( 'init', 'register_faq_post_type' );
function register_faq_post_type() {
	register_taxonomy('ndcat', array('nd'), array(
		'label'                 => 'Тип',
		'labels'                => array(
			'name'              => 'Тип',
			'singular_name'     => 'Тип',
			'search_items'      => 'Искать',
			'all_items'         => 'Все',
			'parent_item'       => 'Родит.',
			'parent_item_colon' => 'Родит:',
			'edit_item'         => 'Ред.',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новый',
			'menu_name'         => 'Тип',
		),
		'description'           => 'Рубрики',
		'public'                => true,
		'show_in_nav_menus'     => false,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'nd', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true,
	) );
	register_taxonomy('ndcity', array('nd'), array(
		'label'                 => 'Город',
		'labels'                => array(
			'name'              => 'Город',
			'singular_name'     => 'Город',
			'search_items'      => 'Искать',
			'all_items'         => 'Все',
			'parent_item'       => 'Родит.',
			'parent_item_colon' => 'Родит:',
			'edit_item'         => 'Ред.',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новый',
			'menu_name'         => 'Город',
		),
		'description'           => 'Рубрики',
		'public'                => true,
		'show_in_nav_menus'     => false,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'nd/city', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true,
	) );
	register_post_type('nd', array(
		'label'               => 'Недвижимость',
		'labels'              => array(
			'name'          => 'Недвижимость',
			'singular_name' => 'Недвижимость',
			'menu_name'     => 'Недвижимость',
			'all_items'     => 'Все',
			'add_new'       => 'Добавить',
			'add_new_item'  => 'Добавить новый',
			'edit'          => 'Редактировать',
			'edit_item'     => 'Редактировать',
			'new_item'      => 'Новый',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'nd/%ndcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'nd',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'          => array( 'ndcat', 'ndcity' ),
	) );

}

add_filter('post_type_link', 'faq_permalink', 1, 2);
function faq_permalink( $permalink, $post ){

	if( strpos($permalink, '%ndcat%') === false )
		return $permalink;


	$terms = get_the_terms($post, 'ndcat');
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
		$term_slug = array_pop($terms)->slug;
	else
		$term_slug = 'no-ndcat';

	return str_replace('%ndcat%', $term_slug, $permalink );
}


add_action( 'wp_ajax_send_nd', 'send_nd' ); 
add_action( 'wp_ajax_nopriv_send_nd', 'send_nd' ); 
 
function send_nd(){

	$title = htmlspecialchars($_POST['title']);

	if (!empty($title)) {
		$type = htmlspecialchars($_POST['type']);
		$city = htmlspecialchars($_POST['city']);
		$pl = htmlspecialchars($_POST['pl']);
		$price = htmlspecialchars($_POST['price']);
		$address = htmlspecialchars($_POST['address']);
		$zh_pl = htmlspecialchars($_POST['zh_pl']);
		$et = htmlspecialchars($_POST['et']);


	    $post_data = array(
	        'post_title'    => $title,
	        'post_type'     => 'nd',
	        'post_status'   => 'draft',
	    );

	    $post_id = wp_insert_post($post_data);

	    if($type != '0'){
	    	wp_set_object_terms($post_id, (int)$type, 'ndcat');
	    }

	    if($city != '0'){
	    	wp_set_object_terms($post_id, (int)$city, 'ndcity');
	    }

	    update_field('pl', $pl, $post_id);
	    update_field('price', $price, $post_id);
	    update_field('address', $address, $post_id);
	    update_field('zl_pl', $zh_pl, $post_id);
	    update_field('et', $et, $post_id);

		wp_send_json([
			'success' => true,
			'message' => 'Объект занесен в БД'
		]);

	} else {
		wp_send_json([
			'success' => false,
			'message' => 'Заполните обязательные поля'
		]);
	}


}