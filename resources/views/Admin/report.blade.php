<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            text-align: justify;
            font-size: 16px;
        }@page {
                margin: 0cm 0cm;
               /* margin: 220px 50px 80px 50px; */
            }
            @media all{
                body{
                    margin:220px 50px 80px 50px;                    
                }
            }
        body {
            /* margin-top:    3.5cm; */
            margin-bottom: 1cm;
            margin-left:   1cm;
            margin-right:  1cm;
        }
        p{
            margin-top:5px;
            margin-bottom: 5px;
        }
      
        #watermark {
                position: fixed;
                top: 0px;
                bottom:   0px;
                left:     0px;
                width:    21cm;
                height:   29.7cm;
                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
    </style>
</head>
<body>
 <div id="watermark">
            <img src="{{ public_path('assets/img/lh.png') }}" height="100%" width="100%" />
</div>

        <p>
            {!!$report!!}
        </p>
</body>
</html>