<?php
function unverified_modal($url)
{ ?>

 <!-- The Modal -->
 <div class="modal fade" id="myModal">
  <div class="modal-dialog">
   <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
     <span class="modal-title">Unverified Account</span>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
     <span style="color:red; margin-top: 10px;">You are not verified. Please give your full details in your PROFILE and wait 48 hours to verify your account.</span>
    </div>

    <!-- Modal footer -->
    <form action="<?php echo $url; ?>" method="POST">
     <div class="modal-footer">
      <!-- <button type="button" class="btn delete_btn cancel">
      OK
     </button> -->
      <button type="submit" class="btn okay_btn" name="okay_btn" id="okay_btn">
       OK
      </button>
     </div>
    </form>
   </div>
  </div>
 </div>

<?php } ?>