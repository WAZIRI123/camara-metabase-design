<?php include 'partials/header.php'; ?>
  <main class="main">

    <!-- Report Section -->
    <section id="reportSection" class="report section">

      <!-- Section Title -->
      <div class="container  section-title" data-aos="fade-up" >
        <h2>Computer Usage</h2>
        <p>Select the country, project, and date range to generate comprehensive reports of project.</p>
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

                <!-- project Select Input -->
                <div class="col-md-6">
                  <label for="project_name" class="form-label">project</label>
                  <select name="project_name" id="project_name" class="form-control" required>
                    <option value="" disabled selected>Select project</option>
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

    <?php include 'partials/ComputerUsageGraph/1GeneralUsageGraph.php'; ?>

    <?php include 'partials/ComputerUsageGraph/2GeneralUsageTable.php'; ?>

    <?php include 'partials/ComputerUsageGraph/3DailyUsageAverageMonthlyDistribution.php'; ?>

    <?php include 'partials/ComputerUsageGraph/4MonthlyUsageDistributionActiveTime.php'; ?>

    <?php include 'partials/ComputerUsageGraph/5DailyUsageAverageMonthlyDistribution.php'; ?>
    
  </main>


<?php include 'partials/footer.php'; ?>

<script>
    function updateIframes() {
  const applyBtn = document.getElementById('applyBtn');
  const iframes = [
    {iframe: document.getElementById('1GeneralUsageGraph'), section: document.getElementById('contact')},
    
    {iframe: document.getElementById('2GeneralUsageTable'), section: document.getElementById('DailyUsage')},

    {iframe: document.getElementById('3DailyUsageAverageMonthlyDistribution'), section: document.getElementById('contact1')},

    {iframe: document.getElementById('4MonthlyUsageDistributionActiveTime'), section: document.getElementById('DailyUsage1')},

    {iframe: document.getElementById('5DailyUsageAverageMonthlyDistribution'), section: document.getElementById('contact1')},
  ];


  const startDate = document.getElementById('startDate').value;
  const endDate = document.getElementById('endDate').value;
  const country = document.getElementById('country').value;
  const project_name = document.getElementById('project_name').value;

  
  if (!startDate || !endDate || !country || !project_name) {
    alert("Please select all required fields.");
    return;
  }

  applyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
  applyBtn.disabled = true;

  const queryParams = `?startDate=${startDate}&endDate=${endDate}&country=${country}&project_name=${project_name}#hide_parameters=project_name,startDate,endDate,project,country`;

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

    

    // AJAX to populate the project list based on the selected country
    $('#country').change(function() {
      var country = $(this).val();
      
      if (!country) {
        $('#project_name').empty().append('<option value="" disabled selected>Select project</option>');
        return;
      }
      $.ajax({
        type: 'GET',
        url: '/get_projects.php',  // URL to fetch the projects based on the country
        data: { country: country },
        dataType: 'json',
        success: function(response) {
          var projectDropdown = $('#project_name');
          projectDropdown.empty();
          projectDropdown.append('<option value="" disabled selected>Select project</option>');
          $.each(response, function(index, project) {
            projectDropdown.append('<option value="' + htmlspecialchars(project.name) + '">' + htmlspecialchars(project.name) + '</option>');
          });
        },
        error: function(xhr, status, error) {
          console.error("Error fetching projects:", error);
          alert("An error occurred while fetching the projects. Please try again.");
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