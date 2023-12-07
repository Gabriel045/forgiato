<?php
get_header();
$args = array(
    'post_type' => 'vehicle',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'meta_query' => array(
        'relation' => 'AND',
    ),
);


//Get all wheels
$wheel_args = array(
    'post_type' => 'wheel',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post_status' => 'publish',
    'meta_query' => array(
        'relation' => 'AND',
    ),
);

//Get all model by Make 
global $wpdb;

$results = $wpdb->get_results($wpdb->prepare(
    "select wp2.meta_value as 'model' from wp_postmeta  wp 
    INNER jOIN wp_postmeta wp2  on (wp.post_id  = wp2.post_id  and wp2.meta_key  = 'details_model')
    where  wp.meta_key  = 'details_make'
    AND wp.meta_value  like %s ",
    sanitize_text_field($_POST['make']),
));

$models = json_decode(json_encode($results), true);


//filter by make
if (!empty($_POST["make"]) && $_POST["make"] != "all") {
    array_push($args['meta_query'], array(
        'key' => 'details_make',
        'value' => sanitize_text_field($_POST['make']),
    ));
}

//filter by model
if (!empty($_POST["model"]) && $_POST["model"] != "all") {

    //check if the model exits for the selected make
    foreach ($results as $key => $model) {
        if ($model->model == $_POST["model"]) {
            array_push($args['meta_query'], array(
                'key' => 'details_model',
                'value' => sanitize_text_field($_POST['model']),
            ));
        }
    }
}

//filter by whhel 
if (!empty($_POST["wheels"]) && $_POST["wheels"] != "all") {
    array_push($args['meta_query'], array(
        'key' => 'wheel',
        'value' => serialize([$_POST['wheels']]),
    ));
}


//filter by REF
if (!empty($_POST["ref"])) {
    array_push($args['meta_query'], array(
        'key' => 'details_ref',
        'value' => sanitize_text_field($_POST['ref']),
    ));
}

$wp_query = new WP_Query($args);

$wp_query_wheel = new WP_Query($wheel_args);

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
?>

