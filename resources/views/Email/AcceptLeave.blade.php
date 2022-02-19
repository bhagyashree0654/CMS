<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Accepted</title>
</head>
<body>

    <p>
        Dear {{$details['applicant']}},
        <p>
        This letter is in response to your request for a leave of absence beginning {{$details['start']}} through {{$details['end']}} for {{$details['reason']}}. Your leave request get accepted so you can take a leave. 
        </p>
        <p>
        If you feel that this decision is made in error or that extenuating circumstances warrant further review of your request, please feel free to contact me with more information surrounding your need for leave.
        </p>
        <p style="color: darkgreen; font-size: 15px;">  Sincerely,     <br> 
            
        {{$details['sender']}}<br>
        {{$details['position']}}<br>
        {{$details['email']}}<br>
        Codekart Solutions Pvt. Ltd. Company<br>
        www.thecodekart.com<br>
        </p>
    </p>
    
</body>
</html>