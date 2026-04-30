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
  let offCanvasEl; var t;
  t = document.getElementById("form-add-new-accounts"),
  setTimeout(() => {
    let e = document.querySelector(".create-new"),
    t = document.querySelector("#add-new-accounts");
    e && e.addEventListener("click", function() {
        offCanvasEl = new bootstrap.Offcanvas(t),
        offCanvasEl.show();
    })} , 200);
  var l;
  var e = $("#accounts_table"), r = (e.length && (l = e.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${baseUrl}/accounts/fetch`,
            type: "POST",
            complete: function() { blockUI(false); },
            data: function (d) { d.csrf_token = _token },
            headers: { 'X-CSRF-TOKEN': _token },
        },
        columns: [
            { data: "sno" },
            { data: "name" },
            { data: "email" },
            { data: "loginType" },
            { data: "created_at" },
            { data: "" }
        ],
        columnDefs: [{
            targets: -1,
            title: "Actions",
            orderable: !1,
            searchable: !1,
            render: function(e, t, a, s) {
                return `${(a.role != 'admin') ? '<a href="javascript:;" title="Delete" class="btn btn-icon btn-text-secondary rounded-pill delete-record"><i class="icon-base ri ri-delete-bin-7-line icon-md"></i></a>' : '' }`
            }
        }],
        order: [[0, "desc"]],
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        scrollY: "500px",
        scrollX: !0,
        scrollCollapse: true,
        displayLength: 10,
        language: {
            paginate: { next: '<i class="ri-arrow-right-s-line"></i>', previous: '<i class="ri-arrow-left-s-line"></i>' },
            processing: blockUI()
        },
        buttons: [{
            extend: "collection",
            className: "btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light",
            text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [{
                extend: "print",
                text: '<i class="ri-printer-line me-1" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },
                customize: function(e) {
                    $(e.document.body).css("color", config.colors.headingColor).css("border-color", config.colors.borderColor).css("background-color", config.colors.bodyBg),
                    $(e.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                }
            }, {
                extend: "csv",
                text: '<i class="ri-file-text-line me-1" ></i>Csv',
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }, {
                extend: "excel",
                text: '<i class="ri-file-excel-line me-1"></i>Excel',
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }, {
                extend: "pdf",
                text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }
        ]}],
        responsive: false
    }),
    $("div.head-label").html('<h5 class="card-title mb-0">Account’s Management</h5>')));
    /* Delete Module */
    (e.length && l.on('click', '.delete-record', function () {
        let closestRow  = $(this).closest('tr');
        let data        = l.row(closestRow).data();
        let id          = data['id'];
        if (id) {
            Swal.fire({
                text: "Are you sure to delete this?",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                customClass: { confirmButton: "btn btn-danger me-3 waves-effect waves-light", cancelButton: "btn btn-outline-secondary waves-effect" },
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    blockUI();
                    fetch(`${baseUrl}/accounts/delete`, {
                        method: "POST",
                        body: `id=${id}`,
                        headers: { "X-CSRF-TOKEN": _token, 'Content-Type': 'application/x-www-form-urlencoded' }
                    }).then(function (response) {
                        blockUI(false);
                        return response.json();
                    }).then(function (res) {
                        if (typeof res.message === 'object' && res.message !== null ) {
                            var errorsHtml = '';
                            $.each(res.message, function(key, value) { errorsHtml += value + '<br/>'; });
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
            }})
        }
    }));
})(jQuery);
