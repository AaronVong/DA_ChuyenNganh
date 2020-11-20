$(document).ready(() => {
  const $hamburger = $(".hamburger");
  $hamburger.click(function () {
    $("#navbar--sfloor").slideToggle();
  });
});
