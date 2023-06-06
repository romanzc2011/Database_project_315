$(document).ready(function () {
    // SELECT ALL DEPARTMENT
    $('#view_all_course').on('click', function (event) {
        window.open('/csc315_final_project/views/course_table/display_all_courses.php?mode=select');
    });

    // SELECT SPECIFIC DEPARTMENT
    $('#find_course').on('click', function (event) {
        window.open('/csc315_final_project/views/course_table/display_course.php?mode=select&course_id=' + $('#courseID').val());
    });

    // INSERT COURSE
    $('#add_course').on('click', function () {
        insertCourse('POST', 'insert', $('#instructor_id').val(), $('#course_id').val());
    });

    // INSERT COURSE
    $('#add_to_course').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/course_table/add_to_course.php';
        event.preventDefault();
    });

    // UPDATE COURSE
    $('#edit_course').on('click', function () {
        updateCourse('POST', 'update', $('#courseID').val());
    });

    // DELETE COURSE
    $('#delete_course').on('click', function () {
        deleteCourse('POST', 'delete', $('#courseID').val());
    });

    // VIEW STUDENT PAGE
    $('#student_page').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/student_table/student.php';
        event.preventDefault();
    });

    // VIEW INSTRUCTORS PAGE
    $('#instructors_page').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/instructor_table/instructor.php';
        event.preventDefault();
    });

    // VIEW DEPARTMENT PAGE
    $('#view_department').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/department_table/department.php';
        event.preventDefault();
    });

    // VIEW GRADES PAGE
    $('#view_grades').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/grade_table/grade.php';
        event.preventDefault();
    });

    // VIEW FINANCIAL AID PAGE
    $('#fin_aid').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // VIEW SEMESTER PAGE
    $('#view_semester').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/semester_table/semester.php';
        event.preventDefault();
    });
});

// ####################################################################################################
// ####################################################################################################
// COURSE TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################
// COURSE INSERT
function insertCourse(type, mode, instructor_id, course_id) {
    $('#course_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        // #######################################################################
        // VARIABLES FOR INSERTING INTO DATABASE
        let course_id = $('#course_id').val();
        let courseName = $('#courseName').val();
        let credits = $('#creditHrs').val();
        let instructor_id = $('#instructor_id').val();
        courseClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/course_controller/course_processor.php?mode='+ mode,
            type: type,
            dataType: 'JSON',
            data: {
                course_id: course_id,
                courseName: courseName,
                credits: credits,
                instructor_id: instructor_id
            },
            success: function (response) {
            }
        });
        location.reload();
    });
}

// ####################################################################################################
// COURSE UPDATE
function updateCourse(type, mode, course_id) {
    $('#course_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        // #######################################################################
        // VARIABLES FOR INSERTING INTO DATABASE
        let courseName = $('#courseName').val();
        let credits = $('#creditHrs').val();
        let instructor_id = $('#instructor_id').val();
        courseClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/course_controller/course_processor.php' + '?mode=' + mode + '&course_id='+ course_id,
            type: type,
            dataType: 'JSON',
            data: {
                courseName: courseName,
                credits: credits,
                instructor_id: instructor_id
            },
            success: function (response) {
            }
        });
        location.reload();
    });
}

// ####################################################################################################
// COURSE DELETE
function deleteCourse(type, mode, course_id) {
    $('#course_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/course_controller/course_processor.php' + '?mode=' + mode + '&course_id=' + course_id,
            type: type,
            dataType: 'JSON',
            success: function (response) {
            }
        });
        location.reload();
    });
}

function courseClearAll() {
    $('#course_id').val('');
    $('#courseName').val('');
    $('#creditHrs').val('');
    $('#instructor_id').val('');
}
