$(document).ready(function () {
    // SELECT ALL SEMESTERS
    $('#view_all_semester').on('click', function (event) {
        window.open('/csc315_final_project/views/semester_table/display_all_semesters.php?mode=select');
    });

    // AVAILABLE COURSES
    $('#available_course').on('click', function (event) {
        window.open('/csc315_final_project/views/semester_table/available_courses.php?mode=select');
    });

    // SELECT SPECIFIC semester
    $('#find_semester').on('click', function (event) {
        window.open('/csc315_final_project/views/semester_table/display_semester.php?mode=select&semester_id=' + $('#semesterID').val());
    });

    // INSERT semester
    $('#add_semester').on('click', function (event) {
        insertSemester('POST', 'insert', null);
    });

    // UPDATE semester
    $('#edit_semester').on('click', function (event) {
        updateSemester('POST', 'update', $('#semesterID').val());
    });

    // DELETE semester
    $('#delete_semester').on('click', function (event) {
        deleteSemester('POST', 'delete', $('#semesterID').val());
    });

    // VIEW STUDENT PAGE
    $('#student_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/student_table/student.php';
        event.preventDefault();
    });

    // VIEW STUDENT PAGE
    $('#view_grades').on('click', function(event){
        window.location.href='/csc315_final_project/views/grade_table/grade.php';
        event.preventDefault();
    });

    // VIEW COURSE PAGE
    $('#view_course').on('click', function(event){
        window.location.href='/csc315_final_project/views/course_table/course.php';
        event.preventDefault();
    });

    // VIEW INSTRUCTORS PAGE
    $('#instructors_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/instructor_table/instructor.php';
        event.preventDefault();
    });

    // VIEW FIANCIAL AID PAGE
    $('#view_financial_aid').on('click', function(event){
        window.location.href='/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // VIEW DEPARTMENT PAGE
    $('#view_department').on('click', function(event){
        window.location.href='/csc315_final_project/views/department_table/department.php';
        event.preventDefault();
    });

});

// ####################################################################################################
// ####################################################################################################
// DEPARTMENT TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################
function updateSemester(type, mode, semester_id) {
    $('#semester_form').on('submit', function (event) {
        let start_date = $('#semester_start').val();
        let end_date = $('#semester_end').val();
        //let semester_time = $('#semester_time').val();
        semestersClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/semester_controller/semester_processor.php' + '?mode=' + mode + '&semester_id=' + semester_id,
            type: type,
            async: false,
            cache: false,
            dataType: 'JSON',
            data: {
                start_date: start_date,
                end_date: end_date,
                //semester_time: semester_time
            },
            success: function () {

            }
        });
    });
}

function insertSemester(type, mode) {
    $('#semester_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        let start_date = $('#semester_start').val();
        let end_date = $('#semester_end').val();
        let semester_time = $('#semester_time').val();
        semestersClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/semester_controller/semester_processor.php' + '?mode=' + mode,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                start_date: start_date,
                end_date: end_date,
                semester_time: semester_time
            },
            success: function () {

            }
        });
    });
}

// ####################################################################################################
// DELETE INSTRUCTOR
function deleteSemester(type, mode, semester_id) {
    $('#semester_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            url: '/csc315_final_project/controller/semester_controller/semester_processor.php' + '?mode=' + mode + '&semester_id='+ semester_id,
            crossOrigin: true,
            cache: false,
            async: false,
            type: type,
            dataType: 'JSON',
        });
    });
}

function semestersClearAll() {
    $('#semester_start').val('');
    $('#semester_end').val('');
    $('#semester_time').val('');
}