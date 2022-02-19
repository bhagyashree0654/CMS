$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  let sec = 0
  let min = 0
  let hour = 0

  const start = document.getElementById("start")
  // const reset = document.getElementById("reset")
  const stop = document.getElementById("stop")

  const createInterval = ms => fn => {
    let id = setInterval(fn, ms)
    return () => clearInterval(id)
  }
  let closeSeconds
  let closeMinutes
  let closeHours

  if(stop != null){

  // reset.setAttribute("disabled", true)
  stop.setAttribute("disabled", true);

  }

  if(start != null){
  start.addEventListener("click", () => {
    // alert("Started")

      start_timing = ""+new Date().getHours()+":"+new Date().getMinutes()+":"+new Date().getSeconds();
      // alert(start_timing);
      start_total = new Date().getTime();

    if( !$('#projects').val() ) { 
        $('#alertproj').show();
        $('#alertproj').html('Please select a project');
        return false;
    }
    else{
      if( $('#projects').val() ) { 
        $('#alertproj').hide();
      }
    }
    start.setAttribute("disabled", true)
    document.getElementById("time").classList.remove("pulse")
    // reset.removeAttribute("disabled")
    stop.removeAttribute("disabled")
    closeSeconds = createInterval(1000)(() => {
      sec++
      if (sec >= 60) {
        sec = 0
      }
      let pre = `0${sec}`
      document.getElementById("sec").innerText = sec < 10 ? pre : sec
    })
    closeMinutes = createInterval(60000)(() => {
      min++
      let pre = `0${min}:`
      document.getElementById("min").innerText = min < 10 ? pre : min + ":"
    })

    closeHours = createInterval(3_600_000)(() => {
      hour++
      let pre = `0${hour}:`
      document.getElementById("hour").innerText = hour < 10 ? pre : hour + ":"
    })
  })
}
if(stop != null){
  // submit value here...
  stop.addEventListener("click", () => {

     var task = $('#tasks').val();
     var project = $('#projects').val();
     var dates=new Date();
     var date=dates.toLocaleDateString();

     stop_total=new Date().getTime();
     stop_timing = ""+new Date().getHours()+":"+new Date().getMinutes()+":"+new Date().getSeconds();
     total_time = stop_total - start_total;

     var milliseconds = Math.floor((total_time % 1000) / 100),
     seconds = Math.floor((total_time / 1000) % 60),
     minutes = Math.floor((total_time / (1000 * 60)) % 60),
     hours = Math.floor((total_time / (1000 * 60 * 60)) % 24);
 
      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
    
      total = hours + ":" + minutes + ":" + seconds;

      $.ajax({
          type: "POST",
          url: "addTaskClock",
          data: {
            task:task,
                  project:project,
                  dates:date,
                  start:start_timing,
                  stop: stop_timing,
                  total:total
                  },
          success: function(data) {
            // alert(data);
              var result = data;
              // alert(result);
              if(result.dbStatus == 'SUCCESS'){
                // console.log(result);
                // alert("Successfully Added");
                fetch_data();
                // createTable(alltablesArray);
              }
              
          },
          error: function(data) {
              // alert(data);
              // console.log(data);
              fetch_data();
              // createTable(alltablesArray);
              // $('#timerTbl').DataTable().ajax.reload(null,false);
          }
      });

    start.removeAttribute("disabled")
    stop.setAttribute("disabled", true)
    document.getElementById("time").classList.add("pulse")
    closeSeconds()
    closeMinutes()
    closeHours()
  })
}

  // const resetTime = () => {
  //   closeSeconds()
  //   closeMinutes()
  //   closeHours()
  //   sec = 0
  //   min = 0
  //   hour = 0
  //   const xs = document.querySelectorAll(".t")
  //   xs.forEach((time, i) => {
  //     if (time.dataset.time === "hour" || time.dataset.time === "min") {
  //       time.innerHTML = "00:"
  //     } else {
  //       time.innerHTML = "00"
  //     }
  //   })
  //   document.getElementById("time").classList.remove("pulse")
  //   reset.setAttribute("disabled", true)
  //   stop.setAttribute("disabled", true)
  // }
  // reset.addEventListener("click", resetTime)

  // Fetch Times
  fetch_data();
  var alltablesArray = [];

  function fetch_data(){
    $.ajax({
      url: 'fetchTimer',
      type:"get",
      success: function(response) {
          var fulltableData = {
            "updation_date": "",
            "all_datas": []
          };
          var tableData = {
            "id": "",
            "task": "",
            "project": "",
            "start": "",
            "stop": "",
            "total": ""
          };

          if (response.dbStatus == "SUCCESS") {
              $.each(response.aaData,function(i, data) {

                if(fulltableData.updation_date.includes(data.update_date)){
                
                  // alert("Data already exists"+data.update_date);
                  tableData = {
                    "id": data.id,
                    "task": data.task,
                    "project": data.proj_name,
                    "start": data.start_time,
                    "stop": data.stop_time,
                    "total": data.total_time
                    
                  };
                  fulltableData.all_datas.push(tableData);
                }
                else{
                  // alert("Data not exists"+data.update_date);
                  fulltableData = {
                    "updation_date": data.update_date,
                    "all_datas": [
                      {
                        "id": data.id,
                        "task": data.task,
                        "project": data.proj_name,
                        "start": data.start_time,
                        "stop": data.stop_time,
                        "total": data.total_time
                      }
                    ]
                  };
                  alltablesArray.push(fulltableData);
                }
              });
              createTable(alltablesArray);
          }
      },
      error:function(response) {
          alert('Something went wrong....');
      }
  }); 

  }

 

  function createTable(alltablesArray){
    var mytbl=``;
    var myopt=``;
    var i=1;
    var firstTime="00:00:00";
    var secondTime="00:00:00";
    var totalfinal;
// create table
    alltablesArray.forEach(function (timer) {
      mytbl += `<table class="table bg-light" id="timerTbl-${i}">
        <thead>
          <tr>
            <th colspan="3"><i class="fa fa-calendar"></i> Date: <span id="calander-date}">${timer.updation_date}</span> </th>
            `;

               timer.all_datas.forEach(function (timing) {
               secondTime=timing.total;
               totalfinal = addTimes(firstTime,secondTime);   
                firstTime=totalfinal;                          
            });
            mytbl += `<th colspan="4"> <i class="fa fa-edit"></i> Total Time: <span id="total-time">${totalfinal}</span></th>`;

           mytbl+=` </tr>
            </thead>
            <tbody id="tbody-${i}">`;  
        mytbl += `          
        </tbody>
      </table>`;
      $('#timerTbl-'+i).DataTable();
      i++;
    });
    $("#tableTimer").html(mytbl);
// add rows
    var j =1;
    alltablesArray.forEach(function (timer) {      
      myopt=``;
       timer.all_datas.forEach(function (data) {
              if(data.task == null){
                  myopt += `<tr> <td> <input type="text" value="" placeholder="Enter description"></td>`;
                }else{
                  myopt+=` <tr> <td> <input type="text" value="${data.task}"></td>`;
                }
                myopt+= `<td><i class="fa fa-check-square-o"></i> ${data.project}</td>
                  <td>${data.start}-${data.stop}</td>
                  <td>${data.total}</td>
                  <td><button class="fa fa-play btn-light" onclick="resumeTask(${data.id})" title="click to resume entry"></button></td>
                  <td><button class="fa fa-ellipsis-v btn-light" onclick="deleteTask(${data.id})" title="Click to delete entry"></button></td>
                  </tr>`;
        });      
        $("#tbody-"+j).html(myopt);
        j++;
    });

  }

  function addTimes (startTime, endTime) {
    var times = [ 0, 0, 0 ]
    var max = times.length
  
    var a = (startTime || '').split(':')
    var b = (endTime || '').split(':')
  
    // normalize time values
    for (var i = 0; i < max; i++) {
      a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
      b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
    }
  
    // store time values
    for (var i = 0; i < max; i++) {
      times[i] = a[i] + b[i]
    }
  
    var hours = times[0]
    var minutes = times[1]
    var seconds = times[2]
  
    if (seconds >= 60) {
      var m = (seconds / 60) << 0
      minutes += m
      seconds -= 60 * m
    }
  
    if (minutes >= 60) {
      var h = (minutes / 60) | 0
      hours += h
      minutes -= 60 * h
    }
  
    return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2)
  }


});
