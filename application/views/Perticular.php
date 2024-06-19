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
                            Perticular Ledger
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
                            </svg>
                        </span>
                        <input class="form-control ps-0 pointer" id="" placeholder="<?= $show_date;?>" readonly onclick="$('#datePick').modal('toggle');">
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
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="card p-2" style="position: sticky; top: 4rem;">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <label for="">Financial Year</label>
                                        </div>
                                        <?php
                                        $yea = date('Y');
                                        for ($i=$yea-3; $i <= $yea; $i++) { 
                                            if($i == $year){
                                                echo '<div class="col mb-2 text-center">
                                                    <label for="y'.$i.'" class="yearclick border border-primary bg-primary text-white rounded-2 px-2 w-100">'.$i.'</label>
                                                    <input type="radio" value="'.$i.'" name="year" id="y'.$i.'" checked hidden>
                                                </div>';
                                            }else{
                                                echo '<div class="col mb-2 text-center">
                                                    <label for="y'.$i.'" class="yearclick border border-primary text-dark rounded-2 px-2 w-100">'.$i.'</label>
                                                    <input type="radio" value="'.$i.'" name="year" id="y'.$i.'" hidden>
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <div class="row">
                                        <div class="col-9 mb-2">
                                            <label for="">Financial Month</label>
                                        </div>
                                        <div class="col-3 mb-2 text-center">
                                            <label for="mall" class="monthclick border border-primary <?php echo ($month == 'All')? 'bg-primary text-white' : 'text-dark';?> rounded-2 px-2 w-100">All</label>
                                            <input type="radio" value="All" name="month" id="mall" <?php echo ($month == 'All')? 'checked' : '';?> hidden>
                                        </div>
                                        <?php
                                        for ($i=1; $i <= 12; $i++) {
                                            $j = date('M', strtotime($year.'/'.$i.'/1'));
                                            if($i == $month){
                                                echo '<div class="col-3 mb-2 text-center">
                                                    <label for="m'.$i.'" class="monthclick border border-primary bg-primary text-white rounded-2 px-2 w-100">'.$j.'</label>
                                                    <input type="radio" value="'.$i.'" name="month" id="m'.$i.'" checked hidden>
                                                </div>';
                                            }else{
                                                echo '<div class="col-3 mb-2 text-center">
                                                    <label for="m'.$i.'" class="monthclick border border-primary text-dark rounded-2 px-2 w-100">'.$j.'</label>
                                                    <input type="radio" value="'.$i.'" name="month" id="m'.$i.'" hidden>
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <div class="row">
                                        <div class="col-9 mb-2">
                                            <label for="">Perticular Type</label>
                                        </div>
                                        <div class="col-3 mb-2 text-center">
                                            <label for="pall" class="typeclick border border-primary <?php echo ($type == 'All')? 'bg-primary text-white' : 'text-dark';?> rounded-2 px-2 w-100">All</label>
                                            <input type="radio" value="All" name="type" id="pall" <?php echo ($type == 'All')? 'checked' : '';?> hidden>
                                        </div>
                                        <?php
                                        foreach($perticular_type as $list){
                                            if($list->perticular_type == $type){
                                                echo '<div class="col mb-2 text-center">
                                                    <label for="p'.$list->perticular_type.'" class="typeclick border border-primary bg-primary text-white rounded-2 px-2 w-100">'.$list->perticular_type.'</label>
                                                    <input type="radio" value="'.$list->perticular_type.'" name="type" id="p'.$list->perticular_type.'" checked hidden>
                                                </div>';
                                            }else{
                                                echo '<div class="col mb-2 text-center">
                                                    <label for="p'.$list->perticular_type.'" class="typeclick border border-primary text-dark rounded-2 px-2 w-100">'.$list->perticular_type.'</label>
                                                    <input type="radio" value="'.$list->perticular_type.'" name="type" id="p'.$list->perticular_type.'" hidden>
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <div class="w-100 text-end">
                                        <button class="btn btn-sm btn-purple" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-8 mb-2 h-100">
                            <div class="row">
                            <?php
                                $bankname = array('Wallet'=>'Wallet Bank', 'SBI'=>'State Bank of India', 'BOI'=>'Bank Of India', 'BOM'=>'Bank Of Maharashtra', 'Kotal 811'=>'Kotal Mahindra Bank', 'HDFC'=>'HDFC Bank', 'Axis'=>'Axis Bank', 'ICICI'=>'ICICI Bank');
                                $bankbg = array('Wallet'=>'bg-gradient-primary-to-secondary', 'SBI'=>'bg-gradient-purple-to-violet', 'BOI'=>'bg-gradient-orange-to-yellow', 'BOM'=>'bg-gradient-orange-to-yellow', 'Kotal 811'=>'bg-gradient-green-to-teal', 'HDFC'=>'bg-gradient-primary-to-secondary', 'Axis'=>'bg-gradient-green-to-teal', 'ICICI'=>'bg-gradient-orange-to-yellow');
                                foreach($bank_list as $bank){
                                ?>
                                <div class="col-sm-12 col-md-6 mb-2">
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
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($bank->transation_list as $list){
                                                    $text_color = ($list->type == 'Credit') ? 'text-success' : 'text-danger';
                                                ?>
                                                <tr id="rowline<?= $list->id;?>" onclick="get_transaction('<?= $list->id;?>')" style="cursor: pointer;">
                                                    <td nowrap><?= date('d-m-Y', strtotime($list->date));?></td>
                                                    <td><?= $list->perticular;?></td>
                                                    <td><?= $list->perticular_type;?></td>
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
                                <div class="col-sm-12 col-md-6">
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
        </div>
    </div>
</div>

<div class="modal fade" id="cdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="cdLabel">Update</h6>
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
                        <div class="col-6 mb-2">
                            <label for="cdPerticular" class="form-label">Perticular</label>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="search" list="pertypelist" name="cdPerticularType" id="cdPerticularType" class="form-control form-control-sm text-end border-0" value="Other" placeholder="Perticular Type..." oninput="this.value = this.value.replace(/\s/g, '')" required>
                            <datalist id="pertypelist">
                                <?php
                                foreach($perticular_type as $list){
                                    echo '<option value="'.$list->perticular_type.'">';
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-12 mb-2">
                            <input type="text" name="cdPerticular" id="cdPerticular" class="form-control form-control-sm" placeholder="Perticular..." required>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-check mb-1">
                                <label class="form-check-label" for="cdKaraz">
                                    <input class="form-check-input" name="cdKaraz" id="cdKaraz" type="checkbox" value="1" onclick="$('#karaz_user_box').toggle(''); $('#cdKarazuser').val('');">
                                    <span class="text-primary" style="cursor: pointer;">Karaz</span> Transaction
                                </label>
                            </div>
                        </div>
                        <div class="col-6 mb-2" style="display: none;" id="karaz_user_box">
                            <input type="search" list="karazuserlist" name="cdKarazuser" id="cdKarazuser" class="form-control form-control-sm" placeholder="Name of Person">
                            <datalist id="karazuserlist">
                                <?php
                                foreach($karaz_user as $list){
                                    echo '<option value="'.$list->karaz_user.'">';
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-12 mt-2">
                            <input type="hidden" name="cdid" id="cdid">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_transaction()">Delete</button>
                            <button type="submit" class="btn btn-sm btn-purple" id="cdSubmitBtn" style="float: right;">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- date picker -->
<div class="modal fade" id="datePick" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="cdLabel">Pickup Transaction Month</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="get">
                    <div class="row">
                        <?php
                        $yea = date('Y');
                        for ($i=$yea-3; $i <= $yea; $i++) { 
                            if($i == $year){
                                echo '<div class="col mb-2 text-center">
                                    <label for="y'.$i.'" class="yearclick border border-primary bg-primary text-white rounded-2 px-2 w-75">'.$i.'</label>
                                    <input type="radio" value="'.$i.'" name="year" id="y'.$i.'" checked hidden>
                                </div>';
                            }else{
                                echo '<div class="col mb-2 text-center">
                                    <label for="y'.$i.'" class="yearclick border border-primary text-dark rounded-2 px-2 w-75">'.$i.'</label>
                                    <input type="radio" value="'.$i.'" name="year" id="y'.$i.'" hidden>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row">
                        <?php
                        for ($i=1; $i <= 12; $i++) {
                            $j = date('M', strtotime($year.'/'.$i.'/1'));
                            if($i == $month){
                                echo '<div class="col-3 mb-2 text-center">
                                    <label for="m'.$i.'" class="monthclick border border-primary bg-primary text-white rounded-2 px-2 w-75">'.$j.'</label>
                                    <input type="radio" value="'.$i.'" name="month" id="m'.$i.'" checked hidden>
                                </div>';
                            }else{
                                echo '<div class="col-3 mb-2 text-center">
                                    <label for="m'.$i.'" class="monthclick border border-primary text-dark rounded-2 px-2 w-75">'.$j.'</label>
                                    <input type="radio" value="'.$i.'" name="month" id="m'.$i.'" hidden>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="w-100 text-end">
                        <button class="btn btn-sm btn-purple" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[type=radio][name=year]').change(function() {
            $('.yearclick').removeClass('bg-primary text-white').addClass('bg-white text-dark');
            $('label[for="' + $(this).attr('id') + '"]').removeClass('bg-white text-dark').addClass('bg-primary text-white');
        });

        $('input[type=radio][name=month]').change(function() {
            $('.monthclick').removeClass('bg-primary text-white').addClass('bg-white text-dark');
            $('label[for="' + $(this).attr('id') + '"]').removeClass('bg-white text-dark').addClass('bg-primary text-white');
        });

        $('input[type=radio][name=type]').change(function() {
            $('.typeclick').removeClass('bg-primary text-white').addClass('bg-white text-dark');
            $('label[for="' + $(this).attr('id') + '"]').removeClass('bg-white text-dark').addClass('bg-primary text-white');
        });

    });
    
    function get_transaction(id){
        $('#cdModal').modal('toggle');
        $.ajax({
            url: '<?php echo base_url('ApiController/GetTransactionDetails');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#cdid').val(data.message.id);
                    $('#cdAmount').val(data.message.amount);
                    $('#cdPerticular').val(data.message.perticular);
                    $('#cdPerticularType').val(data.message.perticular_type);
                    $('#cdDate').val(data.message.date);
                    $('#cdBank').val(data.message.bank);
                    $('#cdLabel').html('Update '+data.message.type);
                    $('#cdSubmitBtn').html('Update');
                    if(data.message.type == 'Credit'){
                        $('#cdType1').prop('checked', true);
                    }else if(data.message.type == 'Debit'){
                        $('#cdType2').prop('checked', true);
                    }
                    if(data.message.karaz == '1'){
                        $('#cdKaraz').prop('checked', true);
                        $('#karaz_user_box').show();
                        $('#cdKarazuser').val(data.message.karaz_user);
                    }else{
                        $('#cdKaraz').prop('checked', false);
                        $('#karaz_user_box').hide();
                        $('#cdKarazuser').val('');
                    }
                }else{
                    alert(data.message);
                    $('#cdModal').modal('toggle');
                }
            }
        });
    }

    function delete_transaction(){
        var id = $("#cdid").val();
        $.ajax({
            url: '<?php echo base_url('ApiController/DeleteTransaction');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#cdModal').modal('toggle');
                    $("#rowline"+id).toggle('slow');
                }else{
                    alert(data.message);
                }
            }
        });
    }
    
    $('#cdForm').on('submit', function(e){
        e.preventDefault();
        $('#cdSubmitBtn').html('Updating <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/UpdateTransaction')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#cdSubmitBtn').html('Updated');
                    $('#cdModal').modal('toggle');
                    $('#rowline'+response.data.id).html('<td>'+response.data.date+'</td><td>'+response.data.perticular+'</td><td>'+response.data.perticular_type+'</td><td>'+response.data.amount+'</td>');
                    $('#carddescription'+response.data.id).html(response.data.description);
                } else {
                    $('#cdSubmitBtn').html('Re-Update');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
</script>