<?php

/**
 * Hero Block Template.
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
$title          = get_field('title') ?: 'Your Title here...';
$text           = get_field('paragraph');
$slider         = get_field('slider');
$button         = get_field('button');
$button2        = get_field('button2');


//echo "<pre>";
//var_dump($button);
//echo "</pre>";

?>

<section class="relative lg:h-[800px] h-[785px] lightgray overflow-x-hidden">
    <div class="absolute z-50  max-w-[1440px] w-full px-[30px] lg:px-[102px] abs-center ">
        <h1 class="lg:w-[75%]"> <?php echo $title ?> </h1>
        <p class="text-white lg:w-[72%] my-[50px]"> <?php echo $text ?> </p>
        <div class="flex gap-[15px] flex-wrap">
            <?php if (!empty($button['url']["url"])) : ?>
                <a href="<?php echo $button['url']["url"] ?>" class="white-button"><?php echo $button["url"]["title"] ?> </a>
            <?php endif ?>
            <?php if (!empty($button2['url']["url"])) : ?>
                <a href="<?php echo $button2['url']["url"] ?>" class="transparent-button"><?php echo $button2["url"]["title"] ?> </a>
            <?php endif ?>
        </div>
    </div>
    <div class="multiple-items lg:h-[800px] h-[785px] w-full">
        <?php foreach ($slider as $key => $item) : ?>
            <diV class="w-full slick-slide">
                <?php if ($item["images"]['type'] == "image") : ?>
                    <img class="w-full h-[800px] object-cover" src="<?php echo $item["images"]["url"] ?>" alt="">
                <?php elseif ($item["images"]['type'] == "video") : ?>
                    <video class="w-full h-[800px] object-fill" muted>
                        <source src="<?php echo $item["images"]['url'] ?>" type="video/mp4">
                    </video>
                <?php endif ?>
            </diV>
        <?php endforeach ?>
    </div>
</section>

<script>
    jQuery(".multiple-items").ready(() => {
        //Initializing the
        jQuery('.multiple-items').slick({
            infinite: true,
            useTransform: false,
            autoplay: true,
            arrows: false,
            dots: false,
            autoplaySpeed: 4000,
            fade: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            cssEase: 'linear',
        });

        function checkVideo() {
            if (document.querySelector(".slick-active video") != null) {
                let currentVideo = jQuery(".slick-active video")
                jQuery('.multiple-items').slick('slickPause')

                currentVideo[0].play()

                setTimeout(() => {
                    let duration = currentVideo[0].duration

                    setTimeout(() => {
                        jQuery('.multiple-items').slick('slickPlay')
                    }, duration * 1000 - 3500);

                }, 300);

            }
        }

        checkVideo()

        jQuery('.multiple-items').on('afterChange', function(event, slick, currentSlide) {
            checkVideo()
        });
    })
</script>