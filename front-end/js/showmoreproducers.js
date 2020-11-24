$(document).ready(() => {
  $(".showmore-producer").click((event) => {
    $(event.target).hide();
    $(".hidden-producer").slideDown();
  });
});
