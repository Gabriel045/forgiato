<?php
$footer = get_field('footer', 'option');
?>

<footer>
    <section class="bg-black">
        <div class="block_content  px-[30px] lg:px-[100px]  tablet:px-[150px]" style="padding-top:110px; padding-bottom:52px">
            <div class="flex flex-wrap lg:flex-nowrap gap-[20%]">
                <div class="w-full lg:w-[50%] text-center lg:text-start flex flex-col items-center lg:items-start">
                    <a href="<?php echo get_site_url() ?>"> <img class="w-[45px]" src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/logo-white.svg" alt=""> </a>
                    <p class="text-white mt-[50px] mb-[76px] font-[400] lg:w-[80%] text-start text-[16px]"><?php echo $footer['footer_text'] ?></p>
                    <div class="flex gap-[40px] justify-start">
                        <a class="text-[16px] text-white font-[400] flex cursor-pointer about">About Forgiato <img class="ml-[13px] mr-[2px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/footer-arrow.svg"></a>
                        <a class="text-[16px] text-white font-[400] flex cursor-pointer about">Warranty Information <img class="ml-[13px]  mr-[2px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/footer-arrow.svg"></a>
                    </div>
                </div>
                <div class="w-full lg:w-[50%] flex flex-col">
                    <p class="text-[#ffffff99] text-[16px] font-[400] mb-[40px]">Contact Us</p>
                    <div class="flex gap-[20px] flex-col">
                        <p class="text-white text-[16px] font-[400] flex gap-[21px]"> <img class="w-[18px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/letter.svg"> <?php echo $footer['email'] ?> </p>
                        <p class="text-white text-[16px] font-[400] flex gap-[21px]"> <img class="w-[18px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/pin.svg"> <?php echo $footer['direction'] ?> </p>
                        <p class="text-white text-[16px] font-[400] flex gap-[21px]"> <img class="w-[18px]" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/phone.svg"> <?php echo $footer['phone'] ?> </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center w-full mt-[140px]">
                <p class="text-white text-[16px] font-[400]">Copyright © 2022 · Forgiato</p>
            </div>
        </div>
    </section>

</footer>

<?php wp_footer(); ?>
</body>

</html>