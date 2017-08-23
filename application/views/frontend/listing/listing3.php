<?php $this->load->view('frontend/include/user-header'); ?>

<section class="middle-container account-section listings-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-sm-2 left-sidebar">
                    <?php $this->load->view('frontend/include/listing-sidebar'); ?>
                </aside>
                <article class="col-sm-10 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default your-reservations">
                            <div class="panel-body">
                                <?php if(empty($pastReservations)){ ?>
                                <p>You have no past reservation history.</p>
                                <?php }else{ ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Space Name</th>
                                                <th>Professionals</th>
                                                <th>Pop In</th>
                                                <th>Pop Out</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($pastReservations as $rental){ ?>
                                            <tr>
                                                <td><?php echo $rental['title']; ?></td>
                                                <td><?php echo $rental['professionals']; ?></td>
                                                <td>
                                                    <?php echo date("M d, Y", strtotime($rental['checkIn'])); ?><?php echo ($rental['checkInTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['checkInTime'])):''; ?>
                                                </td>
                                                <td>
                                                    <?php echo date("M d, Y", strtotime($rental['checkOut'])); ?><?php echo ($rental['checkOutTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['checkOutTime'])):''; ?>
                                                </td>
                                                <td><h5><b><?= $rental['partnerStatus']; ?></b> </h5></td>
                                                <td><a href="<?= site_url('reservation-details/'.$rental['id']);?>">View</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('frontend/include/user-footer'); ?>
