import btnDislike from '../../src/images/btn-dislike.svg';
import btnLike from '../../src/images/btn-like.svg';

jQuery(function ($) {

    $(document)
        .on('click', '.ixbl-backlash__btn', function (e) {
            e.preventDefault();

            let data = {
                post_id: $(this).attr('data-post_id'),
                backlash: $(this).attr('data-action'),
                action: 'ixbl_ajax_backlash',
                nonce: ixbl_ajax_data.nonce
            }

            // console.log(ixbl_ajax_data.ajaxurl);

            $.ajax({
                url: ixbl_ajax_data.ajaxurl,
                data: data,
                type: 'POST',
                dataType: 'json',
                beforeSend: function( xhr, data ) {
                    $(this).text( 'Send' );
                },
                success: function( data ) {
                    if ( data.success === true ) {
                         window.location.reload();
                    }
                }
            })
        })
})