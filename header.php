<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--<title>Forgiato</title>-->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header id="header_menu" class="overflow-x-clip flex justify-center relative ">
    <div class="hero max-w-[1440px] w-full  py-[25px] bg-white flex">
      <div class="w-[20%] lg:w-[10%] flex items-center">
        <a href="/home" class="logo">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo.svg" alt="">
</a>
      </div>
      <div class="hidden lg:flex items-center w-[95%] justify-end">
        <?php echo wp_nav_menu(array(
          'menu'   => 'Header menu',
        )); ?>
      </div>
      <div class="w-[80%] lg:hidden flex justify-end items-center">
        <span class="inline-block cursor-pointer menu-mobile">
          <div class="block lg:hidden" id="nav-icon4">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </span>
      </div>
    </div>


    <!-- mobile -->
    <div id="menu-mobile" class="bg-black absolute z-[60] w-full  menu-mobile-container block lg:hidden">
      <div class="div px-[40px] pb-[70px] pt-[180px]">
        <?php echo  wp_nav_menu(array(
          'menu'   => 'Header menu',
        ));  ?>
      </div>
    </div>

  </header>


  <script>
    setTimeout(() => {
      let mobile = document.querySelector(".menu-mobile")
      mobile.addEventListener('click', () => {
        console.log("click");
        document.querySelector(".menu-mobile-container").classList.toggle('active')
        document.querySelector("#nav-icon4").classList.toggle('open')
        document.querySelector(".logo").classList.toggle('open')
      })

    }, 1000);
  </script>