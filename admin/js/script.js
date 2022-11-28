$(function () {
  let userId, imageName, imageSplit;

  $(".modal_thumbnails").click(function () {
    $(this).addClass("selected");
    $("#set_user_image").prop("disabled", false);
    userId = $("#userId").attr("value");
    imageSplit = $(this).prop("src").split("/");
    imageName = imageSplit[imageSplit.length - 1];
  });

  $(".close").click(function () {
    $("#set_user_image").prop("disabled", true);
  });

  $("#set_user_image").click(function () {
    $.ajax({
      url: "includes/ajax.php",
      data: { imageName: imageName, userId: userId },
      method: "POST",
      success: function (data) {
        $("#userId").prop("src", data);
      },
    });
  });
});
