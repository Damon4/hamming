$("#button").bind("click",  function(){
    var sourse_code = $("#sourse_code").val();
    getData(sourse_code);
});

function getData(sourse_code){
    $.ajax({
        type: "POST",
        data: "code=" + sourse_code,
        url: "/hamming.php",
        dataType: "json",
        success: function(html) {
            console.log(html);
            hamming(html);
        }
    })
}

function hamming(html) {
    tableBuild(html["table"]);
    alphaBuild(html["alpha"]);
}

function alphaBuild (html) {
    var source = html,
	    result = "",
	    str = "",
	    key = "";
    for (key in source) {
        str = source[key];
        if (str !== null) {
            result += "<li>"+key+": "+ str +"</li>"
        }
    }
    $("#alpha").html("").append(result).fadeIn(300);
}

function tableBuild(html) {
    var rows = html.length; //количество будущих строк
    var cells = html[0].length;//количество будущих колонок

    var table = $("#table");
    table.html("<thead><tr></tr></thead><tbody></tbody>");

    //работаем с шапкой

    for (var i=0; i < cells; i++) { // добавляем шапку
        table.find("thead tr").prepend( // цикл добавления строк в шапке
            "<th>V" + i + "</th>"
        );
    }
    table.find("thead tr").prepend("<th>i</th>");

    //цикл на строку
    for (var i=0; i < rows; i++) { // добавляем сами строки
        var num = i+1; //определяем номер строки
        var str = html[i]; //получаемое бинарное число
        var cell_temp = str.replace(/(\d)(?=(?:\d)+$)/g, "$1,"); //разбиваем значение почисленно запятыми
        var ss = cell_temp.split(","); //разбиваем результат на числа
        var cell = "";

        for (a in ss) { // цикл создания ячеек
            var cell_value = ss[a];

            cell_temp = "<td data-cell_value="+cell_value+" data-cell>" + ss[a] + "</td>";
            cell = cell+cell_temp;
        }

        $("#table").find("tbody").append( // цикл добавления строк
            "<tr data-row="+num+"><td>" + num + "</td>" + cell + "</tr>"
        );
    }
    $("#table").fadeIn(300);
}