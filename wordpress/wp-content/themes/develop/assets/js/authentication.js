jQuery(function ($) {
  $("#open_form_register").click(function () {
    let args = {
      title: "Register",
      form: `
            <form class="text-left">
                <div class="form-group">
                    <label for="user_email">Email address</label>
                    <input type="email" class="form-control" id="user_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="user_name">Username</label>
                    <input type="text" class="form-control" id="user_name" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password">
                </div>
            </form>
        `,
      class: "submit_register",
    };
    openFormSweetAlert2(args);
  });

  $("#open_form_login").click(function () {
    let args = {
      title: "Login",
      form: `
            <form class="text-left">
                <div class="form-group hide">
                    <label for="user_email">Email address</label>
                    <input type="email" class="form-control" id="user_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="user_name">Username</label>
                    <input type="text" class="form-control" id="user_name" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Password">
                </div>
            </form>
        `,
      class: "submit_login",
    };
    openFormSweetAlert2(args);
  });

  function openFormSweetAlert2(args) {
    Swal.fire({
      title: args["title"],
      html: args["form"],
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: "Submit",
      cancelButtonText: "Cancel",
      customClass: {
        confirmButton: args["class"],
      },
    });

    $("#login_with_user_email").change(function () {
      if ($(this).is(":checked")) {
        $("#user_name").parent().addClass("hide");
        $("#user_email").parent().removeClass("hide");
        $(this).val("checked");
      } else {
        $("#user_name").parent().removeClass("hide");
        $("#user_email").parent().addClass("hide");
        $(this).val("");
      }
    });

    $(".submit_register").click(function () {
      callAjaxSweetAlert2();
    });

    $(".submit_login").click(function () {
      callAjaxSweetAlert2();
    });

    function callAjaxSweetAlert2() {
      // setup data
      let user_name = $("#user_name").val();
      let user_email = $("#user_email").val();
      let user_password = $("#user_password").val();
      let confirm_password = $("#confirm_password").val();

      $.ajax({
        url: params.ajaxurl,
        data: {
          action: "authentication",
          user_name: user_name,
          user_email: user_email,
          user_password: user_password,
          confirm_password: confirm_password,
        },
        type: "POST",
        success: function (response) {
          if (response.data == "register") {
            Swal.fire(
              "Good job!",
              "You have registered successfully.",
              "success"
            );
          }
          if (response.data == "login") {
            Swal.fire(
              "Good job!",
              "You have logged in successfully.",
              "success"
            );
            $('.require_nologin').parents('li').addClass('hide');
            $('.require_login').parents('li').removeClass('hide');
          }
        },
      });
    }
  }
});
