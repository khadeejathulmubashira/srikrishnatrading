
 <!-- Newsletter Start -->
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="col-lg-10 border rounded p-1">
            <div class="border rounded text-center p-1">
                <div class="bg-white rounded text-center p-5">
                    <h4 class="mb-4">Get <span class="text-primary text-uppercase">Reach With Us</span></h4>
                    
                    <!-- Centered button -->
                    <div class="text-center">
                        <a href="contact.php" class="btn btn-primary py-2 px-4">Contact</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Newsletter Start -->
        
<!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="row g-5">

            <!-- Company Info -->
            <div class="col-md-6 col-lg-4">
                <div class="bg-primary rounded p-4 h-100">
                    <a href="index.php">
                        <h1 class="text-white text-uppercase mb-3">krishna Trading Company</h1>
                    </a>
                    <p class="text-white mb-0">
                        Explore our <a class="text-dark fw-bold" href="sector.php?name=tiles">Our Collections</a>,
                        featuring premium quality floor and wall tiles crafted for both residential and commercial spaces.
                        Style your surroundings with durability and elegance.
                    </p>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 col-lg-4">
    <h6 class="section-title text-primary text-uppercase mb-4">Contact</h6>

    <!-- Address - clickable with Google Maps -->
    <p class="mb-2">
        <a href="https://maps.app.goo.gl/JvcivXoy9TUUdu219" target="_blank" class="text-white text-decoration-none">
            <i class="fa fa-map-marker-alt me-3"></i>Anebagilu, M.G.Road, Kasaragod - 671121
        </a>
    </p>

    <!-- Phone - clickable with tel: -->
    <p class="mb-2">
        <a href="tel:+916282838119" class="text-white text-decoration-none">
            <i class="fa fa-phone-alt me-3"></i>+91 7994177302
        </a>
    </p>

    <!-- Fax - clickable with tel: (optional) -->
    <p class="mb-2">
        <a href="tel:+914994230535" class="text-white text-decoration-none">
            <i class="fa fa-fax me-3"></i>+91 4994 230535
        </a>
    </p>

    <!-- Email - clickable with mailto: -->
    <p class="mb-2">
        <a href="mailto:krishnakasaragod@gmail.com" class="text-white text-decoration-none">
            <i class="fa fa-envelope me-3"></i>krishnakasaragod@gmail.com
        </a>
    </p>

    <!-- Social Links -->
    <div class="d-flex pt-2">
        <a class="btn btn-outline-light btn-social me-2" href=""><i class="fab fa-twitter"></i></a>
        <a class="btn btn-outline-light btn-social me-2" href=""><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-outline-light btn-social me-2" href=""><i class="fab fa-youtube"></i></a>
        <a class="btn btn-outline-light btn-social me-2" href=""><i class="fab fa-linkedin-in"></i></a>
    </div>
</div>


            <!-- Links -->
            <div class="col-lg-4 col-md-12">
                <div class="row gy-4">
                    <div class="col-6">
                        <h6 class="section-title text-primary text-uppercase mb-4">Company</h6>
                        <a class="btn btn-link" href="about.php">About Us</a>
                        <a class="btn btn-link" href="contact.php">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">Support</a>
                    </div>
                    <div class="col-6">
  <h6 class="section-title text-primary text-uppercase mb-4">Products</h6>
  <?php
  $res = $conn->query("SELECT id, sector_name FROM sectors ORDER BY sector_name ASC");
  while ($row = $res->fetch_assoc()) {
      $sector_id = $row['id'];
      $sector_name = htmlspecialchars($row['sector_name']);
      echo '<a class="btn btn-link" href="sectors.php?sector_id=' . $sector_id . '">' . $sector_name . '</a>';
  }
  ?>
</div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">krishna Trading Company</a>, All Rights Reserved.
                    <br>
                    
                </div>
                <!-- <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="#">Home</a>
                        <a href="#">Cookies</a>
                        <a href="#">Help</a>
                        <a href="#">FAQs</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

        <!-- Footer End -->
         <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- WhatsApp Floating Button -->
<!-- <script type="text/javascript">
(function () {
    var options = {
        whatsapp: "917994012077", // Your number with country code
        call_to_action: "Chat with us on WhatsApp", 
        position: "left", // left or right
    };
    var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
    var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
    s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
    var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
})();
</script> -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Tilt.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>

<script>
  AOS.init(); // init AOS
  VanillaTilt.init(document.querySelectorAll(".glass-card"), {
    max: 15,
    speed: 400,
    glare: true,
    "max-glare": 0.2,
  });
</script>


<script>
document.querySelectorAll(".filter-btns button").forEach(btn => {
  btn.addEventListener("click", () => {
    const filter = btn.getAttribute("data-filter");
    document.querySelectorAll(".filter-btns button").forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    document.querySelectorAll(".sector-card").forEach(card => {
      if (filter === "all" || card.classList.contains(filter)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});
</script>



<!-- Your page content -->

<!-- Chatbase Chatbot Script -->
<script>
(function(){
  if (!window.chatbase || window.chatbase("getState") !== "initialized") {
    window.chatbase = (...args) => {
      if (!window.chatbase.q) {
        window.chatbase.q = [];
      }
      window.chatbase.q.push(args);
    };
    window.chatbase = new Proxy(window.chatbase, {
      get(target, prop) {
        if (prop === "q") {
          return target.q;
        }
        return (...args) => target(prop, ...args);
      }
    });
  }
  const onLoad = function() {
    const script = document.createElement("script");
    script.src = "https://www.chatbase.co/embed.min.js";
    script.id = "NP0RGAhZeuMeebEilFRez"; // Your chatbot ID
    script.domain = "www.chatbase.co";
    document.body.appendChild(script);
  };
  if (document.readyState === "complete") {
    onLoad();
  } else {
    window.addEventListener("load", onLoad);
  }
})();
</script>



<!-- WhatsApp Floating Button -->
<a href="https://wa.me/917994177302" class="whatsapp-float" target="_blank" title="Chat with us on WhatsApp">
    <img src="https://img.icons8.com/ios-filled/50/ffffff/whatsapp--v1.png" alt="WhatsApp Icon">
</a>

<style>
    .whatsapp-float {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: #000; /* Match your shown color */
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        transition: transform 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
    }

    .whatsapp-float img {
        width: 30px;
        height: 30px;
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const pdfButtons = document.querySelectorAll('.view-pdf-btn');
  const pdfFrame = document.getElementById('pdfFrame');

  pdfButtons.forEach(button => {
    button.addEventListener('click', function () {
      const pdfUrl = this.getAttribute('data-pdf');
      pdfFrame.src = pdfUrl;
    });
  });

  // Optional: clear iframe when modal closes
  document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function () {
    pdfFrame.src = '';
  });
});
</script>


</body>

</html>