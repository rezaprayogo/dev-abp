<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/flatpickr/flatpickr.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/noUiSlider/nouislider.min.css')}}">
        {{-- <link rel="stylesheet" href="{{asset ('resources/scss/dark/assets/scrollpyNav.scss') }}"> --}}
        {{-- @vite(['resources/scss/dark/assets/scrollpyNav.scss']) --}}
        @vite(['resources/scss/dark/assets/scrollspyNav.scss'])
        @vite(['resources/scss/light/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/dark/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_custom.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/custom_dt_custom.scss'])
        @vite(['resources/scss/light/assets/components/timeline.scss'])
        
        <!--  END CUSTOM STYLE FILE  -->

        <style>
            .toggle-code-snippet { margin-bottom: 0px; }
            body.dark .toggle-code-snippet { margin-bottom: 0px; }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <x-slot:scrollspyConfig>
        data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100"
    </x-slot>
    {{-- <div class="overlay"></div>
    <div class="cs-overlay"></div> --}}

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Document</li>
                <li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->        
    <div class="row layout-top-spacing">

        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Form Purchase Order</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 1.5%;">
                    <form class="row g-3 needs-validation" action="{{ route('purchase-order.store') }}"  method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">PO Muat</label>
                            <input name="po_muat" type="text" class="form-control" id="validationCustom01" placeholder="Masukkan PO Muat" required>
                            <div class="invalid-feedback">
                                Form PO Muat tidak boleh kosong
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">PO Kebun</label>
                            <input name="po_kebun" type="text" class="form-control" id="validationCustom01" placeholder="Masukkan PO Kebun" required>
                            <div class="invalid-feedback">
                                Form PO Kebun tidak boleh kosong
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">No PL</label>
                            <input name="no_pl" type="text" class="form-control" id="validationCustom01" placeholder="Masukkan PO Kebun" required>
                            <div class="invalid-feedback">
                                Form No PL tidak boleh kosong
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">SIMB</label>
                            <input name="simb" type="text" class="form-control" id="validationCustom01" placeholder="Masukkan SIMB jika perlu">
                        </div>                        
                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">Date</label>
                            <div class="input-group has-validation">
                                <input name="tgl_po" id="basicFlatpickr" value="2022-09-04" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Upload File PO from Customer</label>
                            <div class="mb-3">
                                <input name="file" accept=".jpg, .png, .pdf" class="form-control file-upload-input" style="height: 48px; padding: 0.75rem 1.25rem;" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Items</label>
                            <select class="form-select" name="items" id="item_barang" required>
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($barang as $brg)
                                    <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Customer</label>
                            <select class="form-select" id="validationDefault01" required>
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($customer as $cst)
                                    <option value="{{ $cst->id_penawaran }}">{{ $cst->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">PT Penerima</label>
                            <select class="form-select" id="cb_penerima" required>
                                <option disabled selected value="0">Pilih...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Estate</label>
                            <select name="id_est" class="form-select" id="cb_estate" required>
                                <option selected disabled value="0">Pilih...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Quantity Kapal Kayu</label>
                            <input name="qty" type="number" step="any" value="0" min="0" class="form-control" id="t_qty" placeholder="Masukkan quantity Contoh:1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Unit Price (IDR) Curah</label>
                            <input readonly name="price_curah" type="text" value="0" class="form-control" id="oa_kpl_kayu" placeholder="Masukkan Harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Amount (IDR) Curah</label>
                            <input readonly name="total_curah" type="text" value="0" class="form-control" id="am_kayu" placeholder="Masukkan Harga Total" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Quantity Kapal Container</label>
                            <input name="qty2" type="number" step="any" value="0" class="form-control" id="t_qty2" placeholder="Masukkan Quantity" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Unit Price (IDR) Container</label>
                            <input readonly name="price_container" type="text" value="0" class="form-control" id="oa_container" placeholder="Masukkan Harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Amount (IDR) Container</label>
                            <input readonly name="total_container" type="text" value="0" class="form-control" id="am_container" placeholder="Masukkan Harga Total" required>
                        </div>


                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Total Quantity</label>
                            <input readonly name="total_qty" step="any" type="number" value="0" class="form-control" id="total_qty" placeholder="Masukkan Quantity" required>
                        </div>

                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Total Amount (IDR)</label>
                            <input readonly name="total_all" type="text" value="0" class="form-control" id="total_all" placeholder="Masukkan Total Amount" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
        {{-- table po --}}
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Tabel Purchase Order</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="style-3" class="table style-3 dt-table-hover">
                                    <thead>
                                        <tr>
                                            <th> No PO </th>
                                            <th>No PO Kebun</th>
                                            <th>Nama Customer</th>
                                            <th class="text-center dt-no-sorting">Status</th>
                                            <th class="text-center dt-no-sorting">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($po as $p)
                                        <tr>
                                            <td>{{ $p->po_muat }}</td>
                                            <td>{{ $p->po_kebun }}</td>
                                            <td>{{ $p->nama_customer }}</td>
                                            <td class="text-center">{!! $p->status == 2 ? '<span class="shadow-none badge badge-success">Approved</span>' : ($p->status == 1 ? '<span class="shadow-none badge badge-warning">Not Approved</span>' : '') !!}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    {{-- <li><a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li> --}}
                                                    <li><a href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                                    {!! $p->status == 1 ? '<a href="'. route('purchase-order.approve', ['po_muat' => $p->po_muat]) .'" id="approve-link" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve" data-original-title="Approve"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></a>' : ($p->status == 2 ? '':'') !!}
                                                    <li><a href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>            

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script type="module" src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
        <script type="module" src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
        @vite(['resources/assets/js/forms/bootstrap_validation/bs_validation_script.js'])
        <script type="module" src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])
        {{-- @vite(['resources/assets/js/scrollspyNav.js']) --}}
        @vite(['resources/assets/js/scrollspyNav.js'])
        <script type="module" src="{{asset('plugins/table/datatable/datatables.js')}}"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script type='text/javascript'>
            $(document).ready(function() {
                
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0 // Set the number of decimal places to 0 for whole numbers
                });
                $('#validationDefault01').change(function() {
                    var selectedId = $(this).val();
                    // $('#sel_emp').find('option').not(':first').remove();
                    if (selectedId !== '') {
                        $.ajax({
                            url: "{{ route('getCustomerDetails', ['id' => ':id']) }}".replace(':id', selectedId),
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var data = response[0];
                                $("#cb_penerima").empty();
                                if (response.length > 0) {
                                    var defaultOption = "<option value='0' disabled selected required>Pilih...</option>";
                                    $("#cb_penerima").append(defaultOption);
                                    for (var i=0; i<response.length; i++) {
                                        var optVal = response[i].id_penawaran+''+response[i].id_pt_penerima;
                                        var option = "<option value='"+optVal+"' required>"+response[i].nama_penerima+"</option>";
                                        $("#cb_penerima").append(option); 
                                    }
                                }else{
                                    var option = "<option required value='"+response[i].id_penawaran+"'>"+response[i].nama_penerima+"</option>";
                                        $("#cb_penerima").append(option); 
                                }
                            },
                            error: function() {
                                console.log(response);
                            }
                        });
                    } else {
                        $('#cb_penerima').val('');
                        $('#cb_estate').val('');
                    }
                });
                $('#cb_penerima').change(function() {
                    var selectedId = $(this).val();
                    // $('#sel_emp').find('option').not(':first').remove();
                    if (selectedId !== '') {
                        $.ajax({
                            url: "{{ route('getEstateDetails', ['id' => ':id']) }}"
                                .replace(':id', selectedId),
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var data = response[0];
                                $("#cb_estate").empty();
                                if (response.length > 0) {
                                    var defaultOption = "<option value='0' disabled selected required>Pilih...</option>";
                                    $("#cb_estate").append(defaultOption);
                                    for (var i=0; i<response.length; i++) {
                                        var optVal = response[i].id_detail_ph;
                                        var option = "<option value='"+ optVal +"' required>"+response[i].estate+"</option>";
                                        $("#cb_estate").append(option); 
                                    }
                                }else{
                                    console.log("no data");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("AJAX Error: " + error);
                            }
                        });
                    } else {
                        $('#cb_estate').val('');
                    }
                });
                $('#cb_estate').change(function() {
                    var selectedId = $(this).val();
                    // $('#sel_emp').find('option').not(':first').remove();
                    if (selectedId !== '') {
                        $.ajax({
                            url: "{{ route('getDetailOA', ['id' => ':id']) }}"
                                .replace(':id', selectedId),
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var data = response[0];
                                $("#oa_kpl_kayu").empty();
                                $("#oa_container").empty();
                                if (response.length > 0) {
                                    // var defaultOption = "<option value='0' disabled selected required>Pilih...</option>";
                                    // $("#cb_estate").append(defaultOption);
                                    for (var i=0; i<response.length; i++) {
                                        // var optVal = response[i].id_penawaran+''+response[i].id_pt_penerima;
                                        // var option = "<option value='"+ optVal +"' required>"+response[i].estate+"</option>";
                                        $('#oa_kpl_kayu').val(formatter.format(response[i].oa_kpl_kayu));
                                        $('#oa_container').val(formatter.format(response[i].oa_container));
                                        var price_curah = response[i].oa_kpl_kayu;
                                        var price_container = response[i].oa_container;

                                        if (price_curah == 0 && price_container != 0) {
                                            $('input[name=qty]').attr("readonly","readonly");
                                            $('input[name="qty2"]').removeAttr("readonly");
                                            console.log('price_curah : '+ price_curah);
                                        }else if (price_container == 0 && price_curah != 0) {
                                            $('input[name=qty2]').attr("readonly","readonly");
                                            $('input[name="qty"]').removeAttr("readonly");
                                            console.log('price_container : '+ price_container);
                                        }else if(price_curah != 0 && price_container != 0){
                                            $('input[name="qty"]').removeAttr("readonly");
                                            $('input[name="qty2"]').removeAttr("readonly");                                            
                                        }
                                        // $("#cb_estate").append(option);
                                    }
                                }else{
                                    console.log("no data");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("AJAX Error: " + error);
                            }
                        });
                    } else {
                        $('#oa_kpl_kayu').val('');
                        $('#oa_container').val('');
                    }
                });

                $('#oa_kpl_kayu, #oa_container').val('Rp 0');

                function updateValues() {
                    var qty = parseFloat($('#t_qty').val()) || 0;
                    var qty2 = parseFloat($('#t_qty2').val()) || 0;
                    var oa_kpl_kayu = parseFloat($('#oa_kpl_kayu').val().replace(/\D/g, '')) || 0;
                    var oa_container = parseFloat($('#oa_container').val().replace(/\D/g, '')) || 0;
                    var am_container = qty2 * oa_container;
                    var am_kayu = qty * oa_kpl_kayu;
                    var total_qty = qty + qty2;
                    var total_all = am_container + am_kayu;

                    $('#total_qty').val(total_qty);
                    $('#am_kayu').val(formatter.format(am_kayu));
                    $('#am_container').val(formatter.format(am_container));
                    $('#total_all').val(formatter.format(total_all));
                }

                $('#t_qty, #t_qty2, #oa_kpl_kayu, #oa_container').on('input', updateValues);

                updateValues();                
                $('#approve-link').click(function() {

                    // Get the link's href attribute
                    var href = $(this).attr('href');

                    // Send a POST request to the href using AJAX
                    $.ajax({
                        type: 'POST',
                        url: href,
                        data: {
                            "_token": "{{ csrf_token() }}", // Include the CSRF token
                        },
                        success: function(response) {
                            // Handle the success response as needed
                            // For example, you can refresh the page or update UI elements
                            location.reload(); // Reload the page after approval
                        },
                        error: function(error) {
                            // Handle errors if any
                            console.error(error);
                        }
                    });
                });  
                $('input[type="number"]').on('click', function() {
                    // Check if the current value is 0
                    if ($(this).val() === '0' && $(this).attr('readonly')) {
                        // Clear the input field
                        $(this).val('0');
                    }else if($(this).val() === '0'){
                        $(this).val('');
                    }
                });
            });
        </script>

        <script type="module">
            // var e;
            const c1 = $('#style-1').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML=`
                    <div class="form-check form-check-primary d-block">
                        <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
                    </div>`
                },
                columnDefs:[{
                    targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return `
                        <div class="form-check form-check-primary d-block">
                            <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
                        </div>`
                    }
                }],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });
    
            multiCheck(c1);
    
            const c2 = $('#style-2').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML=`
                    <div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
                    </div>`
                },
                columnDefs:[ {
                    targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return `
                        <div class="form-check form-check-primary d-block new-control">
                            <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
                        </div>`
                    }
                }],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10 
            });
    
            multiCheck(c2);
    
            const c3 = $('#style-3').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10,
                "responsive": true
            });
    
            multiCheck(c3);
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>    