<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <div class="container">
        <!--  Default Loop -->
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
                                the_content();
                            endwhile;
                        else :
                            echo _e('No Content Found');
                        endif;
        ?>
    </div>
    <?php wp_footer();?>
</body>
</html>