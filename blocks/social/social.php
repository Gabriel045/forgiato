<?php

/**
 * Hero Social Netwoks Template.
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
$items        = get_field('items');


?>

<section>
    <div class="block_content">
        <h2 class="letter-spacing text-center"><?php echo $title ?></h2>
        <div class="flex lg:justify-between lg:flex-row flex-col mt-[50px] lg:mt-[100px] gap-[50px] lg:gap-0">
            <?php foreach ($items as $key => $social) : ?>
                <div class="w-full lg:w-1/3 flex justify-center items-center gap-[23px]">
                    <img src="<?php echo $social['icon'] ?>" alt="">
                    <p style="font-size:18px !important;"> <?php echo $social['text'] ?> </p>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>