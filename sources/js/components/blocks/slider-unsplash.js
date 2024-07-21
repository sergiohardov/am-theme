(function () {
  const acfBlockName = "slider-unsplash";

  var initializeBlock = function (block) {
    const swiper = new Swiper(".slider-unsplash__swiper", {
      loop: true,
      pagination: {
        el: ".slider-unsplash__swiper-pagination",
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
