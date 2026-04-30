!(function () {
  document.querySelectorAll(".carousel").forEach((t) => {
    t.addEventListener("slide.bs.carousel", (e) => {
      e = $(e.relatedTarget).height();
      $(t).find(".active.carousel-item").parent().animate({ height: e }, 500);
    });
  });
})();
