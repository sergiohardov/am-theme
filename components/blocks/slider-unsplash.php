<section class="<?php echo $args['class']; ?>" <?php echo $args['anchor']; ?>>
    <?php if ($args['fields']['title']) { ?>
        <h2 class="slider-unsplash__title">
            <?php echo $args['fields']['title']; ?>
        </h2>
    <?php } ?>

    <?php if ($args['fields']['description']) { ?>
        <div class="slider-unsplash__description">
            <?php echo $args['fields']['description']; ?>
        </div>
    <?php } ?>

    <?php if ($args['slides']) { ?>
        <div class="slider-unsplash__swiper swiper">
            <div class="swiper-wrapper">
                <?php foreach ($args['slides'] as $slide) { ?>
                    <div class="slider-unsplash__swiper-slide swiper-slide">
                        <img src="<?php echo $slide['src'] ?>" alt="<?php echo $slide['alt'] ?>">
                    </div>
                <?php } ?>
            </div>

            <div class="slider-unsplash__swiper-pagination swiper-pagination"></div>
        </div>
    <?php } ?>
</section>