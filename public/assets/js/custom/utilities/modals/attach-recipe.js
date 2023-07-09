"use strict";
var KTModalAttachRecipe = (function () {
    var t, e, n, a, o, i;
    return {
        init: function () {
            (i = document.querySelector("#kt_modal_attach_recipe")) &&
                ((o = new bootstrap.Modal(i)),
                (a = document.querySelector("#kt_modal_attach_recipe_form")),
                (t = document.getElementById("kt_modal_attach_recipe_submit")),
                (e = document.getElementById("kt_modal_attach_recipe_cancel")),
                (n = FormValidation.formValidation(a, {
                    fields: {
                        name: { validators: { notEmpty: { message: "Name is required" } } },
                        description: { validators: { notEmpty: { message: "Description is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                t.addEventListener("click", function (e) {
                    e.preventDefault(),
                        n &&
                            n.validate().then(function (e) {
                                console.log("validated!"),
                                    "Valid" == e
                                        ? (t.setAttribute("data-kt-indicator", "on"),
                                          (t.disabled = !0),
                                          setTimeout(function () {
                                              t.removeAttribute("data-kt-indicator"),
                                                  (t.disabled = !1),
                                                  Swal.fire({ text: "Form has been successfully submitted!", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }).then(
                                                      function (t) {
                                                          t.isConfirmed && o.hide();
                                                      }
                                                  );
                                                  document.getElementById("kt_modal_attach_recipe_form").submit();
                                          }, 2e3))
                                        : Swal.fire({
                                              text: "Sorry, looks like there are some errors detected, please try again.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: { confirmButton: "btn btn-primary" },
                                          });
                            });
                }),
                e.addEventListener("click", function (t) {
                    t.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                        }).then(function (t) {
                            t.value
                                ? (a.reset(), o.hide())
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                }));
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalAttachRecipe.init();
});
