<?php
/**
 * Product Custom Meta Boxes
 */

function mthl_add_product_meta_boxes() {
    add_meta_box(
        'mthl_product_details',
        __('Chi tiết Sản phẩm', 'mthl'),
        'mthl_product_details_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mthl_add_product_meta_boxes');

function mthl_product_details_callback($post) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field('mthl_save_product_meta', 'mthl_product_meta_nonce');

    // Retrieve existing values from the database.
    $price = get_post_meta($post->ID, '_product_price', true);
    $sale_price = get_post_meta($post->ID, '_product_sale_price', true);
    $sale_start = get_post_meta($post->ID, '_product_sale_start', true);
    $sale_end = get_post_meta($post->ID, '_product_sale_end', true);
    $is_main = get_post_meta($post->ID, '_product_is_main', true);
    $gallery = get_post_meta($post->ID, '_product_gallery', true); // Comma separated attachment IDs

    ?>
    <style>
        .mthl-meta-row { margin-bottom: 15px; }
        .mthl-meta-row label { display: inline-block; width: 150px; font-weight: 600; }
        .mthl-meta-row input[type="text"], .mthl-meta-row input[type="number"], .mthl-meta-row input[type="datetime-local"] { width: 60%; }
        .mthl-gallery-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .mthl-gallery-item { position: relative; width: 100px; height: 100px; border: 1px solid #ccc; background: #f9f9f9; display: flex; align-items: center; justify-content: center; overflow: hidden; cursor: move; }
        .mthl-gallery-item img { max-width: 100%; max-height: 100%; object-fit: cover; }
        .mthl-gallery-item .remove-image { position: absolute; top: 2px; right: 2px; background: red; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 18px; cursor: pointer; font-size: 14px; font-weight: bold; }
    </style>

    <div class="mthl-meta-row">
        <label for="mthl_product_price"><?php _e('Giá gốc', 'mthl'); ?></label>
        <input type="number" id="mthl_product_price" name="mthl_product_price" value="<?php echo esc_attr($price); ?>" min="0" step="1" />
    </div>

    <div class="mthl-meta-row">
        <label for="mthl_product_sale_price"><?php _e('Giá khuyến mãi', 'mthl'); ?></label>
        <input type="number" id="mthl_product_sale_price" name="mthl_product_sale_price" value="<?php echo esc_attr($sale_price); ?>" min="0" step="1" />
    </div>

    <div class="mthl-meta-row">
        <label for="mthl_product_sale_start"><?php _e('Khuyến mãi từ', 'mthl'); ?></label>
        <input type="datetime-local" id="mthl_product_sale_start" name="mthl_product_sale_start" value="<?php echo esc_attr($sale_start); ?>" />
    </div>

    <div class="mthl-meta-row">
        <label for="mthl_product_sale_end"><?php _e('Khuyến mãi đến', 'mthl'); ?></label>
        <input type="datetime-local" id="mthl_product_sale_end" name="mthl_product_sale_end" value="<?php echo esc_attr($sale_end); ?>" />
    </div>

    <div class="mthl-meta-row">
        <label for="mthl_product_is_main"><?php _e('Sản phẩm chính?', 'mthl'); ?></label>
        <input type="checkbox" id="mthl_product_is_main" name="mthl_product_is_main" value="1" <?php checked($is_main, '1'); ?> />
    </div>

    <hr/>

    <div class="mthl-meta-row">
        <label style="display:block; margin-bottom: 10px;"><?php _e('Ảnh chi tiết (Gallery)', 'mthl'); ?></label>
        <input type="hidden" id="mthl_product_gallery" name="mthl_product_gallery" value="<?php echo esc_attr($gallery); ?>" />
        <button type="button" class="button" id="mthl_add_gallery_images"><?php _e('Thêm ảnh chi tiết', 'mthl'); ?></button>
        <div class="mthl-gallery-container" id="mthl_gallery_container">
            <?php
            if (!empty($gallery)) {
                $attachment_ids = explode(',', $gallery);
                foreach ($attachment_ids as $attachment_id) {
                    if (empty($attachment_id)) continue;
                    $image_src = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                    if ($image_src) {
                        echo '<div class="mthl-gallery-item" data-id="' . esc_attr($attachment_id) . '">';
                        echo '<img src="' . esc_url($image_src) . '" alt="" />';
                        echo '<div class="remove-image">&times;</div>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Save meta box content.
 */
function mthl_save_product_meta($post_id) {
    // Check if nonce is set.
    if (!isset($_POST['mthl_product_meta_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['mthl_product_meta_nonce'], 'mthl_save_product_meta')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'product' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Sanitize user input and return saving logic.
    $fields = array(
        'mthl_product_price'       => '_product_price',
        'mthl_product_sale_price'  => '_product_sale_price',
        'mthl_product_sale_start'  => '_product_sale_start',
        'mthl_product_sale_end'    => '_product_sale_end',
        'mthl_product_gallery'     => '_product_gallery',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            $data = sanitize_text_field($_POST[$post_key]);
            update_post_meta($post_id, $meta_key, $data);
        } else {
            delete_post_meta($post_id, $meta_key);
        }
    }

    // Handle checkbox separately
    $is_main = isset($_POST['mthl_product_is_main']) ? '1' : '0';
    update_post_meta($post_id, '_product_is_main', $is_main);
}
add_action('save_post', 'mthl_save_product_meta');

/**
 * Enqueue scripts for the admin area (for media uploader)
 */
function mthl_admin_enqueue_scripts($hook) {
    global $post;
    
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ('product' === $post->post_type) {
            wp_enqueue_media();
            // We'll place the JS in a separate file or inline here if it's small enough.
            wp_enqueue_script('mthl-admin-gallery', get_template_directory_uri() . '/assets/js/admin-gallery.js', array('jquery', 'jquery-ui-sortable'), wp_get_theme()->get('Version'), true);
        }
    }
}
add_action('admin_enqueue_scripts', 'mthl_admin_enqueue_scripts');
