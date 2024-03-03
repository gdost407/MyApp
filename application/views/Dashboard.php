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
                            <?= $this->session->userdata('user_data')->name;?>
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
                    <!-- calendar table body & list -->
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <?php
                            $date = getdate();
                            $month = $date['mon'];
                            $year = $date['year'];
                            ?>
                            <h4 id="calendar-hfour">
                                <?php echo date("F Y");?>
                                <span style="float: right;">
                                    <?php
                                    $pm = $month - 1; $nm = $month + 1;
                                    if($pm == 0){ $pm = 12; $py = $year - 1; }else{ $py = $year; }
                                    if($nm == 13){ $nm = 1; $ny = $year + 1; }else{ $ny = $year; }
                                    ?>
                                    <button class="btn btn-sm btn-outline-purple py-1" onclick="get_calender('<?php echo $pm;?>', '<?php echo $py;?>')"><<</button>
                                    <button class="btn btn-sm btn-outline-purple py-1" onclick="get_calender('<?php echo $nm;?>', '<?php echo $ny;?>')">>></button>
                                </span>
                            </h4>
                            <table class="w-100">
                                <thead>
                                    <tr class="text-center">
                                    <th class="py-2">S</th>
                                    <th class="py-2">M</th>
                                    <th class="py-2">T</th>
                                    <th class="py-2">W</th>
                                    <th class="py-2">T</th>
                                    <th class="py-2">F</th>
                                    <th class="py-2">S</th>
                                    </tr>
                                </thead>
                                <tbody id="calendar-tbody">
                                    <?php
                                    $mday = $date['mday'];
                                    $mon = $date['mon'];
                                    $wday = $date['wday'];
                                    $month = $date['month'];
                                    $year = $date['year'];

                                    $dayCount = $wday;
                                    $day = $mday;
                                    
                                    while($day > 0) {
                                    $days[$day--] = $dayCount--;
                                    if($dayCount < 0)
                                        $dayCount = 6;
                                    }
                                    
                                    $dayCount = $wday;
                                    $day = $mday;
                                    
                                    if(checkdate($mon,31,$year))
                                    $lastDay = 31;
                                    elseif(checkdate($mon,30,$year))
                                    $lastDay = 30;
                                    elseif(checkdate($mon,29,$year))
                                    $lastDay = 29;
                                    elseif(checkdate($mon,28,$year))
                                    $lastDay = 28;
                                    
                                    while($day <= $lastDay) {
                                    $days[$day++] = $dayCount++;
                                    if($dayCount > 6)
                                        $dayCount = 0;
                                    }	
                                    
                                    $startDay = 0;
                                    $d = $days[1];
                                    
                                    echo '<tr class="text-center">';
                                    while($startDay < $d) {
                                        echo('<td></td>');
                                        $startDay++;
                                    }
                                    
                                    for ($d=1;$d<=$lastDay;$d++) {
                                        if(strlen($d)==1)
                                            $d="0".$d;
                                        $current_date = $year."-".sprintf('%02d', $mon)."-".$d;
                                        if($current_date == date("Y-m-d")){
                                        ?>
                                        <td class="py-2 text-danger fw-bold">
                                            <span style="cursor: pointer;" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-title="<?php echo date('F d,Y', strtotime($current_date));?>" data-bs-html="true" 
                                            data-bs-content="<ul><li><a href=&quot;view?m=Event&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Event</a></li><li><a href=&quot;view?m=ToDo&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>ToDo</a></li><li><a href=&quot;view?m=Birthday&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Birthday</a></li><li><a href=&quot;view?m=Anniversary&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Anniversary</a></li><li><a href=&quot;view?m=Credit&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Credit</a></li><li><a href=&quot;view?m=Debit&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Debit</a></li></ul>" aria-describedby="popover211727"><?php echo $d;?></span>
                                        </td>
                                        <?php
                                        }else{
                                            $textcolor = 'text-black';
                                            foreach ($month_events as $event) {
                                                if (date('d', strtotime($event->date)) == $d) {
                                                    if($event->type == 'Birthday')
                                                        $textcolor = 'text-green fw-bold text-decoration-underline';
                                                    if($event->type == 'Anniversary')
                                                        $textcolor = 'text-purple fw-bold text-decoration-underline';
                                                    if($event->type == 'Event')
                                                        $textcolor = 'text-blue fw-bold text-decoration-underline';
                                                    if($event->type == 'ToDo')
                                                        $textcolor = 'text-yellow fw-bold text-decoration-underline';
                                                    break; // No need to continue looping if an event is found for this date
                                                }
                                            }
                                        ?>
                                        <td class="py-2 <?php echo $textcolor;?>">
                                            <span style="cursor: pointer;" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-title="<?php echo date('F d,Y', strtotime($current_date));?>" data-bs-html="true" 
                                            data-bs-content="<ul><li><a href=&quot;view?m=Event&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Event</a></li><li><a href=&quot;view?m=ToDo&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>ToDo</a></li><li><a href=&quot;view?m=Birthday&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Birthday</a></li><li><a href=&quot;view?m=Anniversary&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Anniversary</a></li><li><a href=&quot;view?m=Credit&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Credit</a></li><li><a href=&quot;view?m=Debit&amp;d=<?php echo $current_date;?>&quot; class='eventLink nav-link'>Debit</a></li></ul>" aria-describedby="popover211727"><?php echo $d;?></span>
                                        </td>
                                        <?php
                                        }
                                        
                                        $startDay++;
                                        if($startDay > 6 && $d < $lastDay){
                                            $startDay = 0;
                                            echo '</tr>
                                                <tr class="text-center">';
                                        }
                                    }
                                    echo("</tr>");
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7 mb-2">
                            <div class="card-body px-0">
                                <div class="timeline timeline-xs">
                                    <?php
                                    foreach($event_list as $list){
                                        if($list->type == 'Birthday')
                                            $bg = 'bg-green';
                                        if($list->type == 'Anniversary')
                                            $bg = 'bg-purple';
                                        if($list->type == 'Event')
                                            $bg = 'bg-blue';
                                        if($list->type == 'ToDo')
                                            $bg = 'bg-yellow';
                                    ?>
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text"><?php echo date('d M', strtotime($list->date));?></div>
                                            <div class="timeline-item-marker-indicator <?= $bg; ?>"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <?php echo $list->type;?>!
                                            <a class="fw-bold text-dark" href="#!"><?php echo $list->title;?></a>
                                            <?php echo $list->description;?>.
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    if(empty($event_list)){
                                        echo '<center>
                                                <img src="https://media.istockphoto.com/id/1304870386/vector/planning-schedule-business-event-and-calendar-concept-people-with-schedule-pen-and-notes.jpg?s=612x612&w=0&k=20&c=KFN0SB9IB6bShsNHJLH69t2biCZ3BYYDn-O69KvKdNc=" style="max-width: 200px;">
                                            </center>';
                                    }
                                    // echo '<pre>';
                                    // print_r($event_list);
                                    // echo '</pre>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card bg-gradient-orange-to-yellow text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Calendar List</div>
                            <div class="text-lg fw-bold"><?= $calendar_count;?></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-check-square feather-xl text-white-50">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link"
                        href="<?= base_url('Calendar/List')?>">View List</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right"
                            aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card bg-gradient-green-to-teal text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Earnings (Monthly)</div>
                            <div class="text-lg fw-bold">&#8377; <?= $month_credit-$month_debit;?></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar feather-xl text-white-50">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link"
                        href="<?= base_url('Transaction/Monthly')?>">View
                        Report</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right"
                            aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card bg-gradient-primary-to-secondary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Earnings (Annual)</div>
                            <div class="text-lg fw-bold">&#8377; <?php echo $year_credit-$year_debit;?></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-dollar-sign feather-xl text-white-50">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link"
                        href="<?= base_url('Transaction/Annualy')?>">View
                        Report</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right"
                            aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Pending Requests</div>
                            <div class="text-lg fw-bold">17</div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-message-circle feather-xl text-white-50">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link"
                        href="">View
                        Requests</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right"
                            aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div> -->
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
            $('#baRepeat4').prop('checked', true);
            $('.box-repeat').show();
        }else if(open_modal == 'Birthday' || open_modal == 'Anniversary'){
            $('#baModal').modal('toggle');
            $('#baDate').val(date);
            $('#baType').val(open_modal);
            $('#baLabel').html('Add '+open_modal);
            $('#baRepeat4').prop('checked', true);
            $('.box-repeat').hide();
        }else if(open_modal == 'Credit' || open_modal == 'Debit'){
            $('#cdModal').modal('toggle');
            $('#cdDate').val(date);
            $('#cdBank').val('Wallet');
            $('#cdLabel').html('Add '+open_modal);
            if(open_modal == 'Credit'){
                $('#cdType1').prop('checked', true);
            }else{
                $('#cdType2').prop('checked', true);
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