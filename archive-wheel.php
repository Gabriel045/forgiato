<?php
get_header();


$args = array(
    'post_type' => 'wheel',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'meta_query' => array(
        'relation' => 'OR',
    ),

);


//filter by Keyword
if (!empty($_POST['string'])) {

    global $wpdb;
    $term = strip_tags($_POST['string']);

    // Query to search in the series taxonony
    $results = $wpdb->get_results("SELECT wtr.object_id as 'ID'  From wp_terms wt
            inner  join wp_term_taxonomy wtt  on (wt.term_id  = wtt.term_id  and wtt.taxonomy  = 'serie') 
            inner join wp_term_relationships wtr  on (wtt.term_id  =  wtr.term_taxonomy_id)
            where wt.name  LIKE '%$term%' ", ARRAY_A);

    // Query to search in the post fields 
    $results2 = $wpdb->get_results("SELECT ID FROM wp_posts wp 
    LEFT JOIN wp_postmeta wpm   on (wp.ID  = wpm.post_id  and wpm.meta_key = 'release_year') 
    LEFT JOIN wp_postmeta wpm2  on (wp.ID  = wpm2.post_id  and wpm2.meta_key = 'design_type') 
    LEFT JOIN wp_postmeta wpm3  on (wp.ID  = wpm3.post_id  and wpm3.meta_key = 'material') 
    LEFT JOIN wp_postmeta wpm4  on (wp.ID  = wpm4.post_id  and wpm4.meta_key = 'vehicle_type') 
    WHERE wp.post_type = 'wheel'
    AND wp.post_status = 'publish'
    AND ( wp.post_content like '%$term%' OR wp.post_title  like '%$term%' OR wp.post_name  like '%$term%' 
    OR wpm.meta_value  like '%$term%' OR wpm2.meta_value  like '%$term%'  OR wpm3.meta_value  like '%$term%' 
    OR wpm4.meta_value  like '%$term%')", ARRAY_A);


    // formating the object to and array 
    $post_ids = array_map(function ($single_array) {
        return $single_array['ID'];
    }, $results);

    $post_ids2 = array_map(function ($single_array) {
        return $single_array['ID'];
    }, $results2);


    // merge the two query results 
    $results_merge = $post_ids + $post_ids2;

    if (!empty($results_merge)) {
        //replace the original query
        $args = array(
            'post_type' => 'wheel',
            'post__in'  => $results_merge,
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        );
    } else {
        $args = array();
    }
};

//filter by catergory
if (!empty($_POST['series'])) {
    $args += [
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'serie',
                'field' => 'slug',
                'terms' => sanitize_text_field($_POST['series']),
            )
        ),
    ];
};

//filter by year (meta_query)
if (!empty($_POST['years'])) {
    $args['meta_query'] += [
        'relation' => 'OR',
        array(
            'key' => 'release_year',
            'value' => sanitize_text_field($_POST['years']),
        )
    ];
};

//filter by design (meta_query)
if (!empty($_POST['design'])) {
    array_push($args['meta_query'], array(
        'key' => 'design_type',
        'value' => sanitize_text_field($_POST['design']),
    ));
};


//filter by material (meta_query)
if (!empty($_POST['material'])) {
    array_push($args['meta_query'], array(
        'key' => 'material',
        'value' => sanitize_text_field($_POST['material']),
    ));
};


//filter by material (meta_query)
if (!empty($_POST['type'])) {
    array_push($args['meta_query'], array(
        'key' => 'vehicle_type',
        'value' => sanitize_text_field($_POST['type']),
    ));
};

$query   = new WP_Query($args);

$terms = get_terms(array(
    'taxonomy'   => 'serie',
    'hide_empty' => false,
));
?>

