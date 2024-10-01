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
                                        if($this->session->userdata('user_data')->id == $list->user_id){
                                    ?>
                                    <div class="timeline-item" id="cardbox<?= $list->id;?>">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text" id="carddm<?= $list->id;?>"><?php echo date('d M', strtotime($list->date));?></div>
                                            <div class="timeline-item-marker-indicator <?= $bg; ?>"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <?php echo $list->type;?>!
                                            <a class="fw-bold text-dark" id="cardtitle<?= $list->id;?>" onclick="get_event('<?= $list->id;?>')"><?php echo $list->title;?></a>
                                            <span id="carddescription<?= $list->id;?>"><?php echo $list->description;?></span>.
                                        </div>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="timeline-item" id="cardbox<?= $list->id;?>">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text" id="carddm<?= $list->id;?>"><?php echo date('d M', strtotime($list->date));?></div>
                                            <div class="timeline-item-marker-indicator <?= $bg; ?>"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <?php echo $list->type;?>!
                                            <a class="fw-bold text-dark" id="cardtitle<?= $list->id;?>"><?php echo $list->title;?></a>
                                            <span id="carddescription<?= $list->id;?>"><?php echo $list->description;?></span>.
                                        </div>
                                    </div>
                                    <?php
                                        }
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
    
    <div class="row">
        <div class="col-12">
            <!-- expence limit progress bar -->
            <?php
            $limit = $this->session->userdata('user_data')->month_limit;
            $expence = $month_debit;
            $percent = $percentshow = round(($expence/$limit)*100);
            // switch case for progress bar color 0-40%, 40-70%, 70-100%, above 100%
            switch($percent){
                case 0:
                    $bg = 'bg-primary';
                    break;
                case $percent <= 60:
                    $bg = 'bg-success';
                    break;
                case $percent <= 80:
                    $bg = 'bg-info';
                    break;
                case $percent <= 98:
                    $bg = 'bg-warning';
                    break;
                default:
                    $bg = 'bg-danger';
                    $percent = 100;
                    break;
            }
            ?>
            <div class="card card-progress mb-4">
                <div class="card-header text-dark">You used <span class="fw-bold"><?= $percentshow; ?></span>% of your Monthly Expense Limit.</div>
                <!-- <div class="card-body">This is an example of a card with a 100% completed progress bar.</div> -->
                <div class="progress rounded-0">
                    <div class="progress-bar <?= $bg; ?>" role="progressbar" style="width: <?= $percent; ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Bar chart example-->
            <div class="card mb-4">
                <div class="card-header">Monthly Expence</div>
                <div class="card-body">
                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="myBarChart" width="827" height="440" style="display: block; height: 160px; width: 301px;" class="chartjs-render-monitor"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Pie chart example-->
            <div class="card mb-4">
                <div class="card-header">Perticular Expence</div>
                <div class="card-body">
                    <div class="chart-pie"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="myPieChart" width="827" height="660" style="display: block; height: 240px; width: 301px;" class="chartjs-render-monitor"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
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
        <div class="col-lg-6 col-xl-3 mb-4">
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
        <div class="col-lg-6 col-xl-3 mb-4">
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
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-gradient-purple-to-violet text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Account Balance</div>
                            <div class="text-lg fw-bold">&#8377; <?php echo $account_balance;?></div>
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
                        href="<?= base_url('Transaction/AccountBalance')?>">View Balance</a>
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
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-sm btn-outline-purple" id="cdSubmitBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- update modal -->
<div class="modal fade" id="baModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="baLabel1">Update</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" id="baForm1">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="baTitle" class="form-label">Title</label>
                            <input type="text" name="baTitle" id="baTitle1" class="form-control form-control-sm" placeholder="Title..." required>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Date</label>
                            <input type="date" name="baDate" id="baDate1" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="baDescription" class="form-label">Description</label>
                            <input type="text" name="baDescription" id="baDescription1" class="form-control form-control-sm" placeholder="Description...">
                        </div>
                        <div class="col-12 mb-2 box-repeat">
                            <label class="form-label">Repeat</label>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" name="baRepeat" value="Once" id="baRepeat11"> <label for="baRepeat11">Once</label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="baRepeat" value="Daily" id="baRepeat12"> <label for="baRepeat12">Daily</label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="baRepeat" value="Monthly" id="baRepeat13"> <label for="baRepeat13">Monthly</label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="baRepeat" value="Yearly" id="baRepeat14"> <label for="baRepeat14">Yearly</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <input type="hidden" name="baid" id="baid1">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_event()">Delete</button>
                            <button type="submit" class="btn btn-sm btn-purple" id="baSubmitBtn1" style="float: right;">Update</button>
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

