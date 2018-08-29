$(document).ready(function(){
    init();
    $("#login-butt").on( "click", function(event) {
        event.preventDefault();
        $("#login-form-cont").show();
        $("#login-butt").hide();
        $("#register-butt").hide();
        $("#register-form-cont").hide();
    });
    $("#register-butt").on("click", function(event){
        event.preventDefault();
        $("#register-butt").hide();
        $("#register-form-cont").show();
        $("#login-form-cont").hide();
        $("#login-butt").hide();
    });
    $("#register-cancel").on("click", function(event){
        event.preventDefault();
        $("#register-butt").show();
        $("#register-form-cont").hide();
        $("#login-butt").show();
        
    });
    $("#logout-butt").on( "click", function(event) {
        event.preventDefault();
        logout();
        $("#login-butt").show();
        $("#registr-butt").show();
        $("#orders-list").hide();
        $("#orders-list").text('');
        $("#car-list").show();
        init();
    });
    $("#orders-butt").on("click", function(event){
        event.preventDefault();
        getOrders();
        if($("#orders-butt").text() == 'Show orders'){
            $("#orders-list").show();
            $("#orders-butt").text('Hide orders');
        } else {
            $("#orders-list").hide();
            $("#orders-butt").text('Show orders');
        }
        
    });
    $("#cars-butt").on("click", function(event){
        event.preventDefault();
        buildCarsList();
        $("#orders-list").hide();
        $("#orders-list").text('');
        $("#car-list").show();
        //$("#cars-butt").hide();
        $("#orders-butt").show();
    });
    $("#login-cancel").on("click", function(event){
        event.preventDefault();
        $("#login-form")[0].reset();
        $("#login-form-cont").hide();
        $("#login-butt").show();
        $("#register-butt").show();
    });
    $("#order-cancel").on("click", function(event){
        event.preventDefault();
        $("#order-form")[0].reset();
        $("#order-form-cont").hide();
        $("#car-list").show();
    });
    $("#login-form").on("submit", function(event){
        event.preventDefault();
        let formData = $("#login-form").serializeArray();
        $("#login-form")[0].reset();
        login(formData);
        
    });
    $("#order-form").on("submit", function(event){
        event.preventDefault();
        let orderData = $("#order-form").serializeArray();
        $("#order-form")[0].reset();
        addOrder(orderData);
        $("#order-cancel").click();
    });
    $("#register-form").on("submit", function(event){
        event.preventDefault();
        let registerData = $("#register-form").serializeArray();
        $( "#myform" ).validate({
            rules: {
                regPassword: "required",
                regPasswordRepeat: {
                equalTo: "#regPassword"
              }
            }
        });
        registration(registerData);
    });

    
});

let showOrderForm = function(carId){
    $("#car-list").hide();
    $("#order-form-cont").show();
    $("#order-car-id").val(carId);
}

let init = function(){ 
    buildHeader();
    buildCarsList();
}

let getAllCars = function(){
    $.ajax({
        type: "GET",
        url: "api/cars/",
        async: false
    }).done(function(data){
        localStorage.setItem('cars_list', data);
    });
}

let getOrders = function(){
    $.ajax({
        type: "GET",
        url: "api/orders/",
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization", localStorage.getItem("token"));
        },
        success: function(data){
            data = $.parseJSON(data);
            buildOrders(data);
        },
        statusCode: {
            401: function(data){
                logout();
            },
            404: function(data){
                alert('404');
            },
            400: function(data){
                alert('400');
            },
            204: function(data){
                alert('204');
            }
        }
    });
}

let addOrder = function(orderData){
    //console.log(orderData);
    $.ajax({
        type: "POST",
        url: "api/orders/",
        async: false,
        data: orderData,
        beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization", localStorage.getItem("token"));
        },
        success: function(data){
            getOrders();
        },
        statusCode: {
            401: function(){
                alert('401');
            },
            404: function(data){
                alert('404');
            },
            400: function(data){
                alert('400');
            },
            204: function(data){
                alert('204');
            }
        }
    });
}

let registration = function(){
    
}

let login = function(params){
    $.ajax({
        type: 'PUT',
        url: 'api/users/',
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(params[0].value + ":" + params[1].value));
        },
        success: function(data){
            data = $.parseJSON(data);

            localStorage.setItem('token', data.token);
            localStorage.setItem('login', data.login);

            init();
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

let logout = function(){
    
    $.ajax({
        type: 'DELETE',
        url: 'api/users',
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization", localStorage.getItem("token"));
        },
        success: function(){
            localStorage.removeItem("token");
            localStorage.removeItem("login");
            init();
        }
    });
}

let buildHeader = function(){
    //$("#car-list").text('');
    $("#orders-list").text('');
    $("#orders-list").hide();
    $("#register-form-cont").hide();
    $("#login-form-cont").hide();
    $("#order-form-cont").hide();
    $("#logout-butt").hide();
    $("#orders-butt").hide();
    //$("#cars-butt").hide();
    $("#hello").text('');
    if(checkAuth()){
        $("#login-butt").hide();
        $("#logout-butt").show();
        $("#registr-butt").hide();
        $("#orders-butt").show();
        $("#hello").text("Hello, "+localStorage.getItem('login'));
    }
}

let buildCarsList = function(){
    if(!localStorage.getItem('cars_list')){
        getAllCars();
    }
    let data = JSON.parse(localStorage.getItem('cars_list'));
    $("#car-list").text("");
    $("#car-list").append($("<h2>").text('Cars'));
    $("#car-list").append($("<hr>"));
    $.each(data, function(i, item){
        let div = $("<div></div>");
        div.append(`<span class="car-mark">${item.mark}</span><br>`);
        div.append(`<span class="car-model">${item.model}</span><br>`);
 
        div.append(`<span>Year: ${item.year}</span><br>`);

        div.append(`<span>Engine size: ${item.engine_size}</span><br>`);

        div.append(`<span>Max speed: ${item.max_speed}</span><br>`);

        div.append(`<span>Color: ${item.color}</span><br>`);

        div.append(`<span class="car-price">$${item.price}</span><br>`);
        if(checkAuth()){
            div.append(`<div class="car-butt-buy" onclick="showOrderForm(${item.id})">Order</div>`);
        }
        $("#car-list").append(div);
    });
}

let buildOrders = function(orders){
    $("#orders-list").text("");
    $("#orders-list").append($("<h2>").text('Orders'));
    let $thead = $("<tr>").append(
        $("<th>").text("Mark"),
        $("<th>").text("Model"),
        $("<th>").text("Year"),
        $("<th>").text("Price"),
        $("<th>").text("Pay type")
    );


    let $table = $("<table>").append($thead);

    $.each(orders, function(i, item){
        let $row = $("<tr>").append(
            $("<td>").text(item.mark),
            $("<td>").text(item.model),
            $("<td>").text(item.year),
            $("<td>").text(item.price),
            $("<td>").text(item.pay_type),
        );
        $table.append($row);    
    });
    $("#orders-list").append($table);
    $("#orders-list").append($("<hr>"));
}

let checkAuth = function(){
    let token = localStorage.getItem('token')
    if(token){
        return true;
    } else {
        return false;
    }
}

