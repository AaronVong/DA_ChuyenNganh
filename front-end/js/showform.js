$(document).ready(() => {
  $(".showform").click(() => {
    $(".order__form").slideDown();
  });

  $("input[name='location']").change((event) => {
    console.log("change location");
    const location = event.target.value;
    if (location === "other") {
      $("#address").slideDown();
    } else {
      $("#address").slideToggle();
    }
  });
});
