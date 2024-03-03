<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-activity">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg></div>
                            Transaction List
                    </h1>
                    <div class="page-header-subtitle">Make life simpler and easier with <b>ASG</b> and stay connected with family.</div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-calendar text-primary">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin"
                            placeholder="<?php echo date('F d,Y');?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 p-3">
                    <div class="row">
                        <?php
                        $bankname = array('Wallet'=>'Wallet Bank', 'SBI'=>'State Bank of India', 'BOI'=>'Bank Of India', 'BOM'=>'Bank Of Maharashtra', 'Kotal 811'=>'Kotal Mahindra Bank', 'HDFC'=>'HDFC Bank', 'Axis'=>'Axis Bank', 'ICICI'=>'ICICI Bank');
                        $bankbg = array('Wallet'=>'bg-gradient-primary-to-secondary', 'SBI'=>'bg-gradient-purple-to-violet', 'BOI'=>'bg-gradient-orange-to-yellow', 'BOM'=>'bg-gradient-orange-to-yellow', 'Kotal 811'=>'bg-gradient-green-to-teal', 'HDFC'=>'bg-gradient-primary-to-secondary', 'Axis'=>'bg-gradient-green-to-teal', 'ICICI'=>'bg-gradient-orange-to-yellow');
                        foreach($bank_list as $bank){
                        ?>
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="h-100">
                                <div class="card mb-2 <?= $bankbg[$bank->bank];?> p-3" style="min-height: 150px;">
                                    <h6 class="text-white"><?= $bankname[$bank->bank];?></h6>
                                    <h4 class="text-white text-center my-3" style="letter-spacing: 4px;">xxxx xxxx xxxx <?= rand(1111, 9999);?></h4>
                                    <h6 class="text-white">
                                        <?= $this->session->userdata('user_data')->name;?>
                                        <span style="float: right;"><?= date("m/y");?></span>
                                    </h6>
                                    <h1 class="text-white text-end mb-0">&#8377; <?= (int)$bank->balance;?>/-</h1>
                                </div>
                                <!-- <hr> -->
                                <div class="px-2">
                                    <table class="table table-sm table-striped" style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Perticular</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($bank->transation_list as $list){
                                            $text_color = ($list->type == 'Credit') ? 'text-success' : 'text-danger';
                                        ?>
                                        <tr>
                                            <td nowrap><?= date('d-m-Y', strtotime($list->date));?></td>
                                            <td><?= $list->perticular;?></td>
                                            <td nowrap class="<?= $text_color;?>"><?= $list->amount;?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        if(empty($bank_list)){
                        ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="card h-100">
                                <div class="card bg-gradient-primary-to-secondary p-3" style="min-height: 150px;">
                                    <h6 class="text-white">ASG Bank ATM</h6>
                                    <h4 class="text-white text-center my-3" style="letter-spacing: 4px;">xxxx xxxx xxxx <?= rand(1111, 9999);?></h4>
                                    <h6 class="text-white">
                                        <?= $this->session->userdata('user_data')->name;?>
                                        <span style="float: right;"><?= date("m/y");?></span>
                                    </h6>
                                    <h1 class="text-white text-end mb-0">&#8377; 00.00/-</h1>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="baModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="baLabel">Add</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" autocomplete="off" id="baForm">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="baTitle" class="form-label">Title</label>
                                <input type="text" name="baTitle" id="baTitle" class="form-control form-control-sm" placeholder="Title..." required>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="" class="form-label">Date</label>
                                <input type="date" name="baDate" id="baDate" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="baDescription" class="form-label">Description</label>
                                <input type="text" name="baDescription" id="baDescription" class="form-control form-control-sm" placeholder="Description...">
                            </div>
                            <div class="col-12 mb-2 box-repeat">
                                <label class="form-label">Repeat</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="radio" name="baRepeat" value="Once" id="baRepeat1"> <label for="baRepeat1">Once</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="baRepeat" value="Daily" id="baRepeat2"> <label for="baRepeat2">Daily</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="baRepeat" value="Monthly" id="baRepeat3"> <label for="baRepeat3">Monthly</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="baRepeat" value="Yearly" id="baRepeat4"> <label for="baRepeat4">Yearly</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <input type="hidden" name="baType" id="baType">
                                <button type="submit" class="btn btn-sm btn-outline-purple" id="baSubmitBtn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="cdLabel">Add</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" method="post" autocomplete="off" id="cdForm">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="form-label">Transaction</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="radio" name="cdType" value="Credit" id="cdType1"> <label for="cdType1" checked>Credit</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="cdType" value="Debit" id="cdType2"> <label for="cdType2">Debit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="cdDate" class="form-label">Date</label>
                                <input type="date" name="cdDate" id="cdDate" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="cdBank" class="form-label">Bank</label>
                                <select type="text" name="cdBank" id="cdBank" class="form-select form-select-sm" required>
                                    <?php
                                    $bank = array('Wallet', 'SBI', 'BOI', 'BOM', 'Kotal 811', 'HDFC', 'Axis', 'ICICI');
                                    for ($i=0; $i < 8; $i++) { 
                                        echo '<option>'.$bank[$i].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="cdAmount" class="form-label">Amount</label>
                                <input type="tel" name="cdAmount" id="cdAmount" class="form-control form-control-sm" placeholder="Amount..." required>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="cdPerticular" class="form-label">Perticular</label>
                                <input type="text" name="cdPerticular" id="cdPerticular" class="form-control form-control-sm" placeholder="Perticular..." required>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-sm btn-outline-purple" id="cdSubmitBtn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- calendar script -->
<script>
    function get_calender(month, year){
        $.ajax({
            url: '<?php echo base_url('Calendar/View');?>',
            method: 'post',
            dataType: 'json',
            data: {
                month:month,
                year:year
            },
            success: function(data){
                $('#calendar-hfour').html(data.hfour);
                $('#calendar-tbody').html(data.tbody);
                $('.timeline-xs').html(data.timeline);
                $('[data-bs-toggle="popover"]').popover({
                    container: 'body',
                    html: true
                });
            }
        });
    }

    $(document).on('click', '.eventLink', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var params = new URLSearchParams(url.split('?')[1]);
        var open_modal = params.get('m');
        var date = params.get('d');
        if(open_modal == 'Event' || open_modal == 'ToDo'){
            $('#baModal').modal('toggle');
            $('#baDate').val(date);
            $('#baType').val(open_modal);
            $('#baLabel').html('Add '+open_modal);
            $('#baRepeat4').attr('checked', true);
            $('.box-repeat').show();
        }else if(open_modal == 'Birthday' || open_modal == 'Anniversary'){
            $('#baModal').modal('toggle');
            $('#baDate').val(date);
            $('#baType').val(open_modal);
            $('#baLabel').html('Add '+open_modal);
            $('#baRepeat4').attr('checked', true);
            $('.box-repeat').hide();
        }else if(open_modal == 'Credit' || open_modal == 'Debit'){
            $('#cdModal').modal('toggle');
            $('#cdDate').val(date);
            $('#cdBank').val('Wallet');
            $('#cdLabel').html('Add '+open_modal);
            if(open_modal == 'Credit'){
                $('#cdType1').attr('checked', true);
            }else{
                $('#cdType2').attr('checked', true);
            }
        }
        $('[data-bs-toggle="popover"]').popover('hide');
    });
</script>
<!-- save events and credits script -->
<script>
    $('#baForm').on('submit', function(e){
        e.preventDefault();
        $('#baSubmitBtn').html('Save <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/SaveBACT')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#baSubmitBtn').html('Saved');
                    $('#baModal').modal('toggle');
                    $('#baForm')[0].reset();
                    // alert(response.message);
                } else {
                    $('#baSubmitBtn').html('Re-Submit');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });

    $('#cdForm').on('submit', function(e){
        e.preventDefault();
        $('#cdSubmitBtn').html('Save <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/SaveCreditDebit')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#cdSubmitBtn').html('Saved');
                    $('#cdModal').modal('toggle');
                    $('#cdForm')[0].reset();
                    // alert(response.message);
                } else {
                    $('#cdSubmitBtn').html('Re-Submit');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
</script>