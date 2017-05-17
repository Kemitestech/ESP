<div class="jumbotron contact-background reset-jumb-pos">
    <div class="container">
    <h1 class="header-title title-margin">Contact Us</h1>
    <div class="row">
    <div class="col-md-8">
        <form id="signinForm" class="form-horizontal">
          <div class="form-group">
          <label class="col-sm-9">
            <p>Feel free to give us a call on 0208 692 9036 or simply use the form below. If you prefer, just email us direct at
               <a href="mailto:info@cccedwardstreetparish.org?Subject=Enquiry" target="_top">info@cccedwardstreetparish.org</a>
            </p>
          </label>
      <label class="col-sm-9">
      <small>Fields marked with a * are required</small>
      <label>
          </div>
          <div id="alertmodal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div id="alertmessage" class="alert" style="display: none;">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <input type="text" class="form-control input-lg no-radius" id="fullname_contact" name="fullname" placeholder="Full name *">
            <?php echo form_error('fullname'); ?>
           </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <input type="text" class="form-control input-lg no-radius" id="businessname_contact" name="businessname" placeholder="Business name">
            <?php echo form_error('businessname'); ?>
           </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <input type="email" class="form-control input-lg no-radius" id="email_contact" name="email" placeholder="Email *">
            <?php echo form_error('email'); ?>
           </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <input type="tel" class="form-control input-lg no-radius" name="phone" id="phone_contact" placeholder="Phone number">
            <?php echo form_error('phone'); ?>
           </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <input type="text" class="form-control input-lg no-radius" id="subject_contact" name="subject" placeholder="Subject *">
            <?php echo form_error('subject'); ?>
           </div>
          </div>
          <div class="form-group input-margin">
           <div class="col-sm-9">
            <textarea id="message_contact" class="form-control no-radius input-lg" name="message" placeholder="Enquiry *" rows="3"></textarea>
            <?php echo form_error('message'); ?>
           </div>
          </div>
          <?php $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
          <input id="csrf" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          <div id="form_field_firstname">
            <input id="form_field_firstname" type="text" name="firstname" value/>
          </div>
          <div class="form-group">
            <div class="col-sm-9">
              <button type="submit" disabled="disabled" class="btn btn-contact btn-lg btn-block no-radius">Send</button>
            </div>
          </div>
        </form>
    </div>
    <hr class="hidden-md hidden-lg">
    <div class="col-md-4">
      <h3 class="header-title" style="margin: 0 0 10px;">Other Contact Details </h3>
      <!--<p>Sheperd's Office:</p>
      <address><abbr title="Phone">P:</abbr> 44 (0)208 692 9036 <br> <abbr title="Email">E:</abbr><a href="mailto:#"> first.last@example.com</a></address>
      <hr>-->
      <p>Parochial Commitee:</p>
      <address><abbr title="Phone">P:</abbr> 44 (0)208 694 9000 <br><abbr title="Email">E:</abbr><a href="mailto:#"> info.cccedwardstreetparish.org</a></address>
      <hr>
      <!--<p>Clergy:</p>
      <address><abbr title="Phone">P:</abbr> 44 (0)208 692 9036 <br><abbr title="Email">E:</abbr><a href="mailto:#"> first.last@example.com</a></address>
      -->
    </div>
    </div>
    </div>
  </div>
