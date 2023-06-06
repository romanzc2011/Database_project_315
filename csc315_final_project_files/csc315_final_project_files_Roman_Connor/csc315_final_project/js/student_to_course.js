$(document).ready(function (){

    $('#back_to_course').on('click', function(event){
        window.location.href='/csc315_final_project/views/course_table/course.php';
        event.preventDefault();
    });

    // INSERT STUDENT
    $('#student_add_to').on('click', function (event) {
        insertStudentToCourse('POST', 'insert');
    });

    // DELETE STUDENT
    $('#student_delete_from').on('click', function (event) {
        deleteStudentFromCourse('GET', 'delete', $('#studentID').val(), $('#courseID').val());
    });

    // VIEW SCHEDULE
    $('#view_schedule').on('click', function (event) {
        window.open('/csc315_final_project/views/course_table/view_schedule.php?mode=select&student_id=' + $('#studentID').val());
    });
});

function insertStudentToCourse(type, mode) {
    $('#add_to_course_form').on('submit', function (event) {
        event.stopImmediatePropagation();

        let course_id = $('#course_id').val();
        let student_id = $('#student_id').val();
        studentCourseClearAll()

        $.ajax({
            crossOrigin: true,
            url: '/csc315_final_project/controller/add_student_to_course/add_student_to_course.php?mode='+mode,
            type: type,
            async: false,
            dataType: 'JSON',
            data: {
                course_id: course_id,
                student_id: student_id
            },
            success: function () {
            location.reload()
            }
        });
    });
}

// DELETE INSTRUCTOR
function deleteStudentFromCourse(type, mode, student_id, course_id) {
    $('#add_to_course_form').on('submit', function (event) {
        event.stopImmediatePropagation();
        $.ajax({
            url: '/csc315_final_project/controller/add_student_to_course/add_student_to_course.php' + '?mode=' + mode
                + '&student_id='+ student_id + '&course_id=' + course_id,
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

function studentCourseClearAll()
{
    $('#course_id').val('');
    $('#student_id').val('');
}