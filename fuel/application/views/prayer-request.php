<div class="jumbotron contact-background reset-jumb-pos">
    <div class="container">
      <form id="prayer-request-form"class="form-horizontal col-md-10 col-md-offset-1">
        <div id="prayer-request-alert-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div id="prayer-request-alert-message" class="alert" style="display: none;">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
        <label class="col-sm-9">
        <h1 class="header-title title-margin">Prayer Request</h1>
        <p>Use the form below for your prayer request and
          leave the rest to our Lord who never fails. Also you can email your request at
           <a href="mailto:prayer_request@cccedwardstreetparish.org?Subject=Prayer%20request" target="_top">prayer_request@cccedwardstreetparish.org</a>
        </p>
        </label>
        </div>
        <div class="form-group input-margin">
         <div class="col-sm-9">
        <input type="text" name="fullname" class="form-control input-lg no-radius" id="name1" placeholder="Name *">
         </div>
        </div>
        <div class="form-group input-margin">
         <div class="col-sm-9">
        <input type="text" name="email" class="form-control input-lg no-radius" id="name1" placeholder="Email *">
         </div>
        </div>
        <div class="form-group input-margin">
         <div class="col-sm-9">
        <textarea name="request" id="InputRequest" class="form-control no-radius input-lg" placeholder="Request *" rows="5"></textarea>
         </div>
        </div>
        <?php $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
        <input id="csrf" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div id="form_field_firstname">
          <input type="text" name="firstname" value/>
        </div>
        <div class="form-group">
        <div class="col-sm-9">
          <button type="submit" disabled="disabled" class="btn btn-contact btn-lg btn-block no-radius">Send</button>
        </div>
        </div>
      </form>
    </div>
 </div>
