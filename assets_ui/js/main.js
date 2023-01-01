//JQUERY

$(function () {
  //////////////////////////////////////////////////////////
  //declarations
  let countExtra = 0;

  /////////////////////////////////////////////////////////
  let lat = null;
  let long = null;

  $(".select2").select2();

  $("#book-list-show-form").hide();
  $("#isShowMap").hide();
  $("#location-loading").hide();

  //load category create form
  $(".loadCategoryCreateForm").click(function () {
    $("#show-category-form").load($(this).attr("value"));
    $(".select2").select2();
  });

  //load category update form
  $(".loadCategoryEditForm").click(function () {
    $("#show-category-form").load($(this).attr("value"));
  });

  //load courses create form
  $(".loadCourseCreateForm").click(function () {
    $("#show-courses-form").load($(this).attr("value"));
  });

  //load courses update form
  $(".loadCourseEditForm").click(function () {
    $("#show-courses-form").load($(this).attr("value"));
  });

  //load progamme create form
  $(".loadProgrammesCreateForm").click(function () {
    $("#show-programmes-form").load($(this).attr("value"));
  });

  //load progamme update form
  $(".loadProgrammesEditForm").click(function () {
    $("#show-programmes-form").load($(this).attr("value"));
  });

  //load student registration create form
  $(".loadStudentRegisterForm").click(function () {
    $("#student-profile-1").hide();
    $("#student-profile-div").hide();
    $("#student-profile").load($(this).attr("value"));
  });

  //ATTENDANCE
  //assign course to attendance
  $("#attendance_course").change(function (e) {
    e.preventDefault();
    let course_id = $("#attendance_course").val();

    $.ajax({
      method: "POST",
      url: "index.php?r=attendance/fetch",
      data: {
        "_csrf-backend": yii.getCsrfToken(),
        course_id: course_id,
      },
      success: function (data) {
        let list = JSON.parse(data);
        list.forEach((student) => {
          let html = `
                  <div class="form-check form-check-inline mb-2">
                  <input type="checkbox" class="form-check-input" id="attendance_id" value="${student.id}">
                  <label class="form-check-label" for="customCheck3">${student.firstname} ${student.surname}</label>
                  </div>              
                  `;
          $("#attendance_list").append(html);
        });
      },
    });
  });

  //project attendance
  $("#project-attendance-submit-btn").click(function (e) {
    e.preventDefault();
    let project_attendance_students = [];
    const project_attendances = document.querySelectorAll(
      "#project_attendance_id"
    );
    let project_id = $("#project-attendance-id").val();

    project_attendances.forEach((attendance) => {
      const obj = {};
      obj.id = attendance.value;
      obj.status = attendance.checked ? 1 : 0;
      project_attendance_students.push(obj);
    });

    bootbox.confirm({
      message: "Are you sure you want to submit the attendance?",
      size: "small",
      buttons: {
        confirm: {
          label: "<i class='mdi mdi-check'></i> OK",
          className: "btn btn-primary btn-sm",
        },
        cancel: {
          label: "<i class='mdi mdi-close'></i> Cancel",
          className: "btn btn-danger btn-sm",
        },
      },
      callback: function (result) {
        if (result) {
          $.ajax({
            method: "POST",
            url: "index.php?r=project/submit-project-attendance",
            data: {
              "_csrf-backend": yii.getCsrfToken(),
              student_list: JSON.stringify(project_attendance_students),
              project_id: project_id,
            },
            beforeSend: function () {
              document.querySelector(".project_attendance_div").style.display =
                "none";
              document.querySelector(
                ".project_attendance_loading-gif"
              ).style.display = "inline";
              document.querySelector(
                ".project_attendance_loading-gif-spin"
              ).style.display = "inline";
            },
            success: function () {
              //  $('.attendance-div').hide();
              document.querySelector(
                ".project_attendance_loading-gif"
              ).style.display = "none";
              document.querySelector(
                ".project_attendance_loading-gif-spin"
              ).style.display = "none";
              document.querySelector(
                ".project_attendance_success-msg"
              ).style.display = "inline";
            },
          });
        }
      },
    });
  });

  //submit class attendance
  $("#attendance_submit").click(function (e) {
    e.preventDefault();
    let students = [];
    const attendances = document.querySelectorAll("#attendance_id");
    let teacher_id = $("#attendance_teacher").val();
    let program_id = $("#attendance_program").val();

    attendances.forEach((attendance) => {
      const obj = {};
      obj.id = attendance.value;
      obj.status = attendance.checked ? 1 : 0;
      students.push(obj);
    });

    bootbox.confirm({
      message: "Are you sure you want to submit the attendance?",
      size: "small",
      buttons: {
        confirm: {
          label: "<i class='mdi mdi-check'></i> OK",
          className: "btn btn-primary btn-sm",
        },
        cancel: {
          label: "<i class='mdi mdi-close'></i> Cancel",
          className: "btn btn-danger btn-sm",
        },
      },
      callback: function (result) {
        if (result) {
          $.ajax({
            method: "POST",
            url: "index.php?r=attendance/create",
            data: {
              "_csrf-backend": yii.getCsrfToken(),
              student_list: JSON.stringify(students),
              course_id: $("#attendance_course").val(),
              teacher_id: teacher_id,
              program_id: program_id,
            },
            beforeSend: function () {
              document.querySelector(".attendance-div").style.display = "none";
              document.querySelector(".loading-gif").style.display = "inline";
              document.querySelector(".loading-gif-spin").style.display =
                "inline";
            },
            success: function () {
              //  $('.attendance-div').hide();
              document.querySelector(".loading-gif").style.display = "none";
              document.querySelector(".loading-gif-spin").style.display =
                "none";
              document.querySelector(".success-msg").style.display = "inline";
            },
          });
        }
      },
    });
  });

  //course registration
  $("#course-registration-submit-btn").click(function (e) {
    e.preventDefault();
    let courses_list = [];
    const courses = document.querySelectorAll("#register_own_course_id");
    let student_id = $("#register-course-student-id").val();

    courses.forEach((attendance) => {
      const obj = {};
      obj.id = attendance.value;
      obj.status = attendance.checked ? 1 : 0;
      courses_list.push(obj);
    });

    bootbox.confirm({
      message: "Are you sure you want to submit the course list?",
      size: "small",
      buttons: {
        confirm: {
          label: "<i class='mdi mdi-check'></i> OK",
          className: "btn btn-primary btn-sm",
        },
        cancel: {
          label: "<i class='mdi mdi-close'></i> Cancel",
          className: "btn btn-danger btn-sm",
        },
      },
      callback: function (result) {
        if (result) {
          $.ajax({
            method: "POST",
            url: "index.php?r=student/register-courses",
            data: {
              "_csrf-backend": yii.getCsrfToken(),
              courses_list: JSON.stringify(courses_list),
              student_id: student_id,
            },
            beforeSend: function () {
              document.querySelector(".course_registration_div").style.display =
                "none";
              document.querySelector(
                ".course_registration_loading-gif"
              ).style.display = "inline";
              document.querySelector(
                ".course_registration_loading-gif-spin"
              ).style.display = "inline";
            },
            success: function () {
              //  $('.attendance-div').hide();
              document.querySelector(
                ".course_registration_loading-gif"
              ).style.display = "none";
              document.querySelector(
                ".course_registration_loading-gif-spin"
              ).style.display = "none";
              document.querySelector(
                ".course_registration_success-msg"
              ).style.display = "inline";
            },
          });
        }
      },
    });
  });

  //download class attendance
  $("#attendance-download-btn").click(function (e) {
    e.preventDefault();
    window.location = `index.php?r=attendance/fetch-attendance-report&course_id=${$(
      "#course-id-attendance-download"
    ).val()}&date=${$("#date-attendance-download").val()}&program=${$(
      "#program-id-attendance-download"
    ).val()}`;
  });

  //download project attendance
  $("#project-attendance-download-btn").click(function (e) {
    e.preventDefault();
    window.location = `index.php?r=project/fetch-attendance-report&project_id=${$(
      "#project-id-attendance-download"
    ).val()}&date=${$("#date-project-attendance-download").val()}`;
  });

  //ASSIGNMENT
  //download all assignment based on assignment category
  $("#assignment-download-all-btn").click(function (e) {
    e.preventDefault();
    window.location = `index.php?r=assignment/download-all&cat_id=${$(
      "#assignment-download-all-id"
    ).val()}`;
  });

  //mark all assignment as received based on assignment category
  $("#assignment-mark-all-btn").click(function (e) {
    e.preventDefault();
    bootbox.confirm({
      message: "Are you sure you want to mark all as received?",
      size: "small",
      buttons: {
        confirm: {
          label: "<i class='mdi mdi-check'></i> OK",
          className: "btn btn-primary btn-sm",
        },
        cancel: {
          label: "<i class='mdi mdi-close'></i> Cancel",
          className: "btn btn-danger btn-sm",
        },
      },
      callback: function (result) {
        if (result) {
          window.location = `index.php?r=assignment/received-all&cat_id=${$(
            "#assignment-download-all-id"
          ).val()}`;
        }
      },
    });
  });

  //PROJECT LOCATION
  //get user/project leader location
  $.fn.displayMyId = (id) => {
    $.fn.setLocation(id);
  };

  $.fn.setLocation = function (id) {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        $.fn.successFunction.bind(null, id),
        $.fn.errorFunction
      );
    } else {
      alert(
        "It seems like Geolocation, which is required for this page, is not enabled in your browser. Please use a browser which supports it."
      );
    }
  };

  //add project location to db
  $.fn.successFunction = function (id, position) {
    lat = position.coords.latitude;
    long = position.coords.longitude;

    $.ajax({
      method: "POST",
      url: "index.php?r=project/add-location",
      data: {
        "_csrf-backend": yii.getCsrfToken(),
        lat: lat,
        long: long,
        project_id: id,
      },
      success: function (data) {},
    });
  };

  $.fn.errorFunction = function () {
    console.log("error");
  };

  $("#add-project-location-to-db-btn").click((e) => {
    e.preventDefault();
    $.fn.setLocation();
  });

  //get project location from db
  $("#view-project-location-from-db-btn").click((e) => {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: "index.php?r=project/get-location",
      data: {
        "_csrf-backend": yii.getCsrfToken(),
        project_id: $("#add-project-location-to-db-id").val(),
      },
      success: function (data) {
        let list = JSON.parse(data);
        let latitude = list[0].latitude;
        let longitude = list[0].longitude;
        $("#location-loading").show();
        $.fn.fetchLocationName(latitude, longitude);
        let map = L.map("map").setView([latitude, longitude], 13);
        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
          maxZoom: 19,
          attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);
        L.marker([latitude, longitude]).addTo(map);

        $("#isShowMap").show();
      },
    });
  });

  //fetch location name using external API
  $.fn.fetchLocationName = async function (lat, long) {
    const options = {
      method: "GET",
      headers: {
        "X-RapidAPI-Key": "e2417f1144msh09f80f0a144021ap113233jsn05b53ff53ed8",
        "X-RapidAPI-Host": "trueway-geocoding.p.rapidapi.com",
      },
    };
    try {
      const data = await fetch(
        `https://trueway-geocoding.p.rapidapi.com/ReverseGeocode?location=${lat}%2C${long}&language=en`,
        options
      );
      const myLocation = await data.json();
      $("#location-loading").hide();

      myLocation.results.forEach((data) => {
        if (data.type === "poi") {
          let displayLocation = `${data.area}, ${data.region}, ${data.country}`;
          document
            .getElementById("display-project-location")
            .insertAdjacentText("afterbegin", displayLocation);
        }
      });
    } catch (error) {
      console.log(error.message);
    }
  };

  //BOOKS
  //Manage Book List
  $(".reading-book-id").change((e) => {
    bootbox.confirm({
      message: "Are you sure you want to change reading status?",
      size: "small",
      buttons: {
        confirm: {
          label: "<i class='mdi mdi-check'></i> OK",
          className: "btn btn-primary btn-sm",
        },
        cancel: {
          label: "<i class='mdi mdi-close'></i> Cancel",
          className: "btn btn-danger btn-sm",
        },
      },
      callback: function (result) {
        if (result) {
          $.ajax({
            method: "POST",
            url: "index.php?r=book-list/change-status",
            data: {
              "_csrf-backend": yii.getCsrfToken(),
              id: e.target.value,
            },
            beforeSend: function () {},
            success: function () {
              window.location = "index.php";
            },
          });
        }
      },
    });
  });

  $("#show-add-book-list-form").click((e) => {
    e.preventDefault();
    $("#book-list-show-form").show();
  });

  //assigning select 2 to select elements
  $(".select2").select2();
  $("#studentcourse-course_id").select2();
});
