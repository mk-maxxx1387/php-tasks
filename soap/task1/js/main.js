$(document).ready(function(){
    $("#result-1").text("");
    $("#result-2").text("");


    $("#soap-butt-1").click(function(){
        invTextCasing('soap');
    });

    $("#curl-butt-1").click(function(){
        invTextCasing('curl');
    });

    $("#soap-butt-2").click(function(){
        getCurrencies('soap');
    });

    $("#curl-butt-2").click(function(){
        getCurrencies('curl');
    });

    $("#clear-1").click(function(){
        $("#result-1").text("");
    });
    
    $("#clear-2").click(function(){
        $("#result-2").text("");
    });



    let invTextCasing = function(action){
        let param = $("#text-casing-inp").val();
        if(!param){
            $("#result-1").text("Enter a string to convert");
            return false;
        }
        let url = `${action}/invertStr/${param}`;
        
        $("#result-1").load("index.php",
            {'action': url},
        );
    };

    let getCurrencies = function(action){
        let url = `${action}/getCurrencies`;
        $.ajax({
            method: "POST",
            url: "index.php",
            data: {"action": url}
        })
        .done(function(data){
            $("#result-2").text("");
            let test = $.parseJSON(data);
            $.each(test['tCurrency'], function(i, obj){
                let code = obj['sISOCode'];
                if(typeof(code) == "object" || code === ""){
                    code = "---";
                }
                let name = obj['sName'];
                $("#result-2").append(`ISO Code: ${code} | `);
                $("#result-2").append(`Name: ${name}; <br>`);
                $.each(this, function(name, value){
                    //console.log(name+"__"+value);
                });
            });
            /*
            let dataX = $.parseXML(data);
            $xml = $(dataX);
            let tag = $xml.find("tCurrency");
            tag.each(function(i, elem){

                let iso = $(elem).find("sISOCode").text();
                let name = $(elem).find("sName").text();
                $('#result-2').append(`ISO: ${iso} | `);
                $('#result-2').append(`Name: ${name}<br>`);
            });
            //console.log($tag.find("sISOCode"));
            //$("#result-2").append(data);
            //console.log(data);
            */
        });
    };
});
