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
$form             = get_field('form');
$direction        = get_field('direction');
$phone            = get_field('phone');
$fax              = get_field('fax');
$mail             = get_field('mail');
$map_image        = get_field('map_image');


?>

<section class="bg-background">
    <div class="block_content">
        <h2 class="mb-[100px]">Contact Us</h2>
        <div class="flex lg:flex-nowrap flex-wrap gap-y-[100px] lg:gap-y-0">
            <div class="w-full lg:w-[70%]">
                <div class="lg:w-[473px]">
                    <div id="form">
                        <?php echo do_shortcode("$form") ?>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-[30%]">
                <div class="flex flex-col  gap-[20px]">
                    <h4 class="text-[18px] text-black font-[500]">Forgiato Inc.</h4>
                    <p class="text-[#00000099]"><?php echo $direction ?></p>
                    <p class="text-[#00000099]"><?php echo $phone ?></p>
                    <p class="text-[#00000099]"><?php echo $fax ?></p>
                    <p class="text-[#00000099]"><?php echo $mail ?></p>
                </div>
            </div>
        </div>
        <div class="mt-[100px] lg:mt-[150px]">
            <img class="w-full lg:h-[412px] lg:object-cover" src="<?php echo $map_image ?>" alt="">
        </div>
    </div>
</section>