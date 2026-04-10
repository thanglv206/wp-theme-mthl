<?php get_header(); ?>
<main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
        <p class="text-base font-semibold text-milano-primary">404</p>
        <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Không tìm thấy trang</h1>
        <p class="mt-6 text-base leading-7 text-gray-600">Rất tiếc, trang bạn tìm kiếm không tồn tại</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="<?= get_home_url() ?>" class="rounded-md bg-milano-primary px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-milano-secondary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-milano-primary">Về trang chủ</a>
            <a href="#" class="text-sm font-semibold text-gray-900">Liên hệ hỗ trợ <span aria-hidden="true">&rarr;</span></a>
        </div>
    </div>
</main>
<?php get_footer(); ?>
