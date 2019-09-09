$("#form-home-create").submit( function(event) {
    event.preventDefault();
    var name = $("#input-name").val();
    $.ajax(
        {
            type:"POST",
            url:"/belem/school/",
            data:{name: name},
            dataType: "x-www-form-urlencoded",
            success: function(data) {
                console.log(data);
            }
        }
    );
});