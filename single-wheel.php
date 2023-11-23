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
$gallery            = get_field('gallery');
$sizes              = get_field('size');
$forging            = get_field('forging');
$car_slider         = get_field('car_slider');


//echo "<pre>";
//var_dump($query->posts);
//echo "</pre>";


?>

<main>
    <section>
        <div class="single_content">
            <div class="flex lg:justify-between lg:flex-row items-center flex-col gap-y-[50px]">
                <a href="/wheels" class="single-left flex items-center gap-[13px] cursor-pointer">
                    <img class="" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev.svg" alt="">
                    <span class="text-[20px] font-[400] tracking-[6.5px]">WHEEL’S PAGE</span>
                </a>
                <a href="<?php echo $next_post ?>" class="single-right flex items-center gap-[13px] cursor-pointer">
                    <span class="text-[20px] font-[400] tracking-[6.5px]">NEXT WHEEL</span>
                    <img class="" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg" alt="">
                </a>
            </div>
            <div class="main-image mt-[100px]">
                <?php echo the_post_thumbnail('full') ?>
            </div>
            <div class="mt-[20px] flex lg:gap-[20px] gap-[8px]">
                <?php foreach ($gallery as $key => $image) : ?>
                    <div class="w-1/3 border-[1px] border-[#00000033]">
                        <img class="w-full h-full object-cover" src="<?php echo $image ?>" alt="">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content" style="padding-top:0px">
            <div class="flex flex-wrap lg:flex-nowrap">
                <div class="w-full lg:w-[50%] mb-[50px] lgmb-0">
                    <h2><?php the_title() ?></h2>
                </div>
                <div class="w-full lg:w-[50%] flex gap-[38px] lg:justify-end flex-col lg:flex-row">
                    <a href="#" class="w-fit h-fit text-[18px] font-[600] py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer transform hover:translate-y-[2px]">
                        <img class="w-[20px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/doc.svg"> Request Quote
                    </a>
                    <a href="#" class="w-fit h-fit text-[18px] font-[600] py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer transform hover:translate-y-[2px]">
                        <img class="w-[20px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/pen.svg"> Customize
                    </a>
                </div>
            </div>
            <div class="mt-[100px] flex flex-col lg:flex-row lg:justify-between">
                <div class="lg:w-[430px] mb-[50px] lg:mt-0 flex gap-y-[50px] lg:gap-y-[100px] flex-col">
                    <div class="flex gap-[20px]">
                        <div>
                            <img class="h-full" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/wheel.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full">
                            <div class="flex justify-between">
                                <span class="text-[16px] text-[#00000099]">Wheel Series</span>
                                <a class="single-right-series cursor-pointer underline text-[16px] text-[#00000099]">Go to Series <span class="inline-block">></span> </a>
                            </div>
                            <div class="text-[18px] lg:text-[24px]">
                                <?php echo get_the_terms(get_the_ID(), "serie")[0]->name  ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-[20px]">
                        <div>
                            <img class="h-full" src=" <?php echo  get_stylesheet_directory_uri() ?>/assets/images/tag.svg" alt="">
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
                            <img class="h-full" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/forge.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full">
                            <div class="flex justify-between">
                                <span class="text-[16px] text-[#00000099]">Forging</span>
                                <a class="cursor-pointer underline text-[16px] text-[#00000099]">What is Forging?</a>
                            </div>
                            <div class="text-[18px] lg:text-[24px]">
                                <?php echo $forging ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-[20px]">
                        <div>
                            <img class="h-full" src=" <?php echo  get_stylesheet_directory_uri() ?>/assets/images/size-big.svg" alt="">
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
    </section>
    <section>
        <div class="block_content" style="padding-top:0px">
            <div class="relative flex justify-center">
                <div id="gallery" class="w-full md:w-[85%] lg:w-[90%]">
                    <?php foreach ($car_slider as $key => $car) : ?>
                        <div class="slick-slide relative">
                            <img class="w-full aspect-video	lg:h-[544px] object-cover" src="<?php echo $car["image"] ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="hidden md:flex buttons absolute  justify-between w-full top-[50%]" style="transform:translate(0% , -50%)">
                    <span class="inline-block  z-50 prev"> <img class="cursor-pointer" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/single-chevron-prev.svg" alt=""></span>
                    <span class="inline-block  z-50 next"> <img class="cursor-pointer" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg" alt=""></span>
                </div>
            </div>
            <div class="mt-[32px] lg:mt-[100px] flex justify-center items-center">
                <span class="text-[16px] text-[#00000099] mr-[30px]">Share wheel on</span>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["facebook"] ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/facebook.svg" alt=""> </a>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["google+"] ?>"> <img class="w-[22px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/google+.svg" alt=""> </a>
                <a target="_blank" class="mr-[20px] md:mr-[30px] hover:translate-y-[1px] transform" href="<?php echo $social_media["x"] ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/x.svg" alt=""> </a>
                <a target="_blank" class="hover:translate-y-[1px] transform" href="mailto:  <?php echo $mail ?>"> <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/mail.svg" alt=""> </a>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content" style="padding-top:0px">
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
                                    <a href="https://wheel-builder.forgiato.com/" class="py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer transform hover:translate-y-[2px]">
                                        <img src="<?php echo get_stylesheet_directory_uri()  ?>/assets/images/tools.svg"> Customize</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
    </section>
</main>
<script>
    jQuery(document).ready(() => {
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
</script>

<?php
get_footer();
?>

