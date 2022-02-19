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
        }
        @page {
                margin: 0cm 0cm;
               /* margin: 220px 50px 80px 50px; */
        }
        @media print {
            section {page-break-after: always;}
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
        .page-break {
            page-break-after: always;
        }
        .para1{
            justify-content: flex-start;
        }
        p{
            margin-top:2px;
            margin-bottom: 2px;
        }
        ol,ul{
            margin-left: 13px;
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
    <section>
        <p class="para1">

            <span style="float: left">Full Name: {{$user_acc}} {{$username}}</span>
            <span style="float: right">Date: {{date('d-m-Y')}}</span>
            <br>
            <span style="float: left">Address:{{$address}}</span>
        </p>

        <p class="indent-text">
            Dear {{$first_name}},
            We are pleased to appoint you in our organization as Software Developer which will be affected
            from {{$joining_date}}. You will be based in Bhubaneswar office (currently work from home due to Covid
            19) on a salary as discussed (Follow Annexure – B). Your salary will be paid on the 1st week of
            each month.
            Your employment with us will be governed by the Terms and Conditions as detailed in Annexure
            – A.
            Your offer has been made based on the information furnished by you. However, if there is a
            discrepancy in the copies of documents or certificates given by you as a proof of above we retain
            the rights to review our offer of employment.
            Employment as per this offer is subject to your medically being fit. Please sign and return a
            duplicate copy of this letter in a token of your acceptance.
            We congratulate you on your appointment and wish you a long and successful career with us. We
            are confident that your contribution will take us further in our journey towards becoming world
            leaders. We assure you of our support for your professional development and growth.
            Yours truly,
            For Codekart Solutions Pvt. Ltd.
            <br>
            <img src="{{public_path('members/sign/'.$signature.'') }}" alt="sign" height="50" width="150" style="margin-top: 20px">
            <br> <img src="{{ public_path('assets/img/images.png') }}" alt="stamp" height="50" width="50">
           {{$designation}}, {{$position}} <br>
           {{$name}}
        </p>    
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>