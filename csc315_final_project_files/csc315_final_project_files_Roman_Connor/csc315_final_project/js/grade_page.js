$(document).ready(function () {
    // SELECT ALL GRADES
    $('#display_all_grades').on('click', function (event) {
        window.open('/csc315_final_project/views/grade_table/display_all_grades.php?mode=select');
    });

    // SELECT SPECIFIC GRADE
    $('#display_grades').on('click', function (event) {
        window.open('/csc315_final_project/views/grade_table/display_grade.php?mode=select&studentID=' + $('#studentID').val());
    });

    // INSERT GRADE
    $('#insert_grades').on('click', function (event) {
        insertGrade('POST', 'insert', null);
    });

    // UPDATE GRADE
    $('#update_grades').on('click', function (event) {
        updateGrade('POST', 'update', $('#gradeID').val());
    });

    // DELETE GRADE
    $('#delete_grades').on('click', function (event) {
        deleteGrade('POST', 'delete', $('#gradeID').val());
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
    $('#view_instructors').on('click', function(event){
        window.location.href='/csc315_final_project/views/instructor_table/instructor.php';
        event.preventDefault();
    });

    // VIEW FIANCIAL AID PAGE
    $('#view_financial_aid').on('click', function(event){
        window.location.href='/csc315_final_project/views/financial_aid_table/financial_aid.php';
        event.preventDefault();
    });

    // VIEW SEMESTER PAGE
    $('#view_semester').on('click', function(event){
        window.location.href='/csc315_final_project/views/semester_table/semester.php';
        event.preventDefault();
    });

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
function updateGrade(type, mode, grade_id) {
    $('#grade_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        let grade_id = $('#gradeID').val();
        let grade = $('#grade').val();
        gradesClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/grade_controller/grade_processor.php' + '?mode=' + mode + '&grade_id=' + grade_id,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                grade: grade
            },
            success: function () {

            }
        });
    });
}

function insertGrade(type, mode) {
    $('#grade_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        let student_id = $('#student_id').val();
        let course_id = $('#course_id').val();
        let grade = $('#grade').val();
        gradesClearAll();

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/grade_controller/grade_processor.php' + '?mode=' + mode,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                student_id: student_id,
                course_id: course_id,
                grade: grade
            },
            success: function () {

            }
        });
    });
}

// ####################################################################################################
// DELETE INSTRUCTOR
function deleteGrade(type, mode, grade_id) {
    $('#grade_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            url: '/csc315_final_project/controller/grade_controller/grade_processor.php' + '?mode=' + mode + '&grade_id='+ grade_id,
            crossOrigin: true,
            cache: false,
            async: false,
            type: type,
            dataType: 'JSON',
        });
    });
}

function gradesClearAll() {
    $('#course_id').val('');
    $('#student_id').val('');
    $('#grade').val('');
}