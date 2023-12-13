<?php

get_header();

$args = array(
    'post_type' => 'wheel',
    'post__not_in'   => array(get_the_ID()),
    'posts_per_page' => 4,
    'orderby' => 'rand',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'serie',
            'field' => 'name',
            'terms' => get_the_terms(get_the_ID(), "serie")[0]->name,
        )
    ),
);

$query              = new WP_Query($args);

$next_post          = get_permalink($query->posts[0]->ID);
$social_media       = get_field('social_media', 'option');
$mail               = get_field('footer', 'option')["email"];
$gallery            = get_field('gallery') ?: [];
$sizes              = get_field('size');
$forging            = get_field('forging');
$car_slider         = get_field('car_slider');




if (!empty($gallery)) {
    array_unshift($gallery, get_the_post_thumbnail_url());
}

//echo "<pre>";
//var_dump($gallery);
//echo "</pre>";
?>

<main class="bg-background">
    <section>
        <div class="single_content">
            <div class="flex lg:justify-between lg:flex-row items-center flex-col gap-y-[50px]">
                <a href="/wheels" class="single-left flex items-center gap-[13px] cursor-pointer about">
                    <div class="relative">
                        <img class="black ml-[13px] mr-[2px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev.svg">
                        <img class="white ml-[13px] mr-[2px] absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev-black.svg">
                    </div>
                    <span class="text-[20px] font-[400] tracking-[6.5px]">WHEEL’S PAGE</span>
                </a>
                <a href="<?php echo $next_post ?>" class="single-right flex items-center gap-[13px] cursor-pointer about">
                    <span class="text-[20px] font-[400] tracking-[6.5px]">NEXT WHEEL</span>
                    <div class="relative">
                        <img class="black ml-[13px] mr-[2px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                        <img class="white ml-[13px] mr-[2px] absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                    </div>
                </a>
            </div>
            <div class="relative mt-[100px] flex flex-col items-center gap-[20px]">
                <div id="slider-for" class="w-full">
                    <?php foreach ($gallery as $key => $image) : ?>
                        <div class="slick-slide relative">
                            <img class="w-full h-[350px] sm:h-[500px] md:h-[600px] lg:h-[830px] object-cover" src="<?php echo $image ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>

                <div id="slider-nav" class="w-full md:w-[85%] lg:w-[90%]">
                    <?php foreach ($gallery as $key => $image) : ?>
                        <div class="slick-slide relative small-image border-[1px] border-[#00000033] cursor-pointer hover:border-[#000] hover:shadow-lg">
                            <img class="w-full h-[200px] md:h-[220px] lg:h-[285px] object-cover" src="<?php echo $image ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="hidden md:flex slider-nav  absolute  justify-between w-full bottom-[10%]" style="">
                    <div class="relative prev cursor-pointer about">
                        <img class="black" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev.svg">
                        <img class="white absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev-black.svg">
                    </div>
                    <div class="relative next cursor-pointer about">
                        <img class="black" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                        <img class="white absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="block_content " style="padding-top:0px; padding-bottom:0px">
            <div class="bg-white w-full py-[50px] lg:px-[30px]">
                <div class="flex flex-wrap lg:flex-nowrap">
                    <div class="w-full lg:w-[50%] mb-[50px] lgmb-0">
                        <h2><?php the_title() ?></h2>
                    </div>
                    <div class="w-full lg:w-[50%] flex gap-[38px] lg:justify-end flex-col lg:flex-row">
                        <a href="#" class="customize-button w-fit h-fit text-[18px] font-[600] py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer">
                            <img class="w-[20px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/doc.svg"> Request Quote
                        </a>
                        <a href="#" class="customize-button w-fit h-fit text-[18px] font-[600] py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer">
                            <img class="w-[20px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/pen.svg"> Customize
                        </a>
                    </div>
                </div>
                <div class="mt-[100px] flex flex-col lg:flex-row lg:justify-between">
                    <div class="lg:w-[430px] mb-[50px] lg:mt-0 flex gap-y-[50px] lg:gap-y-[100px] flex-col">
                        <div class="flex gap-[20px]">
                            <div>
                                <img class="h-[75%]" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/wheel.svg" alt="">
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between">
                                    <span class="text-[16px] text-[#00000099]">Wheel Series</span>
                                    <a class="single-right-series cursor-pointer underline text-[16px] text-[#00000099] hover:font-[600]">Go to Series <span class="inline-block">></span> </a>
                                </div>
                                <div class="text-[18px] lg:text-[24px]">
                                    <?php echo get_the_terms(get_the_ID(), "serie")[0]->name  ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-[20px]">
                            <div>
                                <img class="h-[75%]" src=" <?php echo  get_stylesheet_directory_uri() ?>/assets/images/tag.svg" alt="">
                            </div>
                            <div class="flex flex-col w-full">
                                <span class="text-[16px] text-[#00000099]">Price Tier</span>
                                <div class="text-[18px] lg:text-[24px]">
                                    Not Available
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-[474px] flex gap-y-[50px] lg:gap-y-[100px] flex-col">
                        <div class="flex gap-[20px]">
                            <div>
                                <img class="h-[75%]" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/forge.svg" alt="">
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between">
                                    <span class="text-[16px] text-[#00000099]">Forging</span>
                                    <a class="cursor-pointer underline text-[16px] text-[#00000099] hover:font-[600]">What is Forging?</a>
                                </div>
                                <div class="text-[18px] lg:text-[24px]">
                                    <?php echo $forging ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-[20px]">
                            <div>
                                <img class="h-[75%]" src=" <?php echo  get_stylesheet_directory_uri() ?>/assets/images/size-big.svg" alt="">
                            </div>
                            <div class="flex flex-col w-full">
                                <span class="text-[16px] text-[#00000099]">Available Sizes</span>
                                <div class="text-[18px] lg:text-[24px]">
                                    <?php foreach ($sizes as $key => $size) : ?>
                                        <span class="text-[18px] lg:text-[24px]"> <?php echo $size ?></span>
                                        <span class="last:hidden mx-[5px] text-[18px] lg:text-[24px]"> , </span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="block_content" style="">
            <div class="relative flex justify-center">
                <div id="gallery" class="w-full md:w-[85%] lg:w-[90%]">
                    <?php foreach ($car_slider as $key => $car) : ?>
                        <div class="slick-slide relative">
                            <img class="w-full aspect-video	lg:h-[544px] object-cover" src="<?php echo $car["image"] ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="hidden md:flex buttons absolute  justify-between w-full top-[50%]" style="transform:translate(0% , -50%)">
                    <div class="relative prev cursor-pointer about">
                        <img class="black " src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev.svg">
                        <img class="white  absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev-black.svg">
                    </div>
                    <div class="relative next cursor-pointer about">
                        <img class="black " src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                        <img class="white  absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                    </div>
                </div>
            </div>
            <div class="mt-[32px] lg:mt-[50px] flex justify-center items-center">
                <span class="text-[16px] text-[#00000099] mr-[30px]">Share wheel on</span>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["facebook"] ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/facebook.svg" alt=""> </a>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["google+"] ?>"> <img class="w-[22px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/google+.svg" alt=""> </a>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["x"] ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/x.svg" alt=""> </a>
                <a target="_blank" class="hover:translate-y-[1px] transform" href="mailto:  <?php echo $mail ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/mail.svg" alt=""> </a>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content" style="padding-top:0px;">
            <div class="bg-[white] py-[50px] lg:px-[30px]">
                <h2>Related wheels </h2>
                <div class="flex flex-wrap mt-[100px] gap-y-[50px] lg:gap-y-[60px]">
                    <?php foreach ($query->posts as $key => $wheel) : ?>
                        <div class="w-full justify-center flex  sm:w-1/2 lg:w-1/4 sm:px-[12px]">
                            <div>
                                <div class="mb-[40px]">
                                    <a class="related-wheels cursor-pointer" href="<?php echo get_the_permalink($wheel->ID,) ?>">
                                        <?php echo get_the_post_thumbnail($wheel->ID); ?>
                                    </a>
                                </div>
                                <div class="wheel-content">
                                    <a class="w-full inline-block" href="<?php echo get_the_permalink($wheel->ID,) ?>" class=" text-[24px] mb-[10px]"> <?php echo $wheel->post_title ?> </a>
                                    <span class="inline-block text-[16px] text-[#00000099] mt-[20px] mb-[15px]"> <?php echo get_the_terms($wheel->ID, "serie")[0]->name  ?> </span>
                                    <div class="flex">
                                        <a href="https://wheel-builder.forgiato.com/" class="customize-button ">
                                            <img src="<?php echo get_stylesheet_directory_uri()  ?>/assets/images/tools.svg"> Customize</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
    </section>
