$(document).ready(function () {
    // SELECT ALL DEPARTMENT
    $('#show_department').on('click', function (event) {
        window.open('/csc315_final_project/views/department_table/display_all_department.php?mode=select');
    });

    // SELECT SPECIFIC DEPARTMENT
    $('#find_deptStaff').on('click', function (event) {
        window.open('/csc315_final_project/views/department_table/display_department.php?mode=select&faculty_id=' + $('#facultyID').val());
    });

    // INSERT DEPARTMENT
    $('#add_deptStaff').on('click', function (event) {
        insertDepartment('POST', 'insert', null);
    });

    // UPDATE DEPARTMENT
    $('#update_dept').on('click', function (event) {
        updateDepartment('POST', 'update', $('#facultyID').val());
    })

    // DELETE DEPARTMENT MEMBER
    $('#delete_deptMember').on('click', function (event) {
        deleteDepartment('POST', 'delete', $('#facultyID').val());

    });

    // VIEW STUDENT PAGE
    $('#student_page').on('click', function(event){
        window.location.href='/csc315_final_project/views/student_table/student.php';
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

    // VIEW FINANCIAL PAGE
    $('#fin_aid').on('click', function(event){
        window.location.href='/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // VIEW SEMESTER PAGE
    $('#view_semester').on('click', function(event){
        window.location.href='/csc315_final_project/views/semester_table/semester.php';
        event.preventDefault();
    });

    // VIEW GRADES PAGE
    $('#view_grades').on('click', function (event) {
        window.location.href = '/csc315_final_project/views/grade_table/grade.php';
        event.preventDefault();
    });
});

// ####################################################################################################
// ####################################################################################################
// DEPARTMENT TABLE FUNCTIONS
// ####################################################################################################
// ####################################################################################################
function updateDepartment(type, mode, faculty_id) {
    $('#department_form').on('submit', function (event) {
        let department_id = $('#department_id').val();
        let department_name = $('#department_name').val();
        departmentClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/department_controller/department_processor.php' + '?mode=' + mode + '&faculty_id=' + faculty_id,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                department_name: department_name,
                department_id: department_id
            },
            success: function () {

            }
        });
    });
}

function insertDepartment(type, mode, faculty_id) {
    $('#department_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        let instructor_id = $('#instructor_id').val();
        let department_id = $('#department_id').val();
        let department_name = $('#department_name').val();
        departmentClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/department_controller/department_processor.php' + '?mode=' + mode,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                instructor_id: instructor_id,
                department_name: department_name,
                department_id: department_id
            },
            success: function () {

            }
        });
    });
}

// ####################################################################################################
// DELETE INSTRUCTOR
function deleteDepartment(type, mode, faculty_id) {
    $('#department_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            url: '/csc315_final_project/controller/department_controller/department_processor.php' + '?mode=' + mode + '&faculty_id='+ faculty_id,
            crossOrigin: true,
            cache: false,
            async: false,
            type: type,
            dataType: 'JSON',
        });
    });
}

function departmentClearAll() {
    $('#faculty_id').val('');
    $('#instructor_id').val('');
    $('#department_name').val('');
    $('#department_id').val('');
    $('#instructor_lastname').val('');
}