<?php

get_header();

$wheel_id            = get_field("wheel")[0];
$wheel_name          = get_the_title($wheel_id);
$ref                 = get_field("details")["ref"];
$car_slider          = get_field('gallery');
$make                = get_field("details")["make"];
$model               = get_field("details")["model"];


//echo "<pre>";
//var_dump($car_slider);
//echo "</pre>";
?>

<main class="bg-background">
    <section>
        <div class="block_content">
            <div>
                <h2 class="mb-[25px]"><?php the_title() ?></h2>
                <p class="text-[18px] text-[#00000099] mb-[10px]">ON <?php echo $wheel_name ?> wheels</p>
                <span class="text-[14px] text-[#00000099]">Ref#<?php echo $ref ?></span>
            </div>

            <div class="relative mt-[100px] flex flex-col items-center gap-[20px]">
                <div id="slider-for" class="w-full">
                    <?php foreach ($car_slider as $key => $image) : ?>
                        <div class="slick-slide relative">
                            <img class="w-full h-[350px] sm:h-[500px] md:h-[600px] lg:h-[830px] object-cover" src="<?php echo $image['image'] ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>

                <div id="slider-nav" class="w-full md:w-[85%] lg:w-[90%]">
                    <?php foreach ($car_slider as $key => $image) : ?>
                        <div class="slick-slide relative small-image border-[1px] border-[#00000033] cursor-pointer hover:border-[#000] hover:shadow-lg">
                            <img class="w-full h-[200px] md:h-[220px] lg:h-[285px] object-cover" src="<?php echo $image['image'] ?>" alt="">
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
        </div>
    </section>
    <section>
        <div class="block_content" style="padding-top:0px; padding-bottom:0px;">
            <div class="xl:px-[138px] wheel-image flex flex-wrap lg:flex-nowrap gap-y-[50px] lg:gap-y-0 bg-white">
                <div class="w-full lg:w-[40%]">
                    <?php echo get_the_post_thumbnail($wheel_id) ?>
                </div>
                <div class="w-full lg:w-[60%] flex flex-col justify-center">
                    <div class="flex gap-[20px] justify-between flex-wrap gap-y-[50px] lg:gap-y-0">
                        <div class="flex flex-col">
                            <div class="flex ">
                                <span class="text-[16px]">
                                    <h3> <?php echo $wheel_name ?> </h3>
                                </span>
                            </div>
                            <div class="text-[18px] lg:text-[18px] text-[#00000099]">
                                <?php echo get_the_terms($wheel_id, "serie")[0]->name  ?>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <a href="<?php echo get_permalink($wheel_id) ?>" class="black-button cursor-pointer h-fit">View More</a>
                        </div>
                    </div>
                    <div class="mt-[50px]">
                        <p><?php echo get_the_excerpt($wheel_id) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content" style="padding-top:0px">
            <div class="lg:px-[138px] pt-[150px] bg-white">
                <h4 class="text-[24px]">Related Galleries:</h4>
                <div class="mt-[50px]">
                    <form id="send-post" action="/gallery/" method="POST">
                        <input type="hidden" class="make" name="make">
                        <input type="hidden" class="model" name="model">
                        <input type="hidden" class="wheels" name="wheels">
                    </form>
                    <div class="px-[30px] py-[50px]  mb-[2px] bg-white">
                        <a id="make" class="flex justify-between cursor-pointer">
                            <p> <?php echo $make ?> Gallery</p>
                            <div class="relative prev cursor-pointer about">

                                <img class="black" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                                <img class="white absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                            </div>
                        </a>
                    </div>
                    <div class="px-[30px] py-[50px]  mb-[2px] bg-white">
                        <a id="model" class="flex justify-between cursor-pointer">
                            <p> <?php echo $make ?> <?php echo $model ?> Gallery</p>
                            <div class="relative prev cursor-pointer about">

                                <img class="black" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                                <img class="white absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                            </div>
                        </a>
                    </div>
                    <div class="px-[30px] py-[50px]  mb-[2px] bg-white">
                        <a id="wheels" class="flex justify-between cursor-pointer">
                            <p> <?php echo $wheel_name ?> Wheel Gallery</p>
                            <div class="relative prev cursor-pointer about">

                                <img class="black" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next.svg">
                                <img class="white absolute top-0 opacity-0" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/single-chevron-next-black.svg">
                            </div>
                        </a>
                    </div>
                </div>
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
            infinite: true,
            asNavFor: '#slider-nav',
            arrows: false,
            dots: false
        });
        jQuery('#slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '#slider-for',
            dots: false,
            focusOnSelect: true,
            arrows: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
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
    })
    let form = document.querySelector("#send-post")
    let make = document.querySelector("#make")
    let model = document.querySelector("#model")
    let wheels = document.querySelector("#wheels")

    make.addEventListener("click", () => {
        form.querySelector(".make").value = "<?php echo $make ?>"
        form.querySelector(".model").value = "all"
        form.querySelector(".wheels").value = "all"
        form.submit()
    })

    model.addEventListener("click", () => {
        form.querySelector(".make").value = "<?php echo $make ?>"
        form.querySelector(".model").value = "<?php echo $model ?>"
        form.querySelector(".wheels").value = "all"
        form.submit()
    })

    wheels.addEventListener("click", () => {
        form.querySelector(".make").value = "all"
        form.querySelector(".model").value = "all"
        form.querySelector(".wheels").value = "<?php echo $wheel_id ?>"
        form.submit()
    })
</script>

<?php
get_footer();
?>