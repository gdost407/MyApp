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
                            Calendar List
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
                    <div class="row row-cols-1 row-cols-md-auto">
                    <?php
                    if(empty($calendar_list)){
                        echo '<div class="col-12 col-md-4 col-xl-3 mb-2">
                        <div class="card h-100 bg-gradient-primary-to-secondary" style="cursor: pointer;">
                            <div class="card-body">
                                <h6 class="text-white" style="font-size: 80%;">'.date('F').'</h6> 
                                <h1 class="text-white" style="font-size: 150%;">'.date('d').'</h1>
                                <h5 class="text-white">A S G</h5>
                                <h6 class="text-white" style="font-size: 80%;">Explore more with ASG, add Birthday, Anniversary & many more.</h6>
                            </div>
                        </div>
                    </div>';
                    }
                    $i = 1;
                    foreach ($calendar_list as $list){
                        if($list->type == 'Birthday')
                            $bg = 'bg-gradient-primary-to-secondary';
                        if($list->type == 'Anniversary')
                            $bg = 'bg-gradient-orange-to-yellow';
                        if($list->type == 'Event')
                            $bg = 'bg-gradient-green-to-teal';
                        if($list->type == 'ToDo')
                            $bg = 'bg-gradient-purple-to-violet';
                    ?>
                    <div class="col-6 col-md-4 col-xl-3 mb-2" id="cardbox<?= $list->id;?>">
                        <div class="card h-100 <?= $bg;?>" onclick="get_event('<?= $list->id;?>')" style="cursor: pointer;">
                            <div class="card-body">
                                <h6 class="text-white" style="font-size: 80%;"><span id="cardmonth<?= $list->id;?>"><?= date('F', strtotime($list->date));?></span> - <?= $list->type;?></h6> 
                                <h1 class="text-white" style="font-size: 150%;" id="carddate<?= $list->id;?>"><?= date('d', strtotime($list->date));?></h1>
                                <h5 class="text-white" id="cardtitle<?= $list->id;?>"><?= $list->title;?></h5>
                                <h6 class="text-white" style="font-size: 0%;" id="carddescription<?= $list->id;?>"><?= $list->description;?></h6>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
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
                    <h6 class="modal-title" id="baLabel">Update</h6>
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
                            <div class="col-12 mt-2">
                                <input type="hidden" name="baid" id="baid">
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_event()">Delete</button>
                                <button type="submit" class="btn btn-sm btn-purple" id="baSubmitBtn" style="float: right;">Update</button>
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
    function get_event(id){
        $('#baModal').modal('toggle');
        $.ajax({
            url: '<?php echo base_url('ApiController/GetEventDetails');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#baid').val(data.message.id);
                    $('#baTitle').val(data.message.title);
                    $('#baDescription').val(data.message.description);
                    $('#baDate').val(data.message.date);
                    $('#baLabel').html('Update '+data.message.type);
                    $('#baSubmitBtn').html('Update');
                    if(data.message.repeat_this == 'Once'){
                        $('#baRepeat1').prop('checked', true);
                    }else if(data.message.repeat_this == 'Daily'){
                        $('#baRepeat2').prop('checked', true);
                    }else if(data.message.repeat_this == 'Monthly'){
                        $('#baRepeat3').prop('checked', true);
                    }else if(data.message.repeat_this == 'Yearly'){
                        $('#baRepeat4').prop('checked', true);
                    }
                    if(data.message.type == 'Event' || data.message.type == 'ToDo'){
                        $('.box-repeat').show();
                    }else if(data.message.type == 'Birthday' || data.message.type == 'Anniversary'){
                        $('.box-repeat').hide();
                    }
                }else{
                    alert(data.message);
                    $('#baModal').modal('toggle');
                }
            }
        });
    }

    function delete_event(){
        var id = $("#baid").val();
        $.ajax({
            url: '<?php echo base_url('ApiController/DeleteEvent');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#baModal').modal('toggle');
                    $("#cardbox"+id).toggle('slow');
                }else{
                    alert(data.message);
                }
            }
        });
    }
    
    $('#baForm').on('submit', function(e){
        e.preventDefault();
        $('#baSubmitBtn').html('Updating <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/UpdateBACT')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#baSubmitBtn').html('Updated');
                    $('#baModal').modal('toggle');
                    $('#cardmonth'+response.data.id).html(response.data.month);
                    $('#carddate'+response.data.id).html(response.data.date);
                    $('#cardtitle'+response.data.id).html(response.data.title);
                    $('#carddescription'+response.data.id).html(response.data.description);
                } else {
                    $('#baSubmitBtn').html('Re-Update');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
</script>