<section class="gallery-archive  bg-background">
    <div class="block_content ">
        <div id="search" class="flex row justify-between flex-wrap gap-y-[30px]">
            <form id="form-make" class="flex flex-row flex-wrap gap-y-[10px]  gap-[60px] items-center justify-start" method="POST">
                <div class="">
                    <span class="mr-[5px]">Make</span>
                    <select id="select_make" name="make" class="filter_select" filtercat="make">
                        <option value="all">Select Make</option>
                        <option value="Acura">Acura</option>
                        <option value="Alfa Romeo">Alfa Romeo</option>
                        <option value="Aston Martin">Aston Martin</option>
                        <option value="Audi">Audi</option>
                        <option value="Bentley">Bentley</option>
                        <option value="Bmw">Bmw</option>
                        <option value="Bugatti">Bugatti</option>
                        <option value="bBuick">Buick</option>
                        <option value="cadillac">Cadillac</option>
                        <option value="can Am">Can Am</option>
                        <option value="Celebrity Rides">Celebrity Rides</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Chrysler">Chrysler</option>
                        <option value="Dodge">Dodge</option>
                        <option value="Donk">Donk</option>
                        <option value="Dually">Dually</option>
                        <option value="Ferrari">Ferrari</option>
                        <option value="Fisker">Fisker</option>
                        <option value="Ford">Ford</option>
                        <option value="Hummer">Hummer</option>
                        <option value="Infiniti">Infiniti</option>
                        <option value="Jaguar">Jaguar</option>
                        <option value="Jeep">Jeep</option>
                        <option value="Lamborghini">Lamborghini</option>
                        <option value="Lexus">Lexus</option>
                        <option value="Lincoln">Lincoln</option>
                        <option value="Maserati">Maserati</option>
                        <option value="Maybach">Maybach</option>
                        <option value="Mclaren">Mclaren</option>
                        <option value="Mercedes-benz">Mercedes-benz</option>
                        <option value="Motorcycle">Motorcycle</option>
                        <option value="Nissan">Nissan</option>
                        <option value="Old School">Old School</option>
                        <option value="Oldsmobile">Oldsmobile</option>
                        <option value="Other Makes">Other Makes</option>
                        <option value="Pagani">Pagani</option>
                        <option value="Polaris">Polaris</option>
                        <option value="Pontiac">Pontiac</option>
                        <option value="Porsche">Porsche</option>
                        <option value="Range Rover">Range Rover</option>
                        <option value="Rivian">Rivian</option>
                        <option <?php echo ($_POST['make'] == "Rolls Royce") ? 'selected="selected"' : "" ?> value="Rolls Royce">Rolls Royce</option>
                        <option value="Tesla">Tesla</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Volvo">Volvo</option>
                    </select>
                </div>
                <div class="<?php echo (!empty($models)) ? "" : "hidden" ?>">
                    <span class="mr-[5px]">Model</span>
                    <select id="select_model" name="model" class="filter_select" filtercat="model">
                        <option value="all">Select Model</option>
                        <?php foreach ($models as $key => $model) : ?>
                            <option <?php echo ($model["model"] == $_POST["model"]) ? 'selected="selected"' : "" ?> value="<?php echo $model["model"] ?>"><?php echo $model["model"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <span class="mr-[5px]">Wheel</span>
                    <select id="select_wheel" name="wheels" class="filter_select" filtercat="wheel">
                        <option value="all">Select Wheel</option>
                        <?php foreach ($wp_query_wheel->posts as $key => $wheel) : ?>
                            <option <?php echo ($wheel->post_title == $_POST["wheels"]) ? 'selected="selected"' : "" ?> value="<?php echo $wheel->ID ?>"> <?php echo $wheel->post_title ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

            </form>
            <div>
                <form id="form-ref" class="flex flex-nowrap" method="POST">
                    <input class="w-[70%] py-[10px] px-[25px] text-[16px] lg:text-[18px] bg-[#F8F8F8]" type="number" name="ref" id="ref" placeholder="Ref#">
                    <input class="form-button ml-[10px] text-[16px] lg:text-[18px]" style="margin-top:0;" type="submit" value="FIND">
                </form>
            </div>
        </div>
        <div class="flex flex-wrap mt-[100px] gap-y-[50px] lg:gap-y-[60px]">
            <?php foreach ($wp_query->posts as $key => $car) :
                $wheel_id = get_field("wheel", $car->ID)[0];
                $wheel_name =  get_the_title($wheel_id); ?>
                <div class="w-full justify-center flex  sm:w-1/2 lg:w-1/3 sm:px-[12px] relative">
                    <a class="link" href="<?php echo  get_permalink($car->ID) ?>">
                        <?php echo get_the_post_thumbnail($car->ID) ?>
                        <p class="text-white text-[24px] absolute bottom-[48px] left-[32px]"> <?php echo $car->post_title ?> </p>
                        <span class="text-[#ffffff99] absolute bottom-[20px] left-[32px] text-[16px]"> <?php echo $wheel_name  ?></span>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<script>
    let form = document.querySelector("#form-make")
    let selects = document.querySelectorAll("#form-make select")


    let post = <?php echo json_encode($_POST) ?>;
    let make = document.querySelector("#select_make")
    let model = document.querySelector("#select_model")
    let wheel = document.querySelector("#select_wheel")


    selects.forEach(element => {
        element.addEventListener("change", () => {
            form.submit()
        })
    });

    //show the previus value went the page load again
    if (post.make != undefined || post.make != null) {
        make.value = post.make
    }
    if (post.ref != undefined || post.ref != null) {
        document.querySelector('#form-ref input[type="number"]').value = post.ref
    }
    if (post.wheels != undefined || post.wheels != null) {
        wheel.value = post.wheels
    }
</script>

<?php get_footer() ?>