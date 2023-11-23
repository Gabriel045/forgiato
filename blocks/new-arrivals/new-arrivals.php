<?php

/**
 * New Arrivals Block Template.
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
    'post_type' => 'wheel',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);
$wp_query = new WP_Query($args); ?>


<section>
    <div class="block_content">
        <div class="flex flex-col items-center">
            <h2><?php echo $title ?></h2>
            <p class="lg:w-[80%] text-[16px] lg:text-[18px] text-center mt-[30px]"><?php echo $headtitle  ?> </p>
        </div>
        <div class="flex flex-wrap mt-[100px] gap-y-[50px] lg:gap-y-[40px]">
            <?php foreach ($wp_query->posts as $key => $wheel) :
                $sizes = get_field("size", $wheel->ID); ?>
                <div class="w-full justify-center flex  sm:w-1/2 lg:w-1/4 sm:px-[12px]">
                    <div>
                        <div class="mb-[40px]">
                            <a class=" cursor-pointer" href="<?php echo get_the_permalink($wheel->ID,) ?>">
                                <?php echo get_the_post_thumbnail($wheel->ID); ?>
                            </a>
                        </div>
                        <div class="wheel-content">
                            <a class="w-full inline-block" href="<?php echo get_the_permalink($wheel->ID,) ?>" class=" text-[24px] mb-[10px]"> <?php echo $wheel->post_title ?> </a>
                            <span class="text-[16px] text-[#00000099]"> <?php echo get_the_terms($wheel->ID, "serie")[0]->name  ?> </span>
                            <div class="sizes my-[30px] flex items-center flex-wrap">
                                <span class="mr-[14px]">
                                    <img class="w-[14px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/size.svg" alt="">
                                </span>
                                <?php foreach ($sizes as $key => $size) : ?>
                                    <span class="text-[14px] text-[#00000099]"> <?php echo $size ?></span>
                                    <span class="last:hidden mx-[5px] text-[14px] text-[#00000099]"> - </span>
                                <?php endforeach ?>
                            </div>
                            <a href="<?php echo get_the_permalink($wheel->ID,) ?>" class="text-[16px] font-[400] after:content-['\203A'] hover:after:right-[-12px] after:absolute after:text-[30px] after:font-[300] after:top-[-12px] after:right-[-10px] relative ">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="flex justify-center  mt-[90px]">
            <a href="/wheels" class="black-button cursor-pointer">View all arrivals</a>

        </div>
    </div>
</section>

https://wordpress-659833-4069925.cloudwaysapps.com/
https://wordpress-659833-4069925.cloudwaysapps.com/wheels/
https://wordpress-659833-4069925.cloudwaysapps.com/wheel/blank-ra-slant-9-2/