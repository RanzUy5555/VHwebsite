{{-- Creating supplier --}}
@if (url()->current() === route('admin.suppliers.index'))
    <div class="modal fade" id="m_supplier" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_supplier_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_supplier_header">
                    <h6 class="modal-title text-white" id="m_supplier_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="supplier_form" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="form-label">Company *</label>
                            <input type="text" class="form-control" name="company" placeholder="Company Name">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Manager *</label>
                            <input type="text" class="form-control" name="manager" placeholder="Complete Name">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Contact *</label>
                            <input type="number" min="0" class="form-control" name="contact">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_supplier btn-primary"
                        onclick="c_store('.supplier_form','.supplier_dt', 'admin.suppliers.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_supplier btn-primary"
                        onclick="c_update('.supplier_form','.supplier_dt', 'admin.suppliers.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if (url()->current() === route('admin.categories.index'))
    {{-- Creating category --}}
    <div class="modal fade" id="m_category" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_category_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_category_header">
                    <h6 class="modal-title text-white" id="m_category_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="category_form" autocomplete="off">
                        <label class="form-label">Enter Category *</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_category btn-primary"
                        onclick="c_store('.category_form','.category_dt', 'admin.categories.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_category btn-primary"
                        onclick="c_update('.category_form','.category_dt', 'admin.categories.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating category --}}
@endif

@if (url()->current() === route('admin.brands.index'))
    {{-- Creating brand --}}
    <div class="modal fade" id="m_brand" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_brand_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_brand_header">
                    <h6 class="modal-title text-white" id="m_brand_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="brand_form" autocomplete="off">
                        <label class="form-label">Enter Brand *</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_brand btn-primary"
                        onclick="c_store('.brand_form','.brand_dt', 'admin.brands.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_brand btn-primary"
                        onclick="c_update('.brand_form','.brand_dt', 'admin.brands.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating brand --}}
@endif

{{-- Creating payment_method --}}
@if (url()->current() === route('admin.payment_methods.index'))
    <div class="modal fade" id="m_payment_method" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_payment_method_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_payment_method_header">
                    <h6 class="modal-title text-white" id="m_payment_method_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="payment_method_form" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="form-label">Type *</label>
                            <input type="text" class="form-control" name="type"
                                placeholder="(Ex. Gcash, BDO, UnionBank)">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Account Name *</label>
                            <input type="text" class="form-control" name="account_name">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Account No. *</label>
                            <input type="text" class="form-control" name="account_no">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_payment_method btn-primary"
                        onclick="c_store('.payment_method_form','.payment_method_dt', 'admin.payment_methods.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_payment_method btn-primary"
                        onclick="c_update('.payment_method_form','.payment_method_dt', 'admin.payment_methods.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
@endif


@if (url()->current() === route('admin.municipalities.index'))
    {{-- Creating municipality --}}
    <div class="modal fade" id="m_municipality" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_municipality_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_municipality_header">
                    <h6 class="modal-title text-white" id="m_municipality_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="municipality_form" autocomplete="off">
                        <div class="form-group">
                            <label class="form-label">Enter Municipality *</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Fee (₱) *</label>
                            <input type="number" min="0" class="form-control" name="fee">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_municipality btn-primary"
                        onclick="c_store('.municipality_form','.municipality_dt', 'admin.municipalities.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_municipality btn-primary"
                        onclick="c_update('.municipality_form','.municipality_dt', 'admin.municipalities.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating category --}}
@endif
