<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog your-service-s">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Service</h4>
            </div>
            <div class="modal-body">
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Service Name</label>
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Description</label>
                    </div>
                    <div class="col-xs-9">
                        <textarea type="text" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Category</label>
                    </div>
                    <div class="col-xs-9">
                        <select class="form-control">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                </div>
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Price</label>
                    </div>
                    <div class="col-xs-9">
                        <div class="input-icon pull-right">
                            <i>$</i>
                            <input type="text" class="form-control pull-right" />
                        </div>
                    </div>
                </div>
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Duration</label>
                    </div>
                    <div class="col-xs-9">
                        <div class="input-icon pull-right">
                            <select class="form-control">
                                <option>Select</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Deposit</label>
                    </div>
                    <div class="col-xs-9">
                        <div class="input-icon pull-right">
                            <i>$</i>
                            <input type="text" class="form-control pull-right" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn2">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog your-service-s">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-inline clearfix">
                    <div class="col-xs-3">
                        <label>Category</label>
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn2">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<section class="middle-container account-section your-service-s">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="sidenav-list">
                        <ul>
                            <li><a href="<?= site_url('scheduler'); ?>">Your Scheduler</a></li>
                            <li class="active"><a href="<?= site_url('services'); ?>">Your Services</a></li>
                        </ul>
                    </div>
                    <a class="green-btn" href="#">You Rentals</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix"><span>Services</span>
                                <div class="pull-right">
                                    <div class="tow-btn">
                                        <a class="btn2" data-toggle="modal" data-target="#myModal" href="#">Add Service</a>
                                        <a class="btn2" data-toggle="modal" data-target="#myModal2" href="#">Add Category</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Service</td>
                                                <td>Description</td>
                                                <td>Category</td>
                                                <td>Price</td>
                                                <td>Duration</td>
                                                <td>Deposit</td>
                                                <td>Deposit Edit</td>
                                            </tr>
                                            <tr>
                                                <td>Womens Hair Cut</td>
                                                <td>Hair cut wih blowdry and style</td>
                                                <td>Cuts</td>
                                                <td>$45</td>
                                                <td>1 hr</td>
                                                <td>$15</td>
                                                <td><i class="fa fa-edit" aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Womens Hair Cut</td>
                                                <td>Hair cut wih blowdry and style</td>
                                                <td>Cuts</td>
                                                <td>$45</td>
                                                <td>1 hr</td>
                                                <td>$15</td>
                                                <td><i class="fa fa-edit" aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Womens Hair Cut</td>
                                                <td>Hair cut wih blowdry and style</td>
                                                <td>Cuts</td>
                                                <td>$45</td>
                                                <td>1 hr</td>
                                                <td>$15</td>
                                                <td><i class="fa fa-edit" aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Womens Hair Cut</td>
                                                <td>Hair cut wih blowdry and style</td>
                                                <td>Cuts</td>
                                                <td>$45</td>
                                                <td>1 hr</td>
                                                <td>$15</td>
                                                <td><i class="fa fa-edit" aria-hidden="true"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>