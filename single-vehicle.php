<?php

get_header();

//echo "<pre>";
//var_dump($gallery);
//echo "</pre>";
?>

<main>
    <section>
        <div class="block_content">
            <div>
                <h2 class="mb-[30px]"><?php the_title() ?></h2>
            </div>
        </div>
    </section>
</main>
<script>
    //jQuery(document).ready(() => {
    //    jQuery('#gallery').slick({
    //        infinite: true,
    //        slidesToShow: 1,
    //        slidesToScroll: 1,
    //        infinite: true,
    //        useTransform: false,
    //        arrows: true,
    //        dots: true,
    //        autoplay: true,
    //        autoplaySpeed: 3000,
    //        pauseOnFocus: false,
    //        pauseOnHover: false,
    //        prevArrow: jQuery('.buttons .prev'),
    //        nextArrow: jQuery('.buttons .next'),
    //        responsive: [{
    //            breakpoint: 768,
    //            settings: {
    //                slidesToShow: 1,
    //                slidesToScroll: 1,
    //                arrows: false,
    //                dots: false
    //            }
    //        }, ]

    //    });
    //})
</script>

<?php
get_footer();
?>