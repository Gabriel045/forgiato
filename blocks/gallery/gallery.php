<?php

/**
 * New Gallery Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */


// Load values and assign defaults.
$title          = get_field('title');
$headtitle      = get_field('headtitle');


$args = array(
    'post_type' => 'vehicle',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);
$wp_query = new WP_Query($args);
//echo "<pre>";
//var_dump($wp_query->posts);
//echo "</pre>";

?>

<section class="bg-black">
    <div class="block_content">
        <h2 class="text-white mb-[30px]"> <?php echo $title ?> </h2>
        <p class="text-[18px] text-white text-center"> <?php echo $headtitle ?> </p>
        <div class="relative flex justify-center mt-[100px]">
            <div id="gallery" class="w-[90%]">
                <?php foreach ($wp_query->posts as $key => $car) : ?>
                    <div class="slick-slide relative">
                        <?php echo get_the_post_thumbnail($car->ID) ?>
                        <p class="text-white text-[24px] absolute bottom-[48px] left-[32px]"> <?php echo $car->post_title ?> </p>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="buttons absolute flex justify-between w-full top-[50%]" style="transform:translate(0% , -50%)">
                <span class="inline-block  z-50 prev"> <img class="cursor-pointer" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/prev.svg" alt=""></span>
                <span class="inline-block  z-50 next"> <img class="cursor-pointer" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/next.svg" alt=""></span>
            </div>
        </div>
        <div class="mt-[100px] flex justify-center">
            <a href="#" class="white-button w-fit">View all vehicles </a>
        </div>
    </div>
</section>


<script>
    jQuery(document).ready(() => {
        jQuery('#gallery').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            useTransform: false,
            arrows: true,
            prevArrow: jQuery('.buttons .prev'),
            nextArrow: jQuery('.buttons .next'),
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }, ]

        });
    })
</script>