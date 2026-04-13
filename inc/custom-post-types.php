<?php
/**
 * Register Custom Post Types and Taxonomies
 */

function mthl_register_custom_post_types() {
    $labels = array(
        'name'                  => _x('Sản phẩm', 'Post Type General Name', 'mthl'),
        'singular_name'         => _x('Sản phẩm', 'Post Type Singular Name', 'mthl'),
        'menu_name'             => __('Sản phẩm', 'mthl'),
        'name_admin_bar'        => __('Sản phẩm', 'mthl'),
        'archives'              => __('Tất cả Sản phẩm', 'mthl'),
        'attributes'            => __('Thuộc tính Sản phẩm', 'mthl'),
        'parent_item_colon'     => __('Sản phẩm cha:', 'mthl'),
        'all_items'             => __('Tất cả Sản phẩm', 'mthl'),
        'add_new_item'          => __('Thêm Sản phẩm mới', 'mthl'),
        'add_new'               => __('Thêm mới', 'mthl'),
        'new_item'              => __('Sản phẩm mới', 'mthl'),
        'edit_item'             => __('Sửa Sản phẩm', 'mthl'),
        'update_item'           => __('Cập nhật Sản phẩm', 'mthl'),
        'view_item'             => __('Xem Sản phẩm', 'mthl'),
        'view_items'            => __('Xem các Sản phẩm', 'mthl'),
        'search_items'          => __('Tìm kiếm Sản phẩm', 'mthl'),
        'not_found'             => __('Không tìm thấy', 'mthl'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'mthl'),
        'featured_image'        => __('Ảnh đại diện', 'mthl'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'mthl'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'mthl'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'mthl'),
        'insert_into_item'      => __('Chèn vào Sản phẩm', 'mthl'),
        'uploaded_to_this_item' => __('Đã tải lên Sản phẩm này', 'mthl'),
        'items_list'            => __('Danh sách Sản phẩm', 'mthl'),
        'items_list_navigation' => __('Điều hướng danh sách Sản phẩm', 'mthl'),
        'filter_items_list'     => __('Lọc danh sách Sản phẩm', 'mthl'),
    );

    $args = array(
        'label'                 => __('Sản phẩm', 'mthl'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-cart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        // 'show_in_rest'       => true, // Uncomment if Gutenberg is needed
        'rewrite'               => array('slug' => 'san-pham', 'with_front' => false),
    );

    register_post_type('product', $args);
}
add_action('init', 'mthl_register_custom_post_types', 0);
