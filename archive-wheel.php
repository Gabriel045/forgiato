<?php
get_header();


$args = array(
    'post_type' => 'wheel',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
);

if (!empty($_GET['string'])) {
    $args += [
        's'              => strip_tags($_GET['string']),
        'search_columns' => array('post_content', 'post_name', 'post_title'),
    ];
};

$query = new WP_Query($args);


$terms = get_terms(array(
    'taxonomy'   => 'serie',
    'hide_empty' => false,
));

//echo"<pre>";
//var_dump($terms);
//echo "</pre>"; 

?>

<section class="wheel-archive">
    <div class="block_content ">
        <div class="flex gap-[25px]">
            <div class="w-[25%] bg-[#F5F5F5] p-[25px]">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/filter.svg" alt="">
                <form class="flex flex-col mt-[50px]">
                    <input class="pl-[40px] p-[10px] search-input " type="text" id="string" name="string" placeholder="Search...">
                    <input class="cursor-pointer transform hover:translate-y-[2px] bg-black py-[10px] px-[30px] text-white w-fit mt-[20px]" type="submit" metod="get" value="SEARCH">

                </form>
                <form class="flex flex-col mt-[50px] border-t-[1px] border-[#00000033]">
                    <div class="gap-[40px] flex flex-col mt-[50px]">
                        <label class="text-[#00000099] text-[16px]">Series</label>
                        <?php
                        foreach ($terms as $key => $term) : ?>
                            <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="series" value="<?php echo $term->name ?>"><?php echo $term->name ?></label>
                        <?php endforeach ?>
                    </div>
                    <div class="my-[50px] border-t-[1px] border-[#00000033]">
                        <label class="text-[#00000099] text-[16px] my-[50px] flex">Release Date Year</label>
                        <label class="w-1/2 flex gap-[10px] float-left"><input type="checkbox" name="years" value="2023">2023</label>
                        <label class="w-1/2 flex gap-[10px]"><input type="checkbox" name="years" value="2024">2024</label>
                    </div>
                    <div class="gap-[40px] flex flex-col mt-[50px] pt-[50px] border-t-[1px] border-[#00000033]">
                        <label class="text-[#00000099] text-[16px]">Design Type</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="Mesh">Mesh</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="Full Face">Full Face</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="5-poke">5 Spoke</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="8-spoke">8 Spoke</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="split-5-spoke">IL Moto</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="directional">Directional</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="multi-spoke">Multi Spoke</label>
                        <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design" value="concave">Concave</label>
                    </div>
                    <div class="my-[50px] border-t-[1px] border-[#00000033]">
                        <label class="text-[#00000099] text-[16px] my-[50px] flex">Material</label>
                        <label class="w-1/2 flex gap-[10px] float-left"><input type="checkbox" name="material" value="flow-formed">Flow Formed</label>
                        <label class="w-1/2 flex gap-[10px] justify-center"><input type="checkbox" name="material" value="forged">Forged</label>
                    </div>
                    <input class="cursor-pointer transform hover:translate-y-[2px] bg-black py-[10px] px-[30px] text-white w-fit mt-[20px]" type="submit" metod="get" value="APPLY">
                </form>
            </div>
            <div class="w-[75%]">
                <h1 class="text-black text-center mb-[150px]">WHEELS</h1>
                <h3 class="">lorem ipsum dolor contro</h3>
                <div class="flex flex-wrap mt-[100px] gap-y-[50px] lg:gap-y-[60px]">
                    <?php foreach ($query->posts as $key => $wheel) : ?>
                        <div class="w-full justify-center flex  sm:w-1/2 lg:w-1/3 sm:px-[12px]">
                            <div>
                                <div class="mb-[40px]">
                                    <a class=" cursor-pointer" href="<?php echo get_the_permalink($wheel->ID,) ?>">
                                        <?php echo get_the_post_thumbnail($wheel->ID); ?>
                                    </a>
                                </div>
                                <div class="wheel-content">
                                    <a class="w-full inline-block" href="<?php echo get_the_permalink($wheel->ID,) ?>" class=" text-[24px] mb-[10px]"> <?php echo $wheel->post_title ?> </a>
                                    <span class="inline-block text-[16px] text-[#00000099] mt-[20px] mb-[15px]"> <?php echo get_the_terms($wheel->ID, "serie")[0]->name  ?> </span>
                                    <div class="flex">
                                        <a class="py-[10px] px-[15px] border-[1px] border-black flex gap-[5px] cursor-pointer transform hover:translate-y-[2px]">
                                            <img src="<?php echo get_stylesheet_directory_uri()  ?>/assets/images/tools.svg"> Customize</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

</section>


<?php

get_footer();