<section class="wheel-archive bg-background">
    <div class="block_content ">
        <div class="flex gap-[38px] relative">
            <div id="search-bar" class="lg:relative lg:w-[25%] bg-background border-[1px] border-[#00000033] py-[50px] px-[25px] h-fit">
                <img class="button-search lg:hidden block cursor-pointer" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/left-chevron.svg" alt="">
                <form id="text-search" class="flex flex-col" method="POST">
                    <input class="string-search pl-[40px] p-[10px] search-input rounded-[5px]" type="text" id="string" name="string" placeholder="Search..." style="outline: #000 auto 1px; ">
                    <input class="form-button " type="submit" value="SEARCH">

                </form>
                <form id="check-filters" class="flex flex-col mt-[50px] border-t-[1px] border-[#00000033]" method="POST">
                    <div class="section-container mt-[30px]">
                        <label class="label text-[#00000099] text-[16px] block relative cursor-pointer">Series</label>
                        <div class="container">
                            <div class="gap-[30px] flex flex-col">
                                <?php foreach ($terms as $key => $term) : ?>
                                    <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="series[]" value="<?php echo $term->slug ?>"><?php echo $term->name ?></label>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="section-container mt-[30px] py-[30px] border-t-[1px] border-[#00000033]">
                        <label class="label text-[#00000099] text-[16px]  flex cursor-pointer relative">Release Date Year</label>
                        <div class="container">
                            <div class="gap-[30px] flex flex-col">
                                <label class="w-1/2 flex gap-[10px] float-left"><input type="checkbox" name="years[]" value="2023">2023</label>
                                <label class="w-1/2 flex gap-[10px]"><input type="checkbox" name="years[]" value="2024">2024</label>
                            </div>
                        </div>
                    </div>
                    <div class="section-container flex flex-col  pt-[30px] border-t-[1px] border-[#00000033]">
                        <label class="label text-[#00000099] text-[16px] cursor-pointer relative">Design Type</label>
                        <div class="container">
                            <div class="gap-[30px] flex flex-col">
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Mesh">Mesh</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Full Face">Full Face</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="5 Spoke">5 Spoke</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="8 Spoke">8 Spoke</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Split 5 Spoke">Split 5 Spoke</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Directional">Directional</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Multi Spoke">Multi Spoke</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="design[]" value="Concave">Concave</label>
                            </div>
                        </div>
                    </div>
                    <div class="section-container mt-[30px] py-[30px] border-t-[1px] border-[#00000033]">
                        <label class="label text-[#00000099] text-[16px] flex cursor-pointer relative">Material</label>
                        <div class="container">
                            <div class="gap-[30px] flex flex-col">
                                <label class="w-1/2 flex gap-[10px]"><input type="checkbox" name="material[]" value="Flow Formed">Flow Formed</label>
                                <label class="w-1/2 flex gap-[10px]"><input type="checkbox" name="material[]" value="Forged">Forged</label>
                            </div>
                        </div>
                    </div>
                    <div class="section-container flex flex-col  py-[30px] border-y-[1px] border-[#00000033]">
                        <label class="label text-[#00000099] text-[16px] cursor-pointer relative">Vehicle Type</label>
                        <div class="container">
                            <div class="gap-[30px] flex flex-col">
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Exotic">Exotic</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Dually">Dually</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Truck">Truck</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Electric">Electric</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Muscle Car">Muscle Car</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="SUV">SUV</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Luxury">Luxury</label>
                                <label class="flex gap-[10px]"><input class="text-[16px]" type="checkbox" name="type[]" value="Motorcycle">Motorcycle</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-[25px]">
                        <input class="form-button" type="submit" value="APPLY">
                    </div>
                </form>
            </div>
            <div class="w-full lg:w-[75%]">
                <div class="relative">
                    <h2 class="text-black text-start lg:text-center mb-[80px] lg:mb-[120px]">WHEELS</h2>
                    <span class="button-search cursor-pointer block lg:hidden absolute top-[8px] right-0">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/filter.svg" alt="">
                    </span>

                </div>
                <div class="flex flex-wrap mt-[100px] gap-y-[50px] lg:gap-y-[60px]">
                    <?php foreach ($query->posts as $key => $wheel) : ?>
                        <div class="w-full justify-center flex  sm:w-1/2 lg:w-1/3 sm:px-[12px]">
                            <div>
                                <div class="mb-[40px]">
                                    <a class="related-wheels cursor-pointer" href="<?php echo get_the_permalink($wheel->ID,) ?>">
                                        <?php echo get_the_post_thumbnail($wheel->ID); ?>
                                    </a>
                                </div>
                                <div class="wheel-content">
                                    <a class="w-full inline-block" href="<?php echo get_the_permalink($wheel->ID,) ?>" class=" text-[24px] mb-[10px]"> <?php echo $wheel->post_title ?> </a>
                                    <span class="inline-block text-[16px] text-[#00000099] mt-[20px] mb-[15px]"> <?php echo get_the_terms($wheel->ID, "serie")[0]->name  ?> </span>
                                    <div class="flex">
                                        <a href="https://wheel-builder.forgiato.com/" class="customize-button ">
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
<script>
    let post = <?php echo json_encode($_POST) ?>;

    function markCheckbox(post) {

        if (post != undefined || post != null) {
            post.forEach(element => {
                let input = document.querySelector(`#check-filters input[value='${element}']`).checked = true;
            });
        }
    }
    markCheckbox(post.design)
    markCheckbox(post.material)
    markCheckbox(post.series)
    markCheckbox(post.type)
    markCheckbox(post.years)

    if (post.string != undefined || post.string != null) {
        document.querySelector(".string-search").value = post.string
    }


    let buttons = document.querySelectorAll(".button-search")
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            document.querySelector("#search-bar").classList.toggle("active")
        })
    });


    let label = document.querySelectorAll("#check-filters .label")
    label.forEach(element => {
        element.addEventListener("click", () => {
            let parent = element.parentElement;
            parent.classList.toggle("active")
        })
    });
</script>


<?php

get_footer();