<!-- update event script -->
<script>
    function get_event(id){
        $('#baModal1').modal('toggle');
        $.ajax({
            url: '<?php echo base_url('ApiController/GetEventDetails');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#baid1').val(data.message.id);
                    $('#baTitle1').val(data.message.title);
                    $('#baDescription1').val(data.message.description);
                    $('#baDate1').val(data.message.date);
                    $('#baLabel1').html('Update '+data.message.type);
                    $('#baSubmitBtn1').html('Update');
                    if(data.message.repeat_this == 'Once'){
                        $('#baRepeat11').prop('checked', true);
                    }else if(data.message.repeat_this == 'Daily'){
                        $('#baRepeat12').prop('checked', true);
                    }else if(data.message.repeat_this == 'Monthly'){
                        $('#baRepeat13').prop('checked', true);
                    }else if(data.message.repeat_this == 'Yearly'){
                        $('#baRepeat14').prop('checked', true);
                    }
                    if(data.message.type == 'Event' || data.message.type == 'ToDo'){
                        $('.box-repeat').show();
                    }else if(data.message.type == 'Birthday' || data.message.type == 'Anniversary'){
                        $('.box-repeat').hide();
                    }
                }else{
                    alert(data.message);
                    $('#baModal1').modal('toggle');
                }
            }
        });
    }

    function delete_event(){
        var id = $("#baid1").val();
        $.ajax({
            url: '<?php echo base_url('ApiController/DeleteEvent');?>',
            method: 'post',
            dataType: 'json',
            data: {id:id},
            success: function(data){
                if(data.status){
                    $('#baModal1').modal('toggle');
                    $("#cardbox"+id).toggle('slow');
                }else{
                    alert(data.message);
                }
            }
        });
    }

    $('#baForm1').on('submit', function(e){
        e.preventDefault();
        $('#baSubmitBtn1').html('Updating <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
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
                    $('#baSubmitBtn1').html('Updated');
                    $('#baModal1').modal('toggle');
                    $('#carddm'+response.data.id).html(response.data.dm);
                    $('#cardtitle'+response.data.id).html(response.data.title);
                    $('#carddescription'+response.data.id).html(response.data.description);
                } else {
                    $('#baSubmitBtn1').html('Re-Update');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
<script>
    (Chart.defaults.global.defaultFontFamily = "Oleo Script"), 'system-ui';
    Chart.defaults.global.defaultFontColor = "#858796";

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + "").replace(",", "").replace(" ", "");
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
            dec = typeof dec_point === "undefined" ? "." : dec_point,
            s = "",
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return "" + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || "").length < prec) {
            s[1] = s[1] || "";
            s[1] += new Array(prec - s[1].length + 1).join("0");
        }
        return s.join(dec);
    }

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [<?php foreach($bargraph as $list){ echo '"'.$list->month.'",';} ?>],
            datasets: [{
                label: "Expence",
                backgroundColor: "rgba(88, 0, 232, 1)",
                hoverBackgroundColor: "rgba(88, 0, 210, 0.9)",
                borderColor: "#4e73df",
                data: [<?php foreach($bargraph as $list){ echo '"'.$list->amount.'",';} ?>],
                maxBarThickness: 25
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: "month"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: <?= $largeramount;?>,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return "₹ " + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": ₹ " + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>
<script>
    (Chart.defaults.global.defaultFontFamily = "Oleo Script"), 'system-ui';
    Chart.defaults.global.defaultFontColor = "#858796";

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: [<?php foreach($perticular_type as $list){ echo '"'.$list->perticular_type.'",';} ?>],
            datasets: [{
                data: [<?php foreach($perticular_type as $list){ echo '"'.$list->amount.'",';} ?>],
                backgroundColor: [<?php foreach($perticular_type as $list){ echo '"rgba('.$list->rgba.', 1)",';} ?>],
                hoverBackgroundColor: [<?php foreach($perticular_type as $list){ echo '"rgba('.$list->rgba.', 0.8)",';} ?>],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                // borderWidth: 1,
                // xPadding: 15,
                // yPadding: 15,
                // displayColors: false,
                // caretPadding: 10
            },
            legend: {
                display: true
            },
            // cutoutPercentage: 80
        }
    });
</script>