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
