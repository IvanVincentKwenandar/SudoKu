function load_score(){
    var idp1 = $("#idp1").val();

    $.ajax({
        url: "api/get_score.php?idp1=" + idp1,
        method: "GET",
        success: function(data){
            $("#absentHeader").html(' ');
            $("#absentTable").html('');
            var row1 = $("<tr></tr>");
            var col = $("<th scope='col' rowspan='2'>id</th>");
            var col1 = $("<th scope='col' rowspan='2'>Time</th>");
            var col2 = $("<th scope='col' rowspan='2'>Score</th>");
            var col3 = $("<th scope='col' rowspan='2'>Difficulty</th>");
            row1.append(col);
            row1.append(col1);
            row1.append(col2);
            row1.append(col3);

            $("#absentHeader").append(row1);            

            var last_id = data['data'][0]['idp1'];
            var last_time = data['data'][0]['time'];
            var last_score = data['data'][0]['score'];
            var last_diff = data['data'][0]['difficulties'];
            var check = data['data'][0]['id'];
            col = $("<td>"+last_id+"</td>");
            col1 = $("<td>"+last_time+"</td>");
            col2 = $("<td>"+last_score+"</td>");
            var row = $("<tr scope='row'></tr>");
            row.append(col);
            row.append(col1);
            row.append(col2);

            if (last_diff == 0){
                col3 = $("<td> Expert </td>");
            } else if (last_diff == 1){
                col3 = $("<td> Hard </td>");
            } else if (last_diff == 2){
                col3 = $("<td> Normal </td>");
            } else if (last_diff == 3){   
                col3 = $("<td> Easy </td>");
            } else if (last_diff == 4){
                col3 = $("<td> Very Easy </td>");
            }    
            
            
            row.append(col3);

            data['data'].forEach(function(data){
                if(check != data['id']){
                $("#absentTable").append(row);
                    row = $("<tr scope='row'></tr>");
                    last_id = data['idp1'];
                    col = $("<td>"+data['idp1']+"</td>");
                    col1 = $("<td>"+data['time']+"</td>");
                    col2 = $("<td>"+data['score']+"</td>");
                    row.append(col);
                    row.append(col1);
                    row.append(col2);
                    
                    if (data['difficulties'] == 0){
                        col3 = $("<td> Expert </td>");
                    } else if (data['difficulties'] == 1){
                        col3 = $("<td> Hard </td>");
                    } else if (data['difficulties'] == 2){
                        col3 = $("<td> Normal </td>");
                    } else if (data['difficulties'] == 3){   
                        col3 = $("<td> Easy </td>");
                    } else if (data['difficulties'] == 4){
                        col3 = $("<td> Very Easy </td>");
                    }    
                    
                    row.append(col3);
                }
            })
            
            $("#absentTable").append(row);
        }
    })
}