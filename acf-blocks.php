<?php

//ACF Blocks
add_action('init', 'register_acf_blocks');

function register_acf_blocks()
{
    register_block_type(__DIR__ . '/blocks/hero');
    register_block_type(__DIR__ . '/blocks/new-arrivals');
    register_block_type(__DIR__ . '/blocks/gallery');
    register_block_type(__DIR__ . '/blocks/social');


}


