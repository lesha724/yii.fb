function initChosen()
{
    $('.chosen-select').chosen();
}

function initSpinner()
{
    var opts = {
        lines:  11, // The number of lines to draw
        length: 7, // The length of each line
        width:  4,  // The line thickness
        radius: 5  // The radius of the inner circle
    };
    var target = document.getElementById('spinner');
    var spinner = new Spinner(opts).spin(target);
}

function addGritter(title, text, className)
{
    obj = {
        title: title,
        text: text,
        class_name: 'gritter-'+className
    }
    $.gritter.add(obj)
}