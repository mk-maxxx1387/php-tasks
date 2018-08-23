$(document).ready(function(){
   init();
});

let init = function(){
    buildHeader();
    buildCarsList();
}

let getAllCars = function(){
    $.ajax({
        type: "GET",
        url: "api/cars",
        async: false
    }).done(function(data){
        localStorage.setItem('cars_list', data);
    });
}

let getOrders = function(){
    $.ajax({
        type: "GET",
        url: "api/orders",
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem("token"));
        },
        success: function(data){
            console.log(data);
        },
        statusCode: {
            401: function(){
                alert('401');
            },
            404: function(){
                alert('404');
            }
        }
    });
}

let addOrder = function(carId){

}

let buildCarsList = function(){
    if(!localStorage.getItem('cars_list')){
        getAllCars();
    }
    let data = JSON.parse(localStorage.getItem('cars_list'));
    $("#car-list").text("");
    $.each(data, function(i, item){
        let div = $("<div></div>");
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Model: ${item.model}</span><br>`);

        div.append(`<span>Year: ${item.year}</span><br>`);

        div.append(`<span>Engine size: ${item.engine_size}</span><br>`);

        div.append(`<span>Max speed: ${item.max_speed}</span><br>`);

        div.append(`<span>Color: ${item.color}</span><br>`);

        div.append(`<span>Price: ${item.price}</span><br>`);
        if(checkAuth()){
            div.append(`<button onclick="addOrder(${item.id})">Order</button>`);
        }
        div.append($("<hr>"));
        $("#car-list").append(div);
    });
}

let buildOrders = function(){
    //if
    let orders = getOrders();
}

let login = function(params){
    $.ajax({
        type: 'PUT',
        url: 'api/users',
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(params[0].value + ":" + params[1].value));
        },
        success: function(data){
            data = $.parseJSON(data);
            localStorage.setItem('user_id', data.user_id);
            localStorage.setItem('token', data.token);
            localStorage.setItem('login', data.login);
            //console.log(localStorage.getItem('user_id'));
            //showAuthInfo();
            getOrders();
        },
        statusCode: {
            401: function(){
                alert('401');
            },
            404: function(){
                alert('404');
            }
        }
    });
}

let showAuthInfo = function(){
    init();
}

let checkAuth = function(){
    let id = localStorage.getItem('user_id');
    let token = localStorage.getItem('token')
    if(id && token){
        return true;
    } else {
        return false;
    }
}

let buildHeader = function(){
    $("#login-form-cont").hide();
    $("#logout-butt").hide();
    $("#orders-butt").hide();
    if(checkAuth()){
        $("#login-butt").hide();
        $("#logout-butt").show();
        $("#registration").hide();
        $("#orders-butt").show();
    }
    $("#login-butt").on( "click", function() {
        $("#login-form-cont").show();
        $("#login-butt").hide();
    });
    $("#login-cancel").on("click", function(event){
        event.preventDefault();
        $("#login-form-cont").hide();
        $("#login-butt").show();
    });
    $("#login-form").on("submit", function(event){
        event.preventDefault();
        let formData = $("#login-form").serializeArray();
        login(formData);
    });
    $("#orders-butt").on("click", function(){
        buildOrders();
        $("#orders-list").show();
        $("#car-list").hide();
    })
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


