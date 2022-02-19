<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Form</title>
    <style>
        .container{
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <p>
            Dear {{$details['name']?? ""}},</p>

        <p>    I am writing to notify you that I need leave from work because of {{$details['reason']}}.</p>

        <p>     Kindly allow me a leave from date {{$details['to']}} to the date {{$details['from']}}.
        
            Thank you for your quick attention to this matter. <br><br><br>

                                                                                                Sincerely,
                                                                                                {{$details['sender']}}

        </p>
       

    </div>
    
</body>
</html>