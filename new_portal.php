<?php include 'partials/header.php'; ?>
  <main class="main">

    <!-- Report Section -->
    <section id="reportSection" class="report section">

      <!-- Section Title -->
      <div class="container  section-title" data-aos="fade-up" >
        <h2>Overall Portal</h2>
        <p>Select the country, project, and date range to generate comprehensive reports of project.</p>
      </div><!-- End Section Title -->

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-12" style="margin: 0 auto;
        width: 80%; max-width: 80% !important;">
            <form id="reportForm" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <!-- Submit Button -->
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your reports have been generated. Thank you!</div>
                  <div class="d-flex justify-content-center gap-2">
                    <button type="button" id="applyBtn" class="btn btn-primary" onclick="updateIframes()">Generate Report</button>
                    <button type="button" id="shareBtn" class="btn btn-secondary" onclick="shareReport()">Share Report</button>
                  </div>
                </div>

              </div>
            </form>
          </div><!-- End Report Form -->

        </div>

      </div>

    </section><!-- /Report Section -->

   

<!-- Iframe1 Section -->
 <section id="dashboard1" class="testimonials section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>General Usage (Monthly Distribution)</h2>
  <p>This graph shows the monthly distribution of computer usage across different schools, including the total usage time for each month.</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">
<iframe id="dashboard1frame" src="" dashboardId="dd26b6e3-8bc9-445f-ab3a-27141c8b91b7" width="100%"  frameborder="0" height="400"></iframe>
  </div>

</div>

</section><!-- /Iframe1 Section -->


<!-- Iframe2 Section -->
<section id="dashboard2" class="testimonials section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>General Usage Table (Yearly Aggregate)</h2>
  <p>This table outlines detailed information, including the school name, country, region, total duration of computer usage, and the last sync date when the school’s server data was sent to the cloud yearly...</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">
<iframe id="dashboard2frame" src="" dashboardId="6fea46e7-6077-42d1-9f6b-58c93ecbd27f" width="100%"  frameborder="0" height="400"></iframe>
  </div>

</div>

</section><!-- /Iframe2 Section -->


<!-- Iframe3 Section -->
<section id="dashboard3" class="testimonials section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Monthly Client Distribution</h2>
    <p>This provides a monthly overview of the number of computers from each school that successfully synchronised data with the cloud server. It reflects the total number of devices per school that were switched on and connected with the classroom server at least once during the month.</p>
  </div><!-- End Section Title -->
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <iframe id="dashboard3frame" src="" dashboardId="940edbf5-1567-4a82-9567-2c196ad8befa" width="100%" frameborder="0" height="400"></iframe>
  </div>
</section><!-- /Iframe3 Section -->


<!-- Iframe4 Section -->
<section id="dashboard4" class="testimonials section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>General Usage (Monthly Distribution)</h2>
    <p>This table shows the monthly distribution of computer usage across different schools, including the total usage time for each month.</p>
  </div><!-- End Section Title -->
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <iframe id="dashboard4frame" src="" dashboardId="d624683c-a98b-4ff3-927e-66a9cb38a28f" width="100%" frameborder="0" height="400"></iframe>
  </div>
</section><!-- /Iframe4 Section -->


<!-- Iframe5 Section -->
<section id="dashboard5" class="testimonials section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>General Usage Per Client (Daily Distribution)</h2>
    <p>This table shows the daily distribution of computer usage across different schools, including the total usage time for each day.</p>
  </div><!-- End Section Title -->
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <iframe id="dashboard5frame" src="" dashboardId="61e3793b-b7e4-4cff-973e-5a9a4116cedb" width="100%" frameborder="0" height="400"></iframe>
  </div>
</section><!-- /Iframe5 Section -->

    
  </main>


<?php include 'partials/footer.php'; ?>

<script>
function shareReport() {
 
  const shareableURL = `${window.location.origin}${window.location.pathname}`;
  
  // Copy to clipboard
  navigator.clipboard.writeText(shareableURL).then(() => {
    alert("Shareable link copied to clipboard!");
  }).catch(err => {
    console.error("Failed to copy:", err);
  });
}

function updateIframes() {
  const applyBtn = document.getElementById('applyBtn');
  const iframes = [
    {iframe: document.getElementById('dashboard1frame'), section: document.getElementById('dashboard1')},
    {iframe: document.getElementById('dashboard2frame'), section: document.getElementById('dashboard2')},
    {iframe: document.getElementById('dashboard3frame'), section: document.getElementById('dashboard3')},
    {iframe: document.getElementById('dashboard4frame'), section: document.getElementById('dashboard4')},
    {iframe: document.getElementById('dashboard5frame'), section: document.getElementById('dashboard5')}
  ];

  applyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
  applyBtn.disabled = true;

  // Show all sections and set their initial state
  iframes.forEach(({section}) => {
    if (section) section.style.display = 'block';
  });

  // Load each iframe
  iframes.forEach(({iframe}) => {
    if (iframe) {
      const dashboardId = iframe.getAttribute('dashboardId');
      if (dashboardId) {
        iframe.src = `https://meta.dashboard.camara.org/public/question/${dashboardId}?region=zanzibar#hide_parameters=region`;
      }
    }
  });

  // Track loaded iframes
  let iframesLoaded = 0;
  const totalIframes = iframes.length;

  const checkAllIframesLoaded = () => {
    if (iframesLoaded === totalIframes) {
      applyBtn.innerHTML = 'Generate Report';
      applyBtn.disabled = false;
    }
  };

  // Set up onload handlers
  iframes.forEach(({iframe}) => {
    if (iframe) {
      iframe.onload = function() {
        iframesLoaded++;
        checkAllIframesLoaded();
      };
      // Also handle errors in case an iframe fails to load
      iframe.onerror = function() {
        iframesLoaded++;
        checkAllIframesLoaded();
      };
    } else {
      // If iframe doesn't exist, count it as loaded
      iframesLoaded++;
      checkAllIframesLoaded();
    }
  });
}

    

    
    // Helper function to escape HTML characters
    function htmlspecialchars(str) {
      return str.replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
    }
  </script>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- URL Parameter Parser -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
        // We need a slight delay to wait for the projects to load
        setTimeout(function() {
    
          // Generate report automatically
          updateIframes();
        }, 1000); // 1 second delay to allow AJAX to complete
      
  });
  </script>

</body>

</html>