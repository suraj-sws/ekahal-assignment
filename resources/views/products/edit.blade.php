<!-- Edit Product -->
<div id="load_popup_modal_contant" class="" role="dialog">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
                <div class="text-center mb-6">
                    <h4 class="mb-2">{{ $title }}</h4>
                </div>
                <form class="edit-products-record pt-0 row g-3" id="edit-products-record" method="POST" action="{{ url('/products/update') }}" onsubmit="return false;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['id'] }}" />
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select id="egroup_id" name="egroup_id" class="select2 form-select" data-allow-clear="true" required>
                                    <option value="" selected hidden disabled>Select</option>
                                    @foreach ($groups as $value)
                                    <option value="{{ $value['id'] }}" @selected($data['gid'] == $value['id'])>{{ $value['title'] }}</option>
                                    @endforeach
                                </select>
                                <label for="group_id">Group</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="description0" class="input-group-text"><i class='ri-house-line ri-18px'></i></span>
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" id="edescription" name="edescription" placeholder="Repairing charges masterdrives dc/ac drives" rows="2" aria-describedby="description0" rows="2" aria-describedby="description0" rows="3">{{ $data['description'] }}</textarea>
                                <label for="edescription">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-merge">
                            <span id="mlfb0" class="input-group-text"><i class="ri-code-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="emlfb" class="form-control" name="emlfb" placeholder="6SE7021-8TP60-Z" aria-label="6SE7021-8TP60-Z" aria-describedby="mlfb0" value="{{ $data['mlfb'] }}" />
                                <label for="emlfb">MLFB</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-merge">
                            <span id="hsn0" class="input-group-text"><i class="ri-code-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="ehsn" class="form-control" name="ehsn" placeholder="998717" aria-label="998717" aria-describedby="hsn0" value="{{ $data['hsn'] }}" />
                                <label for="ehsn">HSN Code</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-merge">
                            <span id="price0" class="input-group-text"><i class="ri-money-rupee-circle-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="eprice" class="form-control" name="eprice" placeholder="12000" aria-label="12000" aria-describedby="price0" value="{{ $data['price'] }}" />
                                <label for="eprice">Price Per Unit</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-merge">
                            <span id="quantity0" class="input-group-text"><i class="ri-luggage-cart-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="equantity" class="form-control" name="equantity" placeholder="100" aria-label="100" aria-describedby="quantity0" value="{{ $data['qty'] }}" />
                                <label for="equantity">Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Update</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var el = document.getElementById("edit-products-record");
    el && FormValidation.formValidation(el, {
        fields: {
            egroup_id: {
                validators: {
                    notEmpty: { message: "Please select group" }
                },
            },
            edescription: {
                validators: {
                    notEmpty: { message: "Please enter description" },
                },
            },
            emlfb: {
                validators: {
                    notEmpty: { message: "Please enter mlfb" },
                },
            },
            eprice: {
                validators: {
                    notEmpty: { message: "Please enter price" },
                    numeric: { message: "The value is not an numeric" },
                },
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".col-sm-6, .col-sm-12" }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: (e) => {
            e.on("plugins.message.placed", function (e) {
                e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
            });
            e.on("core.form.valid", function () {
                const formElement = e.form;
                const formAction  = formElement.getAttribute("action");
                const formData    = new FormData(formElement);
                formData.append('csrf_token', _token);
                $.unblockUI();
                fetch(formAction, {
                    method: "POST",
                    body: formData,
                    headers: {"X-CSRF-TOKEN": _token }
                }).then(function (response) {
                    $.unblockUI();
                    return response.json();
                }).then(function (res) {
                    if (typeof res.message === 'object' && res.message !== null ) {
                        var errorsHtml = '';
                        $.each(res.message, function(key, value) { errorsHtml += value + '<br/>'; });
                        Swal.fire({ html: errorsHtml, icon: "warning", showConfirmButton: false, timer: 2000 });
                    } else {
                        if (res.success) {
                            Swal.fire({ text: res.message, icon: "success", showConfirmButton: false, timer: 2000 });
                            setTimeout(function () { window.location.reload(); }, 2000);
                        } else {
                            Swal.fire({ text: res.message, icon: "warning", showConfirmButton: false, timer: 2000 });
                        }
                    }
                }).catch(function (error) {
                    $.unblockUI();
                    Swal.fire({ text: 'Oops. something went wrong please try again.!', icon: "error", showConfirmButton: false, timer: 2000 });
                });
            });
        },
    });
</script>