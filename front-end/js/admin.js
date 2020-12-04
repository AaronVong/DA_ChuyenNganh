$(document).ready(() => {
  // hiệu ứng mở navbar
  $(".btn--widenav").click(() => {
    $(".navbar__nav").toggleClass("toggleNav");
    setTimeout(() => {
      $(".nav__items .links__text").toggleClass("toggleLinksText");
    }, 50);
    $(".fa-angle-double-right").toggleClass("rotate-arrow");
    $("#main,footer").toggleClass("toggleMargin");
  });

  // hiệu ứng admin menu
  $(".admin__avatar").click(() => {
    $(".admin__menu").slideToggle();
  });

  // bắt sự kiện cập nhật đơn hàng (trạng thái)
  $("#order-panel button").click((event) => {
    $.post(
      "admin.php?fnc=qldh",
      { ustatus: event.target.value, oid: event.target.getAttribute("oid") },
      function (data, status) {
        window.location.reload();
      }
    );
  });
});
