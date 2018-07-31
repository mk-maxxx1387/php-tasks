$(document).ready(function(){
    $("#soap-butt-1").click(function(){
        invTextCasing('soap');
    });

    $("#curl-butt-1").click(function(){
        invTextCasing('curl');
    });

    $("#soap-butt-2").click(function(){
        getCurrencies('soap');
    })
;
    $("#curl-butt-2").click(function(){
        getCurrencies('curl');
    });

    let invTextCasing = function(action){
        let param = $("#text-casing-inp").val();
        let url = `${action}/invertStr/${param}`;

        $("#result-1").load("index.php",
            {'action': url},
            function(data){
                console.log(data);
            });
    };

    let getCurrencies = function(action){
        let url = `${action}/getCurrencies`;
        $.ajax({
            method: "POST",
            url: "index.php",
            data: {"action": url}
        })
        .done(function(data){
            console.log(data);
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
