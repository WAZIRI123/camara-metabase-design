<?php include 'partials/header.php'; ?>
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="https://camara.org/wp-content/uploads/elementor/thumbs/Sustainability-School-scaled-qt88ki23fe7l8uvofnyphmohi1i9ckyi7jziqi7rxo.jpg" alt="" data-aos="fade-in">

      <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h2>Camara Education Report</h2>
            <p>This page shows your school's performance based on data collected from the classroom server and synced with the Camara cloud server, reflecting student interaction with educational resources.</p>
            <a href="#reportSection" class="btn-get-started">Get Report</a>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Report Section -->
    <section id="reportSection" class="report section">

      <!-- Section Title -->
      <div class="container  section-title" data-aos="fade-up" >
        <h2>Generate Reports</h2>
        <p>Select the country, school, and date range to generate comprehensive reports of school.</p>
      </div><!-- End Section Title -->

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-12" style="margin: 0 auto;
        width: 80%; max-width: 80% !important;">
            <form id="reportForm" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <!-- Country Select Input -->
                <div class="col-md-6">
                  <label for="country" class="form-label">Country</label>
                  <select name="country" id="country" class="form-control" required>
                    <option value="" disabled selected>Select Country</option>
                    <?php foreach ($countries as $country): ?>
                      <option value="<?= htmlspecialchars($country['name']); ?>"><?= htmlspecialchars($country['name']); ?></option>
                    <?php endforeach; ?>
                    <!-- Add more options as needed -->
                  </select>
                </div>

                <!-- School Select Input -->
                <div class="col-md-6">
                  <label for="school_name" class="form-label">School</label>
                  <select name="school_name" id="school_name" class="form-control" required>
                    <option value="" disabled selected>Select School</option>
                    <!-- Options will be populated based on selected country -->
                  </select>
                </div>

                <!-- Start Date Input -->
                <div class="col-md-6">
                  <label for="startDate" class="form-label">Start Date</label>
                  <input type="date" id="startDate" name="start_date" class="form-control" placeholder="Start Date" required>
                </div>

                <!-- End Date Input -->
                <div class="col-md-6">
                  <label for="endDate" class="form-label">End Date</label>
                  <input type="date" id="endDate" name="end_date" class="form-control" placeholder="End Date" required>
                </div>

                <!-- Submit Button -->
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your reports have been generated. Thank you!</div>
                  <button type="button" id="applyBtn" class="btn btn-primary" onclick="updateIframes()">Generate Report</button>
                </div>

              </div>
            </form>
          </div><!-- End Report Form -->

        </div>

      </div>

    </section><!-- /Report Section -->
    <?php include 'partials/schoolframe1.php'; ?>
    <?php include 'partials/schoolframe2.php'; ?>

    <?php include 'partials/schoolframe3.php'; ?>

  </main>


<?php include 'partials/footer.php'; ?>
<script>
    function updateIframes() {
  const applyBtn = document.getElementById('applyBtn');
  const iframes = [
    {iframe: document.getElementById('metabaseIframe1'), section: document.getElementById('contact')},
    {iframe: document.getElementById('metabaseIframe2'), section: document.getElementById('DailyUsage')},
    {iframe: document.getElementById('metabaseIframe3'), section: document.getElementById('contact1')},
    {iframe: document.getElementById('metabaseIframe4'), section: document.getElementById('DailyUsage1')},
    {iframe: document.getElementById('metabaseIframe5'), section: document.getElementById('contact2')},
    {iframe: document.getElementById('metabaseIframe6'), section: document.getElementById('DailyUsage2')}
  ];


  const startDate = document.getElementById('startDate').value;
  const endDate = document.getElementById('endDate').value;
  const country = document.getElementById('country').value;
  const school_name = document.getElementById('school_name').value;

  
  if (!startDate || !endDate || !country || !school_name) {
    alert("Please select all required fields.");
    return;
  }

  applyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
  applyBtn.disabled = true;

  const queryParams = `?startDate=${startDate}&endDate=${endDate}&country=${country}&school_name=${school_name}#hide_parameters=school_name,startDate,endDate,project,country`;

  iframes.forEach(function(item) {
    const {iframe, section} = item;
    iframe.src = `https://meta.dashboard.camara.org/public/question/${iframe.getAttribute('dashboardId')}${queryParams}`;
    
    section.style.display = 'block';
  });

  let iframesLoaded = 0;

  iframes.forEach(function(item) {
    const {iframe} = item;
    iframe.onload = function() {
      iframesLoaded++;
      if (iframesLoaded === iframes.length) {
 
        applyBtn.innerHTML = 'Generate Report';
        applyBtn.disabled = false;
      }
    };
  });
}

    

    // AJAX to populate the school list based on the selected country
    $('#country').change(function() {
      var country = $(this).val();
      if (!country) {
        $('#school_name').empty().append('<option value="" disabled selected>Select School</option>');
        return;
      }
      $.ajax({
        type: 'GET',
        url: '/get_schools.php',  // URL to fetch the schools based on the country
        data: { country: country },
        dataType: 'json',
        success: function(response) {
            console.log(response)
          var schoolDropdown = $('#school_name');
          schoolDropdown.empty();
          schoolDropdown.append('<option value="" disabled selected>Select School</option>');
          $.each(response, function(index, school) {
            schoolDropdown.append('<option value="' + htmlspecialchars(school.name) + '">' + htmlspecialchars(school.name) + '</option>');
          });
        },
        error: function(xhr, status, error) {
          console.error("Error fetching schools:", error);
          alert("An error occurred while fetching the schools. Please try again.");
        }
      });
    });

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

</body>

</html>