$(document).ready(function(){
   init();
});

let init = function(){
    $("#car-list").text('');
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
            xhr.setRequestHeader("Authorization", localStorage.getItem("token"));
        },
        success: function(data){
            data = $.parseJSON(data);
            buildOrders(data);
        },
        statusCode: {
            401: function(){
                alert('401');
            },
            404: function(){
                alert('404');
            },
            204: function(){
                alert('204');
            }
        }
    });
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
    localStorage.removeItem("token");
    localStorage.removeItem("login");
    init();
    $.ajax({
        type: 'DELETE',
        url: 'api/users',
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization", localStorage.getItem("token"));
        },
        success: function(){
            
        }
    });
}

let addOrder = function(carId){

}

let buildHeader = function(){
    $("#login-form-cont").hide();
    $("#logout-butt").hide();
    $("#orders-butt").hide();
    $("#cars-butt").hide();
    $("#hello").text('');
    if(checkAuth()){
        $("#login-butt").hide();
        $("#logout-butt").show();
        $("#registr-butt").hide();
        $("#orders-butt").show();
        $("#hello").text("Hello, "+localStorage.getItem('login'));
    }

    //events
    $("#login-butt").on( "click", function() {
        $("#login-form-cont").show();
        $("#login-butt").hide();
    });
    $("#logout-butt").on( "click", function() {
        //$("#login-form-cont").show();
        logout();
        $("#login-butt").show();
        $("#registr-butt").show();
        $("#orders-list").hide();
        $("#orders-list").text('');
        $("#car-list").show();
        init();
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
        getOrders();
        $("#orders-list").show();
        $("#car-list").hide();
        $("#cars-butt").show();
        $("#orders-butt").hide();
    });
    $("#cars-butt").on("click", function(){
        buildCarsList();
        $("#car-list").show();
        $("#cars-butt").hide();
        $("#orders-butt").show();
    });
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

let buildOrders = function(orders){
    $("#orders-list").text("");

    let $thead = $("<tr>").append(
        $("<th>").text("Mark"),
        $("<th>").text("Model"),
        $("<th>").text("Year"),
        $("<th>").text("Price"),
        $("<th>").text("Pay type")
    );

    let $table = $("<table>").append($thead);
    console.log(orders);

    $.each(orders, function(i, item){
        let $row = $("<tr>").append(
            $("<th>").text(item.mark),
            $("<th>").text(item.model),
            $("<th>").text(item.year),
            $("<th>").text(item.price),
            $("<th>").text(item.pay_type),
        );
        $table.append($row);    
    });
    $("#orders-list").append($table);
    console.log($("#order-list"));
    //let tr = $("<tr>");
    //let th = $("<th></th>");
    //console.log(Object.keys(orders));
    /*
    th.text("")
    $.each(data, function(i, item)){
        let div = $("<div></div>");
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
        div.append(`<span>Mark: ${item.mark}</span><br>`);
    }*/
}



/*let showAuthInfo = function(){
    //alert(1);
    init();
    
}*/

let checkAuth = function(){
    //let id = localStorage.getItem('user_id');
    let token = localStorage.getItem('token')
    if(token){
        return true;
    } else {
        return false;
    }
}

