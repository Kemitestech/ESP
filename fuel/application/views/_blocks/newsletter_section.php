  <div class="jumbotron newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <img src="<?=img_path('email_send.svg', null, null)?>" class="img-responsive hidden-xs hidden-sm" alt="Image">
        </div>
        <div class="col-md-9">
          <h2 class="center-text">Subscribe to our Newsletter</h2>
          <p class="center-text">Interesting topics from CCC Edward Street Parish delivered straight to you.</p>
          <form id="subscribeForm" class="form-inline form-center">
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <?php $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
            <input id="subscribe_csrf" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <div id="subscribe_field_firstname">
              <input type="text" name="firstname" value/>
            </div>
            <button type="submit" class="btn btn-contact subscribe">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
