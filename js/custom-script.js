
function fetch_blog_posts(category='', pagenumber=1){
        
        var data = {
            'action': 'fetch_blog_posts', 
            'category': category,        
            'location': location,
            'pagenumber':pagenumber
        }
        // Check if we are on correct page
        if( jQuery('.blog-posts-cont').length ){

            if( pagenumber == 1 ){

                jQuery('.blog-posts-cont').html('Loading...');
            }else{
                jQuery('.load-more').text('Loading...');
            }
           
            jQuery.ajax({
                type : "post",
                url : my_ajax_object.ajaxurl,
                data : data,
                dataType : 'json',
                beforeSend : function ( xhr ) {
                    jQuery('.blog-posts-cont').html( 'Loading...' );              
                },
                success: function(data) {
                    var result = JSON.parse(data);

                    if( pagenumber == 1 ){
                        
                        jQuery('.blog-posts-cont').html(result.content);
                    }else{
                        jQuery('.load-more').remove();
                        //jQuery('.blog-posts-cont .row').append(result.content);
                        jQuery('.blog-posts-cont').html( '<div class="col-lg-12 text-center mb-5">No posts found.</div>' );
                    }
                    jQuery('.blog-posts-cont').append(result.load_more);
                }
        }); 
    }
}

fetch_blog_posts(); 


jQuery(document).on('click', '.filter-wrap li', function(e){
    e.preventDefault();

    jQuery('.filter-wrap li.active').removeClass('active');
    jQuery(this).addClass('active');

    fetch_blog_posts(jQuery(this).attr('data-cat'));

    console.log("data cat ", jQuery(this).attr('data-cat') )
});

jQuery(document).on('click', '.load-more', function(e){
    e.preventDefault();

    fetch_blog_posts(jQuery('.filter-wrap li.active').attr('data-cat'), jQuery(this).attr('data-pagenumber'));
});