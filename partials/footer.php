
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  <footer id="footer" class="footer">
    <div class="footer-border">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                   
                    <h4 style="padding-bottom: 0;">Ethiopia</h4>
                    <p class="mt-1"><strong>Phone:</strong> <span>+251 (0)11869051</span></p>
                    <p><strong>Email:</strong> <span>ethiopia@camara.org</span></p>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                  
                    <h4 style="padding-bottom: 0;">Tanzania</h4>
                    <p class="mt-1"><strong>Phone:</strong> <span>+255 758 396 600</span></p>
                    <p><strong>Email:</strong> <span>tanzania@camara.org</span></p>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                   <h4 style="padding-bottom: 0;">Kenya</h4>
                    <p class="mt-1"><strong>Phone:</strong> <span>+254 770 400 703</span></p>
                    <p><strong>Email:</strong> <span>kenya@camara.org</span></p>
                 
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                     <h4 style="padding-bottom: 0;">Zambia</h4>
                    <p class="mt-1"><strong>Phone:</strong> <span>+260 969634712</span></p>
                    <p><strong>Email:</strong> <span>zambia@camara.org</span></p>
                    
                    <h4 style="padding-bottom: 0;" class="mt-4">Website</h4>
                    <p><a href="https://www.camara.org" target="_blank">www.camara.org</a></p>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Camara Education</strong> <span>All Rights Reserved</span></p>
        </div>
    </div>
</footer>


  <!-- jQuery & AJAX Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
  // Get all links in the navmenu
  const navLinks = document.querySelectorAll('#navmenu a');
  const currentPath = window.location.pathname.split("/").pop(); // Get the current page file name

  navLinks.forEach(link => {
    // Check if the href of the link matches the current path
    if (link.getAttribute('href') === currentPath || (link.getAttribute('href') === "/" && currentPath === "")) {
      link.classList.add('active'); // Add the active class
    } else {
      link.classList.remove('active'); // Remove the active class from other links
    }
  });
});

  </script>


  