</main>
<script>
    jQuery(document).ready(() => {
        jQuery('#slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            asNavFor: '#slider-nav',
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }, ]
        });
        jQuery('#slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '#slider-for',
            dots: false,
            focusOnSelect: true,
            arrows: true,
            prevArrow: jQuery('.slider-nav .prev'),
            nextArrow: jQuery('.slider-nav .next'),
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }, ]
        });


        jQuery('#gallery').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            useTransform: false,
            arrows: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 3000,
            pauseOnFocus: false,
            pauseOnHover: false,
            prevArrow: jQuery('.buttons .prev'),
            nextArrow: jQuery('.buttons .next'),
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }, ]

        });
    })

    //Change the order of the images by click 
    //function changeImage(element) {
    //    let array = <?php echo json_encode($gallery); ?>;
    //    let main = document.querySelector(".main-image")
    //    let mainImage = document.querySelector(".main-image img").src
    //    let elementImage = element.querySelector("img").src

    //    function getKeyByValue(object, value) {
    //        return Object.keys(object).find(key =>
    //            object[key] === value);
    //    }
    //    currenKey = getKeyByValue(array, elementImage);

    //    element.innerHTML = `<img class="w-full h-full object-cover" src="${mainImage}" alt="">`
    //    main.innerHTML = `<img class="w-full h-full object-cover" src="${array[currenKey]}" alt="">`
    //}
</script>

<?php
get_footer();
?>