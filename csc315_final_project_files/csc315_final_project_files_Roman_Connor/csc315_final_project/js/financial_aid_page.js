$(document).ready(function (event) {
    // SELECT ALL FINANCIAL AID
    $('#show_finaid').on('click', function (event) {
        window.open('/csc315_final_project/views/financial_aid_table/display_all_financial_aid.php?mode=select');
    });

    // SELECT FINAID BY STUDENT
    $('#finaid_by_student').on('click', function (event) {
        window.open('/csc315_final_project/views/financial_aid_table/display_finaid_by_student.php?mode=select&studentID='+ $('#studentID').val());
    });

    // INSERT FINANCIAL AID
    $('#add_finaid').on('click', function (event) {
        insertFinaid('POST', 'insert', null);
    });

    // UPDATE FINANCIAL AID
    $('#update_finaid').on('click', function (event) {
        updateFinaid('POST');

    })

    // DELETE DEPARTMENT MEMBER
    $('#delete_finaid').on('click', function (event) {
        deleteFinaid('POST', 'delete', $('#finaid_id').val());

    });

    $('#instructors_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/instructor_table/instructor.php';
        event.preventDefault();
    });

    $('#student_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/student_table/student.php';
        event.preventDefault();
    });

    $('#view_course').on('click', function(event){
        window.location.href='/csc315_final_project/views/course_table/course.php';
        event.preventDefault();
    });

    $('#view_department').on('click', function(event){
        window.location.href='/csc315_final_project/views/department_table/department.php';
        event.preventDefault();
    });

    $('#view_grades').on('click', function(event){
        window.location.href='/csc315_final_project/views/grade_table/grade.php';
        event.preventDefault();
    });

    $('#view_semester').on('click', function(event){
        window.location.href='/csc315_final_project/views/semester_table/semester.php';
        event.preventDefault();
    });

});

// ####################################################################################################
// ####################################################################################################
// DEPARTMENT TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################
function updateFinaid(type) {

    $('#finaid_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        let finaid_id = $('#finaid_id').val();
        let student_id = $('#student_id').val();
        let finaid_source = $('#finaid_source').val();
        let finaid_amount = $('#finaid_amount').val();
        finaidClearAll();


        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/financial_aid_controller/financial_aid_processor.php?mode=update',
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                finaid_id: finaid_id,
                student_id: student_id,
                finaid_source: finaid_source,
                finaid_amount: finaid_amount
            },
            success: function () {

            }
        });
    });
}

function insertFinaid(type, mode) {
    $('#finaid_form').on('submit', function (event) {

        event.stopImmediatePropagation();
        let student_id = $('#student_id').val();
        let finaid_source = $('#finaid_source').val();
        let finaid_amount = $('#finaid_amount').val();
        finaidClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/financial_aid_controller/financial_aid_processor.php' + '?mode=' + mode,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                student_id: student_id,
                finaid_source: finaid_source,
                finaid_amount: finaid_amount
            },
            success: function () {
                location.reload();
            }
        });
    });
}

// ####################################################################################################
// DELETE INSTRUCTOR
function deleteFinaid(type, mode, finaid_id) {
    $('#finaid_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            url: '/csc315_final_project/controller/financial_aid_controller/financial_aid_processor.php' + '?mode=' + mode + '&finaid_id='+ finaid_id,
            crossOrigin: true,
            cache: false,
            async: false,
            type: type,
            dataType: 'JSON',
        });
    });
}

function finaidClearAll() {
    $('#student_id').val('');
    $('#finaid_amount').val('');
    $('#finaid_source').val('');
}