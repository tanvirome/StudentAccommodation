<?php

function footer()
{ ?>
 <section id="boxes_footer_top">
  <div class="container">
   <div class="box_footer_top">
    <div>
     <h3>USEFUL LINKS</h3>
     <div class="bottom-menu">
      <ul>
       <li><a href="aboutus.php">About Us</a></li>
       <li>
        <a href="termsAndCondition.php">Terms &amp; Conditions</a>
       </li>
       <li><a href="faq.php">FAQ</a></li>
       <li>
        <a href="contactus.php">Contact Us</a>
       </li>
      </ul>
     </div>
    </div>
   </div>

   <div class="box_footer_top">
    <div>
     <h3>STAY IN TOUCH</h3>
     <div>
      <form id="feedback_form" method="POST" enctype="text/plain">
       <div>
        <textarea name="feedback_msg" id="feedback_msg" cols="30" rows="5" placeholder="Your Message..." style="font-size: 15px;"></textarea>
        <input type="email" name="feedback_email" id="feedback_email" placeholder="E-mail ... " />
        <button type="submit" name="feedback_button" id="feedback_button">
         Feedback
        </button>
       </div>
      </form>
     </div>
     <div class="social">
      <ul>
       <li>
        <a href="#" target="_blank">
         <i class="fab fa-twitter"></i>
        </a>
       </li>
       <li>
        <a href="#" target="_blank">
         <i class="fab fa-facebook"></i>
        </a>
       </li>
       <li>
        <a href="#" target="_blank"><i class="fab fa-google-plus-g"></i> </a>
       </li>
       <li>
        <a href="#" target="_blank">
         <i class="fab fa-instagram"></i>
        </a>
       </li>
      </ul>
     </div>
    </div>
   </div>
   <div class="box_footer_top">
    <div>
     <h3>OFFICE ADDRESS</h3>
     <div>
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      <strong>Administration Office</strong><br />
      <p style="margin-top:5px;">
       Block A, 1st Floor, Mirpur 12,<br />
       Dhaka, Bangladesh.
      </p>

      <i class="fa fa-phone"></i>
      <label>+88 01714452058</label>
     </div>
    </div>
   </div>
  </div>
 </section>

 <footer>
  <div class="container">
   <p>
    Copyright &copy; 2019 | All Rights Reserved by Student Accommodation
   </p>
  </div>
 </footer>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

 <script>
  $(document).ready(function() {
   $('#feedback_form').on('submit', function(event) {
    event.preventDefault();
    var form_data = $(this).serialize();
    $.ajax({
     url: "../includes/send_feedback.inc.php",
     method: "POST",
     data: form_data,
     dataType: "JSON",
     success: function(data) {
      // if (data.error != '') {
      //  $('#comment_message').html(data.error);
      // }
     }
    })
    document.getElementById("feedback_msg").value = "";
    document.getElementById("feedback_email").value = "";

   });

   // $('#feedback_form').on('submit', function(event) {
   //  var feedback_msg = document.getElementById("feedback_msg").value;
   //  var feedback_email = document.getElementById('feedback_email').value;
   //  if (feedback_msg != "" && feedback_email != "") {
   //   $('#feedback_msg').load('../includes/send_feedback.inc.php', {
   //    'feedback_msg': message,
   //    'feedback_email': email
   //   });
   //   document.getElementById("feedback_msg").value = "";
   //   document.getElementById("feedback_email").value = "";
   //  } else {
   //   alert("Please write a message and put your e-mail then submit it.")
   //  }
   // });
  });
 </script>

<?php } ?>