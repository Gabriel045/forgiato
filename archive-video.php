<?php

$args = array(
    'post_type' => 'video',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
);


$wp_query = new WP_Query($args);


get_header() ?>



<main>
    <section class="bg-background">
        <div class="block_content ">
            <div class="flex flex-wrap  gap-y-[50px] lg:gap-y-[18px]">
                <?php foreach ($wp_query->posts as $key => $car) :
                    $video_url = get_field("video_url", $car->ID); ?>
                    <div id="video-container" class="w-full justify-center flex  sm:w-1/2 lg:w-1/3 sm:px-[9px] relative">
                        <a href="<?php echo $video_url ?>" class="vp-a w-full">
                            <?php echo get_the_post_thumbnail($car->ID) ?>
                            <p class="text-white text-[24px] absolute bottom-[48px] left-[32px]"> <?php echo $car->post_title ?> </p>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

</main>




<?php get_footer() ?>