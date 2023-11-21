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
$title          = get_field('title') ;
$items        = get_field('items');


?>

<section>
    <div class="block_content">
        <h2><?php echo $title ?></h2>
        <div class="flex justify-between mt-[100px]"> 
            <?php foreach ($items as $key => $social) : ?>
                <div class="w-1/3 flex justify-center items-center gap-[23px]">
                        <img src="<?php echo $social['icon'] ?>" alt="">
                        <p class="text-[18px]"> <?php echo $social['text'] ?> </p>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>