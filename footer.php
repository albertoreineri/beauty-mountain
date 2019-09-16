 <!-- Footer -->
 <footer>
        <div class="container">
            <div class="row">

                <?php if (is_active_sidebar('footer1')) : ?>
                    
                    <div class="col-lg-3">
                        <?php dynamic_sidebar('footer1'); ?>
                    </div>

                <?php endif; ?>
                
                <?php if (is_active_sidebar('footer2')) : ?>
                    
                    <div class="col-lg-3">
                        <?php dynamic_sidebar('footer2'); ?>
                    </div>

                <?php endif; ?>

                <?php if (is_active_sidebar('footer3')) : ?>
                    
                    <div class="col-lg-3">
                        <?php dynamic_sidebar('footer3'); ?>
                    </div>

                <?php endif; ?>

                <?php if (is_active_sidebar('footer4')) : ?>
                    
                    <div class="col-lg-3">
                        <?php dynamic_sidebar('footer4'); ?>
                    </div>

                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-12 credits text-center">
                    <p>
                        &nbsp;Created by: <a href="http://www.albertoreineri.it" target="_blank">Alberto Reineri</a>
                    </p>

                </div>
            </div>
        </div>
    </footer>

</div>

<?php wp_footer(); ?>

<?php 
	if(is_front_page()){
        ?>
    <script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });
    $('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })
      </script>
<?php
}
?>
</body>
</html>