<?php
/**
 * The template for displaying the footer
 */
?>
<footer class="w-full py-12 px-8 bg-surface-container-low">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 max-w-7xl mx-auto w-full">
        <div class="space-y-4 md:col-span-4">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo() && $logo) {
                echo '<a href="' . esc_url(home_url('/')) . '" class="inline-block">';
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-10 w-auto">';
                echo '</a>';
            } else {
                echo '<div class="text-xl font-bold text-primary">' . get_bloginfo('name') . '</div>';
            }
            ?>
            <p class="text-on-surface/70 text-sm leading-relaxed"><?php bloginfo('description'); ?></p>
        </div>
        <div class="space-y-4 md:col-span-2">
            <h4 class="font-bold text-primary">Liên kết</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => 'flex flex-col gap-2 text-sm list-none m-0 p-0 [&_a]:text-on-surface/70 hover:[&_a]:text-primary [&_a]:transition-colors [&_a]:inline-block',
                'fallback_cb' => false,
            ));
            ?>
        </div>
        <div class="space-y-4 md:col-span-3">
            <h4 class="font-bold text-primary">Chính sách</h4>
            <div class="flex flex-col gap-2 text-sm">
                <a class="text-on-surface/70 hover:text-primary transition-colors"
                    href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>">Chính sách bảo mật</a>
                <a class="text-on-surface/70 hover:text-primary transition-colors"
                    href="<?php echo esc_url(home_url('/dieu-khoan-su-dung/')); ?>">Điều khoản sử dụng</a>
                <a class="text-on-surface/70 hover:text-primary transition-colors"
                    href="<?php echo esc_url(home_url('/hop-tac-dai-ly/')); ?>">Hợp tác đại lý</a>
                <a class="text-on-surface/70 hover:text-primary transition-colors"
                    href="<?php echo esc_url(home_url('/cau-hoi-thuong-gap/')); ?>">Câu hỏi thường gặp</a>
            </div>
        </div>
        <div class="space-y-4 md:col-span-3">
            <h4 class="font-bold text-primary">Kết nối</h4>
            <?php if ($fb = get_theme_mod('mthl_company_facebook')): ?>
            <div class="flex gap-4">
                <a class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all"
                    href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener noreferrer">
                    <span class="material-symbols-outlined" data-icon="facebook">social_leaderboard</span>
                </a>
            </div>
            <?php endif; ?>
            <div class="<?php echo $fb ? 'pt-4 ' : ''; ?>space-y-2">
                <?php if ($phone = get_theme_mod('mthl_company_phone')): ?>
                    <div class="flex items-center gap-2 text-sm text-on-surface/70">
                        <span class="material-symbols-outlined text-sm">call</span>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"
                            class="hover:text-primary transition-colors"><?php echo esc_html($phone); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ($email = get_theme_mod('mthl_company_email')): ?>
                    <div class="flex items-center gap-2 text-sm text-on-surface/70">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        <a href="mailto:<?php echo esc_attr($email); ?>"
                            class="hover:text-primary transition-colors"><?php echo esc_html($email); ?></a>
                    </div>
                <?php endif; ?>

                <div class="flex items-center gap-2 text-sm text-on-surface/70">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    Hạ Long, Quảng Ninh
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-outline-variant/10 text-center">
        <p class="text-on-surface/70 text-sm">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Tinh Hoa Ẩm
            Thực Biển</p>
    </div>

</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>