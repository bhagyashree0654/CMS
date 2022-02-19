<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interview Mail</title>
</head>
<body>
    <h3>Subject Line: Codekart Pvt. Ltd. : Invitation to Interview</h3> 
    <p>Dear {{$data['name']}},

       <p> Thank you for your application to the {{$data['pos']}} developer position at Codekart Pvt. Ltd. . </p>
        
       <p>After reviewing your application, we would like to invite you to interview with {{$data['sendername']}} ~ <b> HR department ,{{$data['position']}}</b> dated on {{$data['meeting_date']}} at {{$data['meetTime']}}. So we can get to know you better, the interview will be conducted over video call and last about 1 to 1.30 hour in total. </p>

       <p> Here we have mentioned the meeting link. Please join the meeting in time.</p>

      <p>Link: {{$data['link']}} <br>

        We look forward to speaking with you.       </p> 
        <p style="color: darkgreen; font-size: 10px; float:right;">  Sincerely,     <br> 
        
            {{$data['sendername']}}<br>
            HR Department , {{$data['position']}}<br>
            Codekart Solutions Pvt. Ltd. Company<br>
            www.thecodekart.com<br>
            careers@thecodekart.com<br>
            Contact: {{$data['senderContact']}}<br>
        </p>
    </p>

</body>
</html>