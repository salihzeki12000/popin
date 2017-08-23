<section class="middle-container wish-lists">
    <div class="container">
        <div class="row">
            <div class="wish-heading clearfix">
                <div class="pull-left">
                    <h2>Wish Lists</h2>
                </div>
                <div class="pull-right">
                    <a class="gost-btn" href="#" data-toggle="modal" data-target="#wishlistModal">Create a Wish List</a>
                </div>
            </div>
            <?php if(!empty($userWishLists)): ?>
            <div class="wishlist-list">
                <h3>Your lists<span class="view_all pull-right"><?= count($userWishLists);?> lists</span></h3>
                <ul class="clearfix">
                    <?php foreach($userWishLists as $wishlists): ?>
                    <li  style="cursor: pointer;<?php if(isset($wishlists['userLists'])){ ?>background-image: url(<?= $wishlists['userLists'][0]['image'];?>);<?php }?>" onclick="window.location.href = '<?= site_url('wishlists/'.$wishlists['id']); ?>';">
                        <div class="content">
                            <h4><?= $wishlists['name']; ?></h4>
                            <?php if(isset($wishlists['userLists'])){ ?><p><?= count($wishlists['userLists']);?> Listings</p><?php }?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php else: ?>
            <div class="rentals-banner clearfix">
                <div class="pull-left">
                    <h2>Save and Share anything on PopIn</h2>
                    <p>Wish Lists make it easy to find the perfect space and plan a rental with others</p>
                    <a class="btn2" href="#" data-toggle="modal" data-target="#wishlistModal">Create a Wish List</a>
                </div>
                <div class="pull-right">
                    <img src="<?= base_url('theme/front/assests/img/wishlist-banner.png'); ?>" alt="">
                </div>
            </div>
            <?php endif; ?>
            <div class="wishlist-list">
                <h3>Popular Lists</h3>
                <ul class="clearfix">
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image1.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image2.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image3.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image1.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image2.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image3.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="wishlist-list">
                <h3>Popln picks</h3>
                <ul class="clearfix">
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image1.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image2.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image3.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image1.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image2.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                    <li style="background-image: url(<?php echo base_url('theme/front/assests/img/image3.jpg')?>);">
                        <div class="content">
                            <h4>Accommodating Architecture</h4>
                            <p>14 Homes</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div id="wishlistModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create a Wish List</h4>
            </div>
            <form id="wishlist-form" method="post" action="<?php echo site_url("dashboard/create_wishlist"); ?>" novalidate autocomplete="off">
                <div class="modal-body row">
                    <div class="col-lg-offset-1 col-lg-9">
                        <div class="alert alert-danger" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Please enter your wish list name below</strong>
                        </div>
                        <div class="form-group">
                            <label for="wishlist_name">Name</label>
                            <input class="textbox" id="wishlist_name" name="name" placeholder="Name your Wish List" required>
                        </div>
                        <div class="form-group">
                            <label for="wishlist_name">Privacy Settings</label>
                            <select class="selectbox" name="privacy">
                                <option value="everyone">Everyone</option>
                                <option value="invite-only">Invite Only</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn2">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$('#wishListModal').on('hidden.bs.modal', function () {
    $("form#wishlist-form").trigger('reset');
});
$('#wishlist-form').validate({
    rules: {
        'name' :{ required:true}
    },
    messages : {
        'name' :{ required:"Please enter your wishlist name."}
    },
    submitHandler: function(form) {
        $(form).parents('div.modal-content').block({ 
            overlayCSS: { backgroundColor: '#E5E5E5' }, 
            message: '<img src="<?= base_url(); ?>assets/images/loading-spinner-grey.gif" alt="please wait...">',
            css: { border: 'none', backgroundColor: 'transparent' }  
        });
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            dataType: 'json',
            success: function(response) {
                $(form).parents('div.modal-content').unblock();
                
                if(response.success){
                    window.location.reload();
                }else{
                    $(form).parents('div.modal-body').find(".alert strong").text(response.message);
                    $(form).parents('div.modal-body').find(".alert").show();
                }
                
            },
            error: function(response){
                $(form).parents('div.modal-content').unblock();
            }
        });
    }
});
</script>