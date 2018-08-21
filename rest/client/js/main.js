$(document).ready(function(){
    $("#login-form").hide();
    getAllCars();
    $( "#login" ).on( "click", function() {
        $("#login-form").show();
        $("#login").hide();
    });
    $("#login-cancel").on("click", function(){
        $("#login-form").hide();
        $("#login").show();
    });
    $("#login-form").on("submit", function(){
        event.preventDefault();
        let username = $("login-form").find()
        login();
    });
});


let getAllCars = function(){
    $.ajax({
        type: "GET",
        url: "api/cars",
    }).done(function(msg){
        console.log(msg);
        buildCarsList($.parseJSON(msg));
    });
}

let buildCarsList = function(data){
    //let cars = getAllCars();
    //console.log(JSON.parse(data));
    $.each(data, function(i, item){
        let div = $("<div></div>");
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Model: ${item.model}</span><br>`);

        div.append(`<span>Year: ${item.year}</span><br>`);

        div.append(`<span>Engine size: ${item.engine_size}</span><br>`);

        div.append(`<span>Max speed: ${item.max_speed}</span><br>`);

        div.append(`<span>Color: ${item.color}</span><br>`);

        div.append(`<span>Price: ${item.price}</span><br>`);
        div.append($("<hr>"));
        $("#car_list").append(div);
        
    });
}

let login = function(username, password){
    type: 'GET',
    url: '/api/login',
    beforeSend: function(){
        xhr.setRequestHeader ("Authorization", "Basic " + btoa(username + ":" + password));
    },
    success: function(){}
}

/*let dialog = $( "#dialog-form" ).dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        "Login": login,
        Cancel: function() {
            dialog.dialog( "close" );
        }
    },
    close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
    }
});*/

/*let form = dialog.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
//    addUser();
});*/


