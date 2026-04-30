(function ($) {
  "use strict";
  /**********************************************
   * Author      : Suraj Vishwakarma @<surajvishwakarma319@gmail.com>
   * Version     : 1.0
   * Last Update : 30-Apr-2026
  /**********************************************/
  let baseUrl = window.location.origin;
  let oops = "Oops. something went wrong please try again.!";
  /* Show || Hide Loading */
  const blockUI = (block = true) => {
    if (block) {
      $.blockUI({ message: '<div class="spinner-border text-white" role="status"></div>', css: { backgroundColor: "transparent", border: "0" }, overlayCSS: { opacity: 0.5 } });
    } else {
      $.unblockUI();
    }
  }
  /* Login */
  let loginAuthentication = document.querySelector("#loginAuthentication");
  /* Register */
  let registerForm = document.querySelector("#registerForm");
  
  document.addEventListener("DOMContentLoaded", function (e) {
    /* Login */
    loginAuthentication && FormValidation.formValidation(loginAuthentication, {
      fields: {
        email: {
          validators: {
            notEmpty: { message: "Please enter your login email" },
            emailAddress: { message: "Please enter valid email address" },
          },
        },
        password: {
          validators: {
            notEmpty: { message: "Please enter your password" },
            stringLength: {
              min: 6,
              message: "Password must be more than 6 characters",
            },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".mb-5", }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus(),
      },
      init: (e) => {
        e.on("plugins.message.placed", function (e) {
          e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
        });
        e.on("core.form.valid", function () {
          blockUI();
          const actionUrl = loginAuthentication.getAttribute("action");
          FormValidation.utils.fetch(`${actionUrl}`, {
            method: "POST",
            params: {
              email: loginAuthentication.querySelector('[name="email"]').value,
              password: loginAuthentication.querySelector('[name="password"]').value,
            },
            headers: { 'X-CSRF-TOKEN': loginAuthentication.querySelector('[name="_token"]').value, 'Content-Type': 'application/x-www-form-urlencoded' }
          }).then(function (response) {
            blockUI(false);
            let res = response;
            if (typeof res.message === 'object' && res.message !== null) {
              var errorsHtml = '';
              $.each(res.message, function (key, value) {
                errorsHtml += value + '<br/>';
              });
              Swal.fire({ html: errorsHtml, icon: "warning", showConfirmButton: false, timer: 5000 });
            } else {
              if (res.success) {
                const redirectUrl = res.redirectUrl;
                Swal.fire({ text: res.message, icon: "success", showConfirmButton: false, timer: 3000 });
                setTimeout(function () { window.location.href = redirectUrl; }, 3000);
              } else if (res.success == false) {
                Swal.fire({ text: res.message, icon: "warning", showConfirmButton: false, timer: 5000 });
              }
            }
          }).catch(function (error) {
            Swal.fire({ text: oops, icon: "error", showConfirmButton: false, timer: 5000 });
          });
        });
      },
    });
    /* Register */
    registerForm && FormValidation.formValidation(registerForm, {
      fields: {
        name: {
          validators: {
            notEmpty: { message: "Please enter your name" },
          },
        },
        email: {
          validators: {
            notEmpty: { message: "Please enter your email" },
            emailAddress: { message: "Please enter valid email address" },
          },
        },
        password: {
          validators: {
            notEmpty: { message: "Please enter your password" },
            stringLength: {
              min: 6,
              message: "Password must be more than 6 characters",
            },
          },
        },
        role: {
          validators: {
            notEmpty: { message: "Please select your role" },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".mb-5", }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus(),
      },
      init: (e) => {
        e.on("plugins.message.placed", function (e) {
          e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
        });
          e.on("core.form.valid", function () {
          const formElement = e.form;
          const formAction = formElement.getAttribute("action");
          const formData = new FormData(formElement);
          formData.append('csrf_token', registerForm.querySelector('[name="_token"]').value);
          blockUI();
          fetch(formAction, {
            method: "POST",
            body: formData,
            headers: { 'X-CSRF-TOKEN': registerForm.querySelector('[name="_token"]').value }
          }).then(function (response) {
            blockUI(false);
            return response.json();
          }).then(function (res) {
            if (typeof res.message === 'object' && res.message !== null) {
              var errorsHtml = '';
              $.each(res.message, function (key, value) {
                errorsHtml += value + '<br/>';
              });
              Swal.fire({ html: errorsHtml, icon: "warning", showConfirmButton: false, timer: 5000 });
            } else {
              if (res.success) {
                const redirectUrl = res.redirectUrl;
                Swal.fire({ text: res.message, icon: "success", showConfirmButton: false, timer: 3000 });
                setTimeout(function () { window.location.href = redirectUrl; }, 3000);
              } else {
                Swal.fire({ text: res.message, icon: "warning", showConfirmButton: false, timer: 5000 });
              }
            }
          }).catch(function (error) {
            blockUI(false);
            Swal.fire({ text: oops, icon: "error", showConfirmButton: false, timer: 5000 });
          });
        });
      },
    });
  });  
  /* Menu Active */
  document.addEventListener('DOMContentLoaded', () => {
    const currentURL = window.location.href;
    document.querySelectorAll('.menu-link').forEach(link => {
      if (link.href === currentURL) {
        let menuItem = link.closest('.menu-item');
        menuItem.classList.add('active');
        let parentMenuItem = menuItem.closest('.menu-sub');
        while (parentMenuItem) {
          parentMenuItem.parentElement.classList.add('open');
          parentMenuItem = parentMenuItem.parentElement.closest('.menu-sub');
        }
      }
    });
  });
  /* Status Active || Inactive */
  document.addEventListener("DOMContentLoaded", function () {
    $('body').on('click', '.ActiveStatus', function (e) {
      e.preventDefault();
      let _this = $(this);
      let ajax = _this.attr('data-ajax');
      let id = _this.attr('data-id');
      Swal.fire({
        text: "Are you sure to inactive this?",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, Inactive it!",
        customClass: {
          confirmButton: "btn btn-danger me-3 waves-effect waves-light",
          cancelButton: "btn btn-outline-secondary waves-effect"
        },
        buttonsStyling: !1
      }).then(function (t) {
        if (t.value) {
          blockUI();
          fetch(ajax, {
            method: "POST",
            body: `id=${id}`,
            headers: { "X-CSRF-TOKEN": _token, 'Content-Type': 'application/x-www-form-urlencoded' }
          }).then(function (response) {
            blockUI(false);
            return response.json();
          }).then(function (res) {
            if (typeof res.message === 'object' && res.message !== null) {
              var errorsHtml = '';
              $.each(res.message, function (key, value) {
                errorsHtml += value + '<br/>';
              });
              Swal.fire({ html: errorsHtml, icon: "warning", showConfirmButton: false, timer: 5000 });
            } else {
              if (res.success) {
                Swal.fire({ text: res.message, icon: "success", showConfirmButton: false, timer: 3000 });
                setTimeout(function () { window.location.reload(); }, 3000);
              } else {
                Swal.fire({ text: res.message, icon: "warning", showConfirmButton: false, timer: 5000 });
              }
            }
          }).catch(function (error) {
            blockUI(false);
            Swal.fire({ text: oops, icon: "error", showConfirmButton: false, timer: 5000 });
          });
        }
      })
    });
    $('body').on('click', '.InactiveStatus', function (e) {
      e.preventDefault();
      let _this = $(this);
      let ajax = _this.attr('data-ajax');
      let id = _this.attr('data-id');
      Swal.fire({
        text: "Are you sure to active this?",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, Active it!",
        customClass: {
          confirmButton: "btn btn-success me-3 waves-effect waves-light",
          cancelButton: "btn btn-outline-secondary waves-effect"
        },
        buttonsStyling: !1
      }).then(function (t) {
        if (t.value) {
          blockUI();
          fetch(ajax, {
            method: "POST",
            body: `id=${id}`,
            headers: { "X-CSRF-TOKEN": _token, 'Content-Type': 'application/x-www-form-urlencoded' }
          }).then(function (response) {
            blockUI(false);
            return response.json();
          }).then(function (res) {
            if (typeof res.message === 'object' && res.message !== null) {
              var errorsHtml = '';
              $.each(res.message, function (key, value) {
                errorsHtml += value + '<br/>';
              });
              Swal.fire({ html: errorsHtml, icon: "warning", showConfirmButton: false, timer: 5000 });
            } else {
              if (res.success) {
                Swal.fire({ text: res.message, icon: "success", showConfirmButton: false, timer: 3000 });
                setTimeout(function () { window.location.reload(); }, 3000);
              } else {
                Swal.fire({ text: res.message, icon: "warning", showConfirmButton: false, timer: 5000 });
              }
            }
          }).catch(function (error) {
            blockUI(false);
            Swal.fire({ text: oops, icon: "error", showConfirmButton: false, timer: 5000 });
          });
        }
      })
    });
  });
  if ($('.datepicker_all').length > 0) {
    $('.datepicker_all').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      orientation: "left auto",
    });
  }
})(jQuery);
