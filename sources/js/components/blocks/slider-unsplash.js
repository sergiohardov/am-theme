(function () {
  const acfBlockName = "slider-unsplash";

  var initializeBlock = function (block) {
    const swiper = new Swiper(block.querySelector(".slider-unsplash__swiper"), {
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
      pagination: {
        el: block.querySelector(".slider-unsplash__swiper-pagination"),
        clickable: true,
      },
    });
  };

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction(
      `render_block_preview/type=${acfBlockName}`,
      function (block) {
        initializeBlock(block[0]);
      }
    );
  }

  // Find & initialize all blocks on page
  document.addEventListener("DOMContentLoaded", function () {
    var blocks = document.querySelectorAll(`.${acfBlockName}`);
    blocks.forEach(function (block) {
      initializeBlock(block);
    });
  });
})();
