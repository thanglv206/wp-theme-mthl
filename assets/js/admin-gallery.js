jQuery(document).ready(function ($) {
    var file_frame;

    $('#mthl_add_gallery_images').on('click', function (e) {
        e.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Chọn ảnh chi tiết',
            button: {
                text: 'Thêm vào Gallery'
            },
            multiple: true // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            var attachments = file_frame.state().get('selection').toJSON();
            var galleryContainer = $('#mthl_gallery_container');
            var galleryInput = $('#mthl_product_gallery');
            var currentIds = galleryInput.val() ? galleryInput.val().split(',') : [];

            attachments.forEach(function (attachment) {
                // Determine the best URL to display (thumbnail or full if thumb not available)
                var imageUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                // Build the HTML for the new image
                var itemHtml = '<div class="mthl-gallery-item" data-id="' + attachment.id + '">' +
                               '<img src="' + imageUrl + '" alt="" />' +
                               '<div class="remove-image">&times;</div>' +
                               '</div>';

                galleryContainer.append(itemHtml);
                currentIds.push(attachment.id);
            });

            // Update the hidden input
            galleryInput.val(currentIds.join(','));
        });

        // Finally, open the modal
        file_frame.open();
    });

    // Remove image on click
    $('#mthl_gallery_container').on('click', '.remove-image', function (e) {
        e.preventDefault();
        var item = $(this).closest('.mthl-gallery-item');
        var idToRemove = item.data('id').toString();
        var galleryInput = $('#mthl_product_gallery');
        var currentIds = galleryInput.val().split(',');

        // Remove the ID from the array
        var index = currentIds.indexOf(idToRemove);
        if (index > -1) {
            currentIds.splice(index, 1);
        }

        // Update the input and remove the HTML element
        galleryInput.val(currentIds.join(','));
        item.remove();
    });

    // Make the gallery items sortable (requires jquery-ui-sortable)
    $('#mthl_gallery_container').sortable({
        items: '.mthl-gallery-item',
        cursor: 'move',
        update: function (event, ui) {
            var newIds = [];
            $('#mthl_gallery_container .mthl-gallery-item').each(function () {
                newIds.push($(this).data('id'));
            });
            $('#mthl_product_gallery').val(newIds.join(','));
        }
    });
});
