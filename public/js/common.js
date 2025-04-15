var count = 1;

// add feild status when add, update a project
$('#add_status').click(function () {
    let count_add = parseInt($("#count_add").text())+1;
    $("#count_add").text(count_add)
    var html = `<div class="input-daterange form-group" data-plugin="datepicker">
                    <div class="input-group" style="width: 30%">
                        <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control" name="status[`+ count_add +`][start_time]"
                            readonly/>
                    </div>
                    <div class="input-group" style="width: 30%">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control" name="status[`+ count_add +`][end_time]"
                            readonly/>
                    </div>
                    <div class="row">
                        <select class="form-control col-md-7" name="status[`+ count_add +`][active]">
                            <option value="1">Activate</option>
                            <option value="0">Locked</option>
                        </select>
                        <button type="button" class="btn btn-floating btn-danger btn-xs"
                                style="margin: auto; margin-left: 10px"
                                onclick="deleteStatus(this);"><i class="icon md-minus"
                                                                aria-hidden="true"></i>
                        </button>
                    </div>
                </div>`;

    $("#project_status").append(html);
});

//bind to all instances of class "date".
$(document).on('focus',".input-daterange", function(){
   $(this).datepicker();
});

function deleteStatus(element){
    $(element).parent().parent().remove();
}

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

$(document).ready(function () {
    $('#comment1').on('input', function() {
        window.comment_1 = $(this).val();
    });

});

function createRow() {
    let count_add = parseInt($("#count_add").text())+1;
    $("#count_add").text(count_add);
    var newrow = [
        '<textarea maxlength="1000" name="customBug['+ count_add + '][task]" id="task"></textarea>',
        '<textarea maxlength="1000" name="customBug['+ count_add + '][description]"></textarea>',
        '<textarea maxlength="1000" name="customBug['+ count_add + '][deep_cause_1]"></textarea>',
        '<textarea maxlength="1000" name="customBug['+ count_add + '][deep_cause_2]"></textarea>',
        '<textarea maxlength="1000" name="customBug['+ count_add + '][deep_cause_3]"></textarea>',
        '<textarea maxlength="1000" name="customBug['+ count_add + '][improment_solution]"></textarea>',
        '<i class="icon md-minus-circle deleteButton" aria-hidden="true" style="color: #f44336;font-size: 30px;"></i>',
    ];

    return '<tr style="height: 70px"><td>' + newrow.join('</td><td style="text-align: center;">') + '</td></tr>';
}

$('button#add').click(function() {
    var lastvalue = 1 + parseInt($('table#applyList tbody').children('tr:last').children('td:first').text());
    $('table#customer_bug tbody').append(createRow(lastvalue));
});

$('table#customer_bug').on('click','.addButton',function() {
    $(this).closest('tr').after(createRow(0));
}).on('click','.deleteButton',function() {
    $(this).closest('tr').remove();
});

function deleteRow(element){
    $(element).parent().parent().remove();
}

