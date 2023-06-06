$(document).ready(function (event) {
    // SELECT ALL INSTRUCTORS
    $('#show_all_instructors').on('click', function (event) {
        window.open('/csc315_final_project/views/instructor_table/display_all_instructors.php?mode=select');
    });

    // SELECT INSTRUCTOR
    $('#find_instructors').on('click', function (event) {
        window.open('/csc315_final_project/views/instructor_table/display_instructor.php?mode=select&instructor_id=' + $('#instructorID').val());
    });
    // UPDATE INSTRUCTOR
    $('#i_update_instructors').on('click', function (event) {
        updateInstructors('POST', 'update', $('#instructorID').val());
    });
    // INSERT INSTRUCTOR
    $('#i_add_instructors').on('click').on('click', function () {
        insertInstructors('POST', 'insert');
    });

    // DELETE INSTRUCTOR
    $('#i_delete_instructors').on('click', function () {
        deleteInstructor('GET', 'delete', $('#instructorID').val());
    });

    // GO TO DEPARTMENT PAGE ################################################################
    $('#department').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/department_table/department.php';
        event.preventDefault();
    });

    // GO TO STUDENT PAGE ################################################################
    $('#student_page').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/student_table/student.php';
        event.preventDefault();
    });

    // GO TO STUDENT PAGE ################################################################
    $('#view_grades').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/grade_table/grade.php';
        event.preventDefault();
    });

    // GO TO STUDENT PAGE ################################################################
    $('#fin_aid').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // GO TO SEMESTER PAGE ################################################################
    $('#view_semester').on('click', function (event){
        window.location.href = '/csc315_final_project/views/semester_table/semester.php';
        event.preventDefault();
    });

    // GO TO COURSES PAGE ################################################################
    $('#view_course').on('click', function (event){
        window.location.href = '/csc315_final_project/views/course_table/course.php';
        event.preventDefault();
    });


});
// ####################################################################################################
// ####################################################################################################
// INSTRUCTOR TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################

// ####################################################################################################
// UPDATE INSTRUCTOR
function insertInstructors(type, mode) {
    $('#instructor_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        // #######################################################################
        // VARIABLES FOR INSERTING INTO DATABASE
        let i_first_name = $('#firstName').val();
        let i_last_name = $('#lastName').val();
        let i_rank = $('#rank').val();
        let i_office = $('#office').val();
        instructorClearAll()

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/instructor_controller/instructor_processor.php' + '?mode=' + mode,
            type: type,
            dataType: 'JSON',
            async: false, // prevents sending multple requests
            cache: false,
            data: {
                firstName: i_first_name,
                lastName: i_last_name,
                rank: i_rank,
                office: i_office
            },
            success: function(){
                location.reload();
            }
        });
    });
}

// UPDATE INSTRUCTORS
function updateInstructors(type, mode, instructor_id) {
    $('#instructor_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        // #######################################################################
        // VARIABLES FOR UPDATING DATABASE
        let i_first_name = $('#firstName').val();
        let i_last_name = $('#lastName').val();
        let i_rank = $('#rank').val();
        let i_office = $('#office').val();

        instructorClearAll();
        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/instructor_controller/instructor_processor.php?page=instructors&mode=' + mode + '&instructor_id=' + instructor_id,
            type: type,
            dataType: 'JSON',
            async: false,
            data: {
                firstName: i_first_name,
                lastName: i_last_name,
                rank: i_rank,
                office: i_office
            },
            success: function(){
                location.reload();
            }
        });
    });
}

// ####################################################################################################
// DELETE INSTRUCTOR
function deleteInstructor(type, mode, instructor_id) {
    $('#instructor_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        $.ajax({
            url: '/csc315_final_project/controller/instructor_controller/instructor_processor.php' + '?mode=' + mode + '&instructor_id='+ instructor_id,
            crossOrigin: true,
            cache: false,
            async: false,
            type: type,
            dataType: 'JSON',
            success: function(){
                location.reload();
            }
        });
    });
}

function instructorClearAll() {
    $('#instructor_id').val('');
    $('#firstName').val('');
    $('#lastName').val('');
    $('#rank').val('');
    $('#office').val('');
    $('#dept_name').val('');
}