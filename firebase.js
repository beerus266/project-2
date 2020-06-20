// var firebase = require("firebase");
// var config = {
//     apiKey: "AIzaSyDuGKf8vzUR7FEQnawlbw8AqjZC5LavW1o",
//     authDomain: "database-project-second.firebaseapp.com",
//     databaseURL: "https://database-project-second.firebaseio.com",
//     storageBucket: "database-project-second.appspot.com"
//   };
//   firebase.initializeApp(config);

//   // Get a reference to the database service
//   var database = firebase.database();
// // console.log("ok");
// // var firebaseConfig = {
// //     apiKey: "AIzaSyDuGKf8vzUR7FEQnawlbw8AqjZC5LavW1o",
// //     authDomain: "database-project-second.firebaseapp.com",
// //     databaseURL: "https://database-project-second.firebaseio.com",
// //     projectId: "database-project-second",
// //     storageBucket: "database-project-second.appspot.com",
// //     messagingSenderId: "253941557897",
// //     appId: "1:253941557897:web:7e2a139ad836c633b8b458",
// //     measurementId: "G-XGVEBHQGDC"
// //   };
// console.log(database);
var quantity;
var rowClick;
var colClick;
var interval;
var lengthMax = 0;
var table = $("#table").DataTable({
});
function getData(){
    return $.ajax({
        method:'get',
        url: window.location.origin+'/firebase-getData',
        data:{},
        dataType:'json'
    });
}

function getInfo(arrUID){
    return $.ajax({
        method:'get',
        url: window.location.origin+'/get-info-student',
        data:arrUID,
        dataType:'json'
    });
}
function getInfoStudentByMSSV(dataMSSV){
    return $.ajax({
        method:'get',
        url: window.location.origin+'/get-info-student-by-mssv',
        data:dataMSSV,
        dataType:'json'
    });
}

$("#table tbody").on('click','td', function(){
    rowClick = $(this).parent().index();
    // colClick = $(this).index();
    let dataMSSV = {
        'mssv' :table.cell(rowClick,1).data()
    }

    getInfoStudentByMSSV(dataMSSV).done(function(data)
    {
        // console.log(data);
        $("#mssv").text(data.data.MSSV);
        $("#education").text(data.data.education);
        $("#email").text(data.data.email);
        $("#k").text(data.data.k);
        $("#name").text(data.data.name);
        $("#program").text(data.data.program);
        $("#sex").text(data.data.sex);
        $("#start_year").text(data.data.start_year);
        $("#status").text(data.data.status);
        $("#avatar").attr("src","/dist/img/avatar"+table.cell(rowClick,0).data()+".png");
    }).fail(function(e){console.log(e)});
    // console.log(table.cell(rowClick,colClick).data());
});
interval = setInterval(function()
{
    getData().done(function(data1)
    {
        console.log(data1);
        let fakeData = [...data1.data];
        for (let i =0 ; i<data1.data.length ; i++){
            if(data1.data[i] == null){
                data1.data.splice(i--,1);
            }
        }
        // console.log(data1);
        let arrUID = data1.data.map((element) => (element.uid));
        // console.log(arrUID);
        

        let dataUID ={
            'arrUID':arrUID
        }
        if (data1.data.length != lengthMax){
        
            getInfo(dataUID).done(function(data2)
            {
                console.log(data2);
                    table.clear().draw();
                    for (let i = 0; i<data2.data.length; i++)
                    {
                        if(data2.data[i]==null) continue;
                        table.row.add([
                            table.rows().count()+1,
                            data2.data[i].MSSV,
                            data2.data[i].name,
                            data1.data[i].time
                        ]).draw(false);
                    }
                
            }).fail(function(e){console.log(e)});
            lengthMax = data1.data.length;
        }
    }).fail(function(e){console.log(e)});
},3000);