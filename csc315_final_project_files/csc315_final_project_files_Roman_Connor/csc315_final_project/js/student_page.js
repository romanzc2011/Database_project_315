$(document).ready(function (event) {
    // ##########################################################################
    // ##########################################################################
    // STUDENT TABLE
    // ##########################################################################
    // ##########################################################################

    $('#instructors_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/instructor_table/instructor.php';
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

    $('#view_financial_aid').on('click', function(event){
        window.location.href='/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // Find Button
    $('#find_student').on('click', function () {
        window.open('/csc315_final_project/views/student_table/display_student.php?mode=select&student_id=' + $('#studentID').val());
    });

    // VIEW ALL STUDENTS BUTTON
    $('#view_all_students').on('click', function () {
        window.open('/csc315_final_project/views/student_table/display_all_students.php?mode=select');
    });

    // ##########################################################################
    // New Button
    $('#insert_request').on('click', function () {
        insertStudent('POST', 'insert', null);
    });

    // ##########################################################################
    // UPDATE STUDENT
    $('#student_update').on('click', function(){
       updateStudent('POST', 'update', $('#studentID').val());
    });

    // ##########################################################################
    // Delete Button
    $('#delete_request').on('click', function () {
        deleteStudent('GET', 'delete', $('#studentID').val());
    });
});

// ####################################################################################################
// ####################################################################################################
// STUDENT TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################

// #######################################################################
// New Button
// #######################################################################
function insertStudent(type, mode) {
    $('#student_form').on('submit', function (event) {
        // #######################################################################
        // VARIABLES FOR INSERTING INTO DATABASE
        event.stopImmediatePropagation();
        let ssn = $('#ssn').val();
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let email = $('#email').val();
        let age = $('#age').val();
        let address = $('#address').val();
        let birth_date = $('#birth_date').val();
        let major = $('#major').val();
        studentClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/student_controller/student_processor.php' + '?mode=' + mode,
            type: type,
            dataType: 'JSON',
            async: false,
            data: {
                ssn:ssn,
                firstName: firstName,
                lastName: lastName,
                age: age,
                address: address,
                birth_date: birth_date,
                email: email,
                major: major
            },
            success: function (response) {
            location.reload();
            }
        });
    });
}

// #######################################################################
// Update button
// #######################################################################
function updateStudent(type, mode, student_id) {
    $('#student_form').on('submit', function (event) {
        // #######################################################################
        // VARIABLES FOR INSERTING INTO DATABASE
        event.stopImmediatePropagation();
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let email = $('#email').val();
        let age = $('#age').val();
        let address = $('#address').val();
        let birth_date = $('#birth_date').val();
        let major = $('#major').val();
        studentClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/student_controller/student_processor.php' + '?mode=' + mode + '&student_id=' + student_id,
            type: type,
            dataType: 'JSON',
            async: false,
            data: {
                firstName: firstName,
                lastName: lastName,
                age: age,
                address: address,
                birth_date: birth_date,
                email: email,
                major: major
            },
            success: function (response) {
                location.reload();
            }
        });
    });
}

// #######################################################################
// Delete button
// #######################################################################
function deleteStudent(type, mode, student_id) {
    $('#student_form').on('submit', function (event) {
        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/student_controller/student_processor.php' + '?mode=' + mode + '&student_id=' + student_id,
            type: type,
            async: false,
            cache: false,
            dataType: 'JSON',
        }).done(function () {
        });
    });
}

function studentClearAll()
{
    $('#firstName').val('');
    $('#lastName').val('');
    $('#email').val('');
    $('#age').val('');
    $('#address').val('');
    $('#birth_date').val('');
    $('#major').val('');
    $('#ssn').val('');
}