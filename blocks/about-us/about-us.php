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
$hero_background      = get_field('hero')["background"];
$hero_title           = get_field('hero')["title"];
$two_columns          = get_field("two-colmuns");
?>

<section class="bg-background h-[725px]" style="background-position: center; background-repeat:no-repeat;
 background-size:cover; background-image:url('<?php echo $hero_background ?>')">
    <div class="block_content flex items-end" style="padding-bottom:90px;">
        <h2 class="text-white lg:w-[55%]"> <?php echo $hero_title ?></h2>
    </div>
</section>
<section class="bg-background">
    <div class="block_content">
        <?php foreach ($two_columns as $key => $section) :
            $image_position    = $section['image_position'];
            $image             = $section['image'];
            $title             = $section['title'];
            $paragraph         = $section['paragraph']; ?>

            <div class="mb-[100px] last:mb-0 direction flex flex-wrap lg:flex-nowrap gap-[40px] lg:gap-[50px] lg:flex-<?php echo $image_position ?> flex-col-reverse">
                <?php if (!empty($image)) : ?>
                    <div class="w-full lg:w-[45%]">
                        <img class="w-[350px] h-[286px] lg:w-[547px] lg:h-full lg:min-h-[425px]  object-cover" src="<?php echo $image ?>" alt="">
                    </div>
                <?php endif ?>

                <div class="<?php echo !empty($image) ? ' w-full lg:w-[50%]' : 'full' ?> relative lg:flex lg:flex-col  ">
                    <div class="h-full flex flex-col justify-center">
                        <h2 class=""> <?php echo $title ?> </h2>
                        <p class="text-[#00000099] mt-[50px]"><?php echo $paragraph ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